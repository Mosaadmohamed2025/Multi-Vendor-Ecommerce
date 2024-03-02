<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $total_orders = Order::count();

        $count_delivered =Order::where('condition' , 'delivered')->count();
        $count_pending = Order::where('condition', 'pending')->count();
        $count_processing= Order::where('condition', 'processing')->count();
        $count_cancel= Order::where('condition', 'cancelled')->count();

        $percentage_delivered = ($count_delivered / $total_orders) * 100;
        $percentage_pending = ($count_pending / $total_orders) * 100;
        $percentage_processing = ($count_processing / $total_orders) * 100;
        $percentage_cancel = ($count_cancel / $total_orders) * 100;

        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['Delivered', 'Pending', 'Processing' , 'Cancel'])
            ->datasets([
                [
                    "label" => "Delivered",
                    'backgroundColor' => ['#81b214'],
                    'data' => [$percentage_delivered]
                ],
                [
                    "label" => "Pending",
                    'backgroundColor' => ['#f0ad4e'],
                    'data' => [$percentage_pending]
                ],
                [
                    "label" => "Processing",
                    'backgroundColor' => ['#0275d8'],
                    'data' => [$percentage_processing]
                ],
                [
                    "label" => "Cancel",
                    'backgroundColor' => ['#ec5858'],
                    'data' => [$percentage_cancel]
                ],

            ])
            ->options([]);


        $count_Paid = Order::where('payment_status', 'paid')->count();
        $count_UnPaid = Order::where('payment_status', 'unpaid')->count();

        $percentage_paid = ($count_Paid / $total_orders) * 100;
        $percentage_unpaid = ($count_UnPaid / $total_orders) * 100;

        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['OrderUnPaid', 'OrderPaid'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214','#ff9642'],
                    'data' => [$percentage_unpaid ,$percentage_paid]
                ]
            ])
            ->options([]);


        return view('Backend.index',compact('chartjs' , 'chartjs_2'));
    }

    public function markAllAsRead()
    {
        Notification::where('reader_status', 0)->update(['reader_status' => 1]);

        return back()->with('success', 'Mark All As Read');
    }
}
