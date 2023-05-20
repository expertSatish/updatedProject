<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\OnlinePayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    
    public function online_payment_list(Request $request)
    {
        $payment_list = OnlinePayment::all();
        return view('control-panel.payment.list', compact('payment_list'));
    }

    public function online_payment_detail(Request $request)
    {
        $data = OnlinePayment::where('online_payment_id', $request->id)->first();
        if (!isset($data)) {
            $Html = 'No data';
        } else {

            $Html = '';

            $Html .= '<table id="datatable1" class="table table-striped bulk_action table-p">
                    <tr>
                        <th>Date</th>
                        <td class="text-left">' . date('d M,Y', strtotime($data->created_at)) . '</td>
                    </tr>';

            $Html .= '<tr>
                        <th>Name</th>
                        <td class="text-left">' . $data->name . '</td>
                </tr>';
            $Html .= '<tr>
                        <th>Email</th>
                        <td class="text-left">' . $data->email . '</td>
                </tr>';
            $Html .= '<tr>
                        <th>Amount</th>
                        <td class="text-left">INR ' . $data->amount . '/-</td>
                </tr>';
            $Html .= '<tr>
                        <th>Contact</th>
                        <td class="text-left">' . $data->contact . '</td>
                </tr>';
            $Html .= '<tr>
                        <th>Message</th>
                        <td class="text-left">' . $data->message . '</td>
                </tr>';
            $Html .= '<tr>
                        <th>Transaction Id</th>
                        <td class="text-left">' . $data->tranx_id . '</td>
                </tr>';
            $Html .= '<tr>
                        <th>Transaction Message</th>
                        <td class="text-left">' . $data->transaction_message . '</td>
                </tr>';

            $Html .= '</table>';


            echo $Html;
        }
    }

    public function online_payment_delete(Request $request)
    {
        OnlinePayment::where('online_payment_id', $request->id)
            ->delete();
        return redirect('/control-panel/online-payment-list')->with('success_msg', 'Data Deleted Successfully');
    }
}
