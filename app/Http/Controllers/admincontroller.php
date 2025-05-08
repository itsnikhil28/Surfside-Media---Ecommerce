<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\category;
use App\Models\coupon;
use App\Models\order;
use App\Models\product;
use App\Models\sales;
use App\Models\slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class admincontroller extends Controller
{
    public function index()
    {
        $totalOrderCount = order::count();
        $totalAmount = order::sum('total');
        $pendingOrders = order::where('status', 'pending')->count();
        $pendingOrderAmount = order::where('status', 'pending')->sum('total');
        $deliveredOrders = order::where('status', 'delivered')->count();
        $deliveredOrderAmount = order::where('status', 'delivered')->sum('total');
        $canceledOrders = order::where('canceled_date', 1)->count();
        $canceledOrderAmount = order::where('canceled_date', 1)->sum('total');
        $recentorders = order::where('total' ,'>', 0)->orderby('created_at', 'DESC')->limit(5)->get();
        return view('admin.dashboard', compact(
            'recentorders',
            'totalOrderCount',
            'totalAmount',
            'pendingOrders',
            'pendingOrderAmount',
            'deliveredOrders',
            'deliveredOrderAmount',
            'canceledOrders',
            'canceledOrderAmount'
        ));
    }

    public function getChartData()
    {
        $monthlyData = DB::table('orders')->raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$group' => [
                        '_id' => [
                            'month' => ['$month' => '$created_at'],
                            'year' => ['$year' => '$created_at']
                        ],
                        'total' => ['$sum' => '$total'],
                        'pending' => [
                            '$sum' => [
                                '$cond' => [['$eq' => ['$status', 'pending']], '$total', 0]
                            ]
                        ],
                        'delivered' => [
                            '$sum' => [
                                '$cond' => [['$eq' => ['$status', 'delivered']], '$total', 0]
                            ]
                        ],
                        'canceled' => [
                            '$sum' => [
                                '$cond' => [['$eq' => ['$status', 'canceled']], '$total', 0]
                            ]
                        ]
                    ]
                ],
                ['$sort' => ['_id.year' => 1, '_id.month' => 1]]
            ]);
        });

        $chartData = [
            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'total' => array_fill(0, 12, 0),
            'pending' => array_fill(0, 12, 0),
            'delivered' => array_fill(0, 12, 0),
            'canceled' => array_fill(0, 12, 0),
        ];

        foreach ($monthlyData as $data) {
            $monthIndex = $data->_id['month'] - 1;
            $chartData['total'][$monthIndex] = (float) $data->total;
            $chartData['pending'][$monthIndex] = (float) $data->pending;
            $chartData['delivered'][$monthIndex] = (float) $data->delivered;
            $chartData['canceled'][$monthIndex] = (float) $data->canceled;
        }

        return response()->json($chartData);
    }

    //brands

    public function brands()
    {
        return view('admin.brands');
    }

    // Category
    public function categories()
    {
        return view('admin.category');
    }

    //products
    public function products()
    {
        return view('admin.product');
    }

    //coupon
    public function coupons()
    {
        $coupons = coupon::orderby('expiry_date', 'DESC')->paginate();
        return view('admin.coupons', compact('coupons'));
    }

    //order
    public function orders()
    {
        $orders = order::orderby('created_at', 'DESC')->where('total' ,'>', 0)->paginate(10);
        return view('admin.order', compact('orders'));
    }

    //sliders
    public function sliders()
    {
        $sliders = slider::orderby('created_at', 'DESC')->paginate(10);
        return view('admin.slider', compact('sliders'));
    }

    //sales
    public function sales()
    {
        $sales = sales::orderby('created_at', 'DESC')->paginate(10);
        return view('admin.sales', compact('sales'));
    }

    //users
    public function users()
    {
        $users = User::where('role', 'user')->orderby('created_at', 'DESC')->paginate(10);
        return view('admin.users', compact('users'));
    }

    //settings
    public function settings()
    {
        $user = User::findorfail(session('id'));
        return view('admin.settings', compact('user'));
    }
}
