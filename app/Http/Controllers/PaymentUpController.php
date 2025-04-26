<?php

namespace App\Http\Controllers;

use App\Models\PaymentUp;
use App\Models\User;
use App\Models\Pay;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PaymentUpController extends Controller
{
    public function dashboard()
    {
        $paymentCount = PaymentUp::count();
        $userCount = User::count();
        $payment =  PaymentUp::all();
        $user = User::all();
        return view('dashboard', compact('payment', 'user', 'paymentCount', 'userCount'));
    }

    public function view_main_payment()
    {

        $customers = User::where('role', 0)->get();
        $payment = PaymentUp::all();

        return view('main_payment', compact('customers', 'payment'));
    }

    public function add_paymentdetails(Request $request)
    {
        $request->validate([
            'name' => 'required|string|required',
            'admition_no' => 'required|string|required|unique:payment_ups',
            'period' => 'required|integer',
            'ammount' => 'required|integer',
        ]);

        $period = $request->input('period');

        switch ($period) {
            case 1:
                $expirationDate = now()->addMonth();
                break;
            case 2:
                $expirationDate = now()->addMonths(3);
                break;
            case 3:
                $expirationDate = now()->addYear();
                break;
            default:
                $expirationDate = now();
                break;
        }

        $payment = new PaymentUp([
            'name' => $request->input('name'),
            'admition_no' => $request->input('admition_no'),
            'period' => $period,
            'ammount' => $request->input('ammount'),
            'payment_date' => now(),
            'expiration_date' => $expirationDate,
        ]);

        $payment->save();


        $request->session()->flash('success', 'Payment Done successfully.');

        return back();
    }


    public function deleteBook(Request $request, $id)
    {
        try {
            $response = PaymentUp::find($id);
            $response->delete();

            $request->session()->flash('delete', 'Payment DELETED.');
            return back();
        } catch (\Exception $error) {
            $request->session()->flash('Something goes wrong. Please try again');
            return back();
        }
    }

    public function editBook($id)
    {
        $payment = PaymentUp::find($id);
        return view('edit_book', compact('payment'));
    }

    public function update_book(Request $request, $id)
    {
        $request->validate([
            'period' => 'required|integer',
            'ammount' => 'required|integer',
        ]);

        $period = $request->input('period');

        switch ($period) {
            case 1:
                $expirationDate = now()->addMonth();
                break;
            case 2:
                $expirationDate = now()->addMonths(3);
                break;
            case 3:
                $expirationDate = now()->addYear();
                break;
            default:
                $expirationDate = now();
                break;
        }

        $payment = PaymentUp::find($id);

        $payment->name = $request->input('name');
        $payment->admition_no = $request->input('admition_no');
        $payment->period = $period;
        $payment->ammount = $request->input('ammount');
        $payment->payment_date = now();
        $payment->expiration_date = $expirationDate;

        $payment->save();

        $request->session()->flash('success', 'Payment updated successfully.');

        return redirect()->route('main_payment');
    }


    
}
