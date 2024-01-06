<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //To display Payment form and and redirect to relevant view page
    public function showCreatePaymentForm()
    {
        return view('managePayment.kioskParticipant.createPayment');

    }

    /**
     * Show the form for creating a new resource.
     */
    //To create payment
    public function createPayment(Request $request)
    {
        try {
            // Validate the form data and file uploads
            $request->validate([
                'payment_type' => 'required|string',
                'payment_amount' => 'reuired|double',
                'payment_date' => 'required|date_format:Y-m-d',
                'payment_receipt' => 'required|mimes:pdf|max:2048',
            ]);

            $paymentReceiptPath = $request->file('payment_receipt')->storeAs('payments', 'receipt_' . time() . '.pdf', 'public');

            // Create a new payments record
            $payment = new payments([
                'user_id' => Auth::id(),
                'payment_type' => $request->input('payment_type'),
                'payment_amount' => $request->input('payment_amount'),
                'payment_date' => $request->input('payment_date'),
                'payment_receipt' => $paymentReceiptPath,  // Save the file path in the database instead of raw data
                'application_status' => 'New',
                'application_comment' => '',
            ]);

            // Save the payment
            $payment->save();

            return view('managePayment.manageApplication.PendingApproval');
        } catch (\Throwable $th) {
            return view('error', [
                'error' => $th->getMessage(),
            ]);
        }
    }
}
