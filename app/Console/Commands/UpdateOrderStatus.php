<?php

namespace App\Console\Commands;

use App\Models\order;
use App\Models\transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    // Description of the command
    protected $description = 'Update order status to delivered after 3 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Find orders where status is 'pending' and delivered_date is today or earlier
        $orders = order::where('status', 'pending')
            ->where('delivered_date', '<=', Carbon::now())
            ->get();

        // Update the status of each order
        foreach ($orders as $order) {
            $order->update(['status' => 'delivered']);

            transaction::where('order_id', $order->id)->update(['status' => 'approved']);
        }

        $this->info(count($orders) . ' orders updated to delivered.');
    }
}
