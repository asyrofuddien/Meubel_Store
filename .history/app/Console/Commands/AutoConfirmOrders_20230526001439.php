<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;

class AutoConfirmOrders extends Command
{
    protected $signature = 'auto-confirm:orders';
    protected $description = 'Automatically confirms orders based on transaction date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $cutoffDate = Carbon::now()->subDays(7);

        $orders = Order::where('status', 'pending')
            ->where('transaction_date', '<=', $cutoffDate)
            ->get();

        foreach ($orders as $order) {
            $order->status = 'confirmed';
            $order->save();
        }

        $this->info('Pending orders with transaction date older than 7 days have been automatically confirmed.');
    }
}