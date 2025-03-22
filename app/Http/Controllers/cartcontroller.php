<?php

namespace App\Http\Controllers;

use App\Models\address;
use App\Models\coupon;
use App\Models\order;
use App\Models\orderitem;
use App\Models\product;
use App\Models\sales;
use App\Models\transaction;
use App\Models\transaction_detail;
use App\Models\wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;


class cartcontroller extends Controller
{
    public function index()
    {
        $cartitems = Cart::instance('cart')->content();
        return view('home.cart', compact('cartitems'));
    }

    public function cartadd(Request $request)
    {
        $product = product::findorfail($request->id);
        $wishlist = wishlist::where('product_id', $product->id)->where('user_id', session('id'))->first();

        if ($request->has('from_wishlist_page')) {
            $quantity = $wishlist->productqty;
            $wishlist->delete();
        } else {
            $quantity =  $request->quantity;
        }

        $price = $product->sale_price ? $product->sale_price : $product->regular_price;

        $sales_product_id = sales::pluck('product_id');
        if ($sales_product_id->contains($product->id)) {
            $sale = sales::where('product_id', $product->id)->first();
            $price = (int) $sale->deal_price;
        }

        Cart::instance('cart')->add($product->id, $product->name, $quantity, $price, ['image' => $product->image]);

        return redirect()->back();
    }

    public function itemincrease(Request $request)
    {
        $product = Cart::instance('cart')->get($request->id);
        $updatedqty = $product->qty + 1;
        Cart::instance('cart')->update($product->rowId, $updatedqty);
        return redirect()->back();
    }

    public function itemdecrease(Request $request)
    {
        $product = Cart::instance('cart')->get($request->id);
        $updatedqty = $product->qty - 1;
        Cart::instance('cart')->update($product->rowId, $updatedqty);
        return redirect()->back();
    }

    public function itemremove(Request $request)
    {
        $product = Cart::instance('cart')->get($request->id);
        Cart::instance('cart')->remove($product->rowId);
        return redirect()->back();
    }

    public function cartempty(Request $request)
    {
        Cart::instance('cart')->destroy();
        return redirect()->back();
    }

    public function couponapply(Request $request)
    {
        $cartsubtotal = (int) str_replace(',', '', Cart::instance('cart')->subtotal());
        // dd($cartsubtotal);
        if (isset($request->coupon_code)) {
            $coupon = coupon::where('code', $request->coupon_code)
                ->where('expiry_date', '>=', date('Y-m-d'))
                ->where('cart_value', '<=', $cartsubtotal)
                ->first();

            if (!$coupon) {
                return redirect()->back()->with('error', 'Please enter a valid coupon');
            } else {
                session()->put('coupon', [
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'value' => $coupon->value,
                    'cart_value' => $coupon->cart_value
                ]);
                $this->calculateDiscounts();
                return redirect()->back()->with('success', 'Coupon applied successsfully');
            }
        } else {
            return redirect()->back()->with('error', 'Please Enter Coupon');
        }
    }

    public function calculateDiscounts()
    {
        $discount = 0;
        $cartSubtotal = floatval(str_replace(',', '', Cart::instance('cart')->subtotal()));

        if (session()->has('coupon')) {
            if (session()->get('coupon')['type'] == 'fixed') {
                $discount = floatval(session()->get('coupon')['value']);
            } else {
                $discount = ($cartSubtotal * floatval(session()->get('coupon')['value'])) / 100;
            }

            $subtotalAfterDiscount = max(0, $cartSubtotal - $discount);
            $taxRate = config('cart.tax', 0);
            $taxAfterDiscount = ($subtotalAfterDiscount * $taxRate) / 100;
            $totalAfterDiscount = $subtotalAfterDiscount + $taxAfterDiscount;

            session()->put('discounts', [
                'discount' => number_format($discount, 2, '.', ''),
                'subtotal' => number_format($subtotalAfterDiscount, 2, '.', ''),
                'tax' => number_format($taxAfterDiscount, 2, '.', ''),
                'total' => number_format($totalAfterDiscount, 2, '.', '')
            ]);
        }
    }


    public function removecoupon()
    {
        session()->forget('coupon');
        Session::forget('discounts');
        return redirect()->back()->with('success', 'Coupon removed Successfully');
    }

    public function checkout()
    {
        $address = address::where('user_id', session('id'))->where('isdefault', true)->first();
        return view('home.checkout', compact('address'));
    }

    public function placeorder(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'phone' => 'required|numeric|digits:10',
            'zip' => 'required|numeric|digits:6',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'locality' => 'required',
            'landmark' => 'required',
            'mode' => 'required',
        ]);

        if (!(address::where('user_id', session('id'))->count() > 0)) {
            address::create([
                'user_id' => session('id'),
                'name' => $request->name,
                'phone' => $request->phone,
                'locality' => $request->locality,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => 'INDIA',
                'landmark' => $request->landmark,
                'zip' => $request->zip,
                'isdefault' => true,
            ]);
        }

        $this->total();

        if ($request->mode == 'cod') {
            $order = $this->createorder($request);
        } else if ($request->mode == 'phonepe') {

            $order = order::create([
                'is_shipping_different' => false
            ]);

            $merchantId = 'PGTESTPAYUAT86';
            $apiKey = '96434309-7796-489d-8924-ab56988a6076';

            $csrfToken = csrf_token();

            $transaction_data = [
                'merchantId' => $merchantId,
                'merchantTransactionId' => $order->id,
                'merchantUserId' => session('id'),
                'amount' => (int) session('total') * 100,
                'redirectUrl' => route('phonepe.callback'),
                'redirectMode' => 'REDIRECT',
                'callbackUrl' => route('phonepe.callback'),
                'paymentInstrument' => [
                    'type' => 'PAY_PAGE',
                ],
                'csrf_token' => $csrfToken,
            ];

            $payload = base64_encode(json_encode($transaction_data));
            $salt_index = 1;
            $hashed_payload = hash("sha256", $payload . "/pg/v1/pay" . $apiKey) . "###" . $salt_index;

            $request_data = json_encode(['request' => $payload]);

            Session::put('ids', ['merchantid' => $merchantId, 'orderid' => $order->id, 'request' => $request->all()]);

            try {
                $url = 'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay';

                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Content-Type: application/json",
                    "X-VERIFY: $hashed_payload",
                    "accept: application/json",
                    "X-CSRF-TOKEN: $csrfToken",
                ]);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data);

                $response = curl_exec($ch);

                if (curl_errno($ch)) {
                    $error_msg = curl_error($ch);
                    curl_close($ch);
                    return redirect()->back()->with('error', 'Payment initiation failed! Please Check your internet connection');
                }

                curl_close($ch);

                $response_data = json_decode($response, true);

                if (isset($response_data['success']) && $response_data['success'] === true) {
                    return redirect($response_data['data']['instrumentResponse']['redirectInfo']['url']);
                } else {
                    return redirect()->back()->with('error', $response_data['message'] ?? 'Something went wrong.');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Payment initiation failed. Please try again.');
            }
        } else {
            return redirect()->back()->with('error', 'Please Select PhonePe or COD');
        }

        $this->destorycart();
        return redirect()->route('cart.confirmation', ($order->id));
    }

    public function phonePeCallback()
    {
        $request = session('ids')['request'];
        $merchantId = session('ids')['merchantid'];
        $merchantTransactionId = session('ids')['orderid'];
        $hashed_payload = hash('sha256', "/pg/v1/status/{$merchantId}/{$merchantTransactionId}" . '96434309-7796-489d-8924-ab56988a6076') . "###" . 1;
        $url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/{$merchantId}/{$merchantTransactionId}";

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'accept' => 'application/json',
                'X-VERIFY' => $hashed_payload,
            ])->get($url);

            if ($response->successful()) {
                $response_data = json_decode($response, true);

                $order = order::findorfail($merchantTransactionId);
                $order->user_id = session('id');
                $order->subtotal = (int) session('subtotal');
                $order->discount = (int) session('discount');
                $order->total = (int) session('total');
                $order->tax = (int) session('tax');
                $order->name = $request['name'];
                $order->phone = $request['phone'];
                $order->locality = $request['locality'];
                $order->address = $request['address'];
                $order->city = $request['city'];
                $order->state = $request['state'];
                $order->country = 'INDIA';
                $order->landmark = $request['landmark'];
                $order->zip = $request['zip'];
                $order->status = 'pending';
                $order->delivered_date = Carbon::now()->addDays(3);

                $order->save();

                foreach (Cart::instance('cart')->content() as $item) {
                    orderitem::create([
                        'product_id' => $item->id,
                        'order_id' => $order->id,
                        'price' => (int) $item->price,
                        'quantity' => (int) $item->qty,
                    ]);
                }

                $transaction = transaction::create([
                    'status' => 'approved',
                    'user_id' => session('id'),
                    'order_id' => $order->id,
                    'mode' => $request['mode'],
                ]);

                transaction_detail::create([
                    'transactionid' => $transaction->id,
                    'merchantid' => $response_data['data']['merchantId'],
                    'merchanttransactionid' => $response_data['data']['merchantTransactionId'],
                    'paymenttransactionid' => $response_data['data']['transactionId'],
                    'amount' => $response_data['data']['amount'] / 100,
                    'state' => $response_data['data']['state'],
                    'paymentdetails' => $response_data['data']['paymentInstrument'],
                ]);

                Session::forget('ids');

                $this->destorycart();

                return redirect()->route('cart.confirmation', ($order->id));
            } else {
                return redirect('/cart/checkout')->with('error', 'Payment initiation failed. Please try again.');
            }
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while fetching the transaction status.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
    // public function phonePeCallback(Request $request)
    // {
    //     $data = $request->getContent();
    //     $decoded_data = json_decode($data, true);

    //     dd($decoded_data);

    //     if (!$decoded_data) {
    //         Log::error('Invalid callback data received.');
    //         return redirect('/cart/checkout')->with('error', 'Invalid data received.');
    //     }

    //     dd($decoded_data);

    //     $transaction_id = $decoded_data['transactionId'] ?? null;
    //     $order_id = $decoded_data['merchantTransactionId'] ?? null;
    //     $status = $decoded_data['status'] ?? null;

    //     if ($status === 'SUCCESS') {
    //         $order = Order::where('id', $order_id)->first();

    //         if ($order) {
    //             $order->status = 'confirmed';
    //             $order->save();

    //             transaction::where('order_id', $order_id)->update([
    //                 'transaction_id' => $transaction_id,
    //                 'status' => 'success'
    //             ]);

    //             Log::info("Payment successful for Order ID: $order_id");

    //             return redirect('/cart/checkout')->with('success', 'Payment confirmed.');
    //         } else {
    //             Log::error("Order not found for ID: $order_id");
    //             return redirect('/cart/checkout')->with('error', 'Order not found.');
    //         }
    //     } else {
    //         Log::error("Payment failed or pending for Order ID: $order_id with status: $status");
    //         return redirect('/cart/checkout')->with('error', 'Payment failed or pending.');
    //     }
    // }

    public function createorder($request)
    {
        $order = order::create([
            'user_id' => session('id'),
            'subtotal' => (int) session('subtotal'),
            'discount' => (int) session('discount'),
            'total' => (int) session('total'),
            'tax' => (int) session('tax'),
            'name' => $request->name,
            'phone' => $request->phone,
            'locality' => $request->locality,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => 'INDIA',
            'landmark' => $request->landmark,
            'zip' => $request->zip,
            'status' => 'pending',
            'delivered_date' => Carbon::now()->addDays(3),
        ]);

        foreach (Cart::instance('cart')->content() as $item) {
            orderitem::create([
                'product_id' => $item->id,
                'order_id' => $order->id,
                'price' => (int) $item->price,
                'quantity' => (int) $item->qty,
            ]);
        }

        transaction::create([
            'user_id' => session('id'),
            'order_id' => $order->id,
            'mode' => $request->mode,
        ]);

        return $order;
    }

    public function destorycart()
    {
        Cart::instance('cart')->destroy();
        session()->forget('coupon');
        session()->forget('discounts');
        session()->forget('subtotal');
        session()->forget('discount');
        session()->forget('total');
        session()->forget('tax');
    }

    public function total()
    {
        if (Session::has('coupon')) {
            session(['subtotal' => Session::get('discounts')['subtotal']]);
            session(['discount' => Session::get('discounts')['discount']]);
            session(['total' => Session::get('discounts')['total']]);
            session(['tax' => Session::get('discounts')['tax']]);
        } else {
            session(['subtotal' => Cart::instance('cart')->subtotal()]);
            session(['discount' => 0]);
            session(['total' => Cart::instance('cart')->total()]);
            session(['tax' => Cart::instance('cart')->tax()]);
        }
    }

    public function order_confirmation($id)
    {
        $order = order::findorfail($id);
        return view('home.order-confirmation', compact('order'));
    }
}
