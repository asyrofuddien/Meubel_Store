<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\TransactionDetail;
use App\User;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
                            ->whereHas('product', function($product){
                                $product->where('users_id', Auth::user()->id);
                            });
        $transactions2 = TransactionDetail::with(['transaction.user', 'product.galleries'])
                            ->whereHas('product', function($product){
                                $product->where('users_id', Auth::user()->id);
                            })->whereHas('transaction', function ($transaction) {
                                $transaction->where('transaction_status', 'BERHASIL');
                            });

        $reveneu = $transactions2->orderby('created_at', 'DESC')->get()->reduce(function ($carry, $item){
            $total = $carry + $item->price;
            return $total - ($total*0.01) ; //pendapatan dikurangi 1 persen
        });

        $customer = User::count();

        return view('pages.dashboard', [
            'transaction_count' => $transactions->count()->where('transaction_status', 'BERHASIL'),
            'transaction_data' => $transactions->get(),
            'revenue' => $reveneu,
            'customer' => $customer
        ]);
    }
}
