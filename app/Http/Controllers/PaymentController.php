<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //To display Payment form and and redirect to relevant view page
    public function showCreatePaymentForm()
    {
        $user = Auth::user();

        //Check if the user has an application
        $application = Application::where('user_id', $user->id)->first();

        switch ($application->application_status) {
            case 'New':
                // Scenario 2: User has application_id with application_status "New"
                return view('managePayment.manageApplication.PendingApproval', compact('application'));
            case 'Active':
                // Scenario 3: User has application_id with application_status "Active"
                return view('managePayment.manageApplication.EditKiosk', compact('application'));
            case 'Inactive':
                // Scenario 4: User has application_id with application_status "Inactive"
                return view('managePayment.manageApplication.ApplyKiosk', compact('application'));
            case 'Rejected':
                // Scenario 5: User has application_id with application_status "Rejected"
                // You can pass the application_comment to the view if needed
                return view('managePayment.manageApplication.RejectedApplication', compact('application'));
            default:
                // Handle other scenarios if needed
                return abort(404); // Example: Page not found
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function editPayment(Request $request, $id)
    {
        //Validate and update the payment data
        $request->validate([
            'payment_type' => 'required|string',
            'payment_amount' => 'reuired|double',
            'payment_date' => 'required|date_format:Y-m-d',
        ]);

        //Update application data
        $payment = Payments::findOrFail($id);

        $payment->edit([
            'payment_type' => $request->input('payment_type'),
            'payment_amount' => $request->input('payment_amount'),
            'payment_date' => $request->input('payment_date'),
        ]);

    }

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
