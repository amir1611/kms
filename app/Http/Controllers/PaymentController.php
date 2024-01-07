<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Payments;
use App\Models\User;



class PaymentController extends Controller
{
    
    //To display Payment form and and redirect to relevant view page
    public function showCreatePaymentForm()
    {
        $user = Auth::user();

        return view('managePayment.kioskParticipant.createPayment');

    }

    /**
     * Show the form for creating a new resource.
     */

    //To store payment
    public function createPayment(Request $request)
    {
        try {

            $request->validate([
                'kiosk_id' => 'required|numeric',
                'payment_type' => 'required|string',
                'payment_amount' => 'required|numeric',
                'payment_date' => 'required|date_format:Y-m-d',
                'payment_receipt' => 'required|mimes:pdf|max:10240',
            ]);

            $payment_receipt = $request->file('payment_receipt')->storeAs('payments', 'receipt_' . time() . '.pdf', 'public');


            // Fetch the  associated with the current user
            $kiosk = Auth::user()->kiosk;

            // Create a new payment with the kiosk_id
            $payment = new payments([
                'user_id' => Auth::id(),
                'kiosk_id' => $request->input('kiosk_id'),
                'payment_type' => $request->input('payment_type'),
                'payment_amount' => $request->input('payment_amount'),
                'payment_date' => $request->input('payment_date'),
                'payment_receipt' => $payment_receipt,
                'payment_status' => '',
                'payment_comment' => '',
             ]);

            // Save the payment
            $payment->save();

            // You may add a success message or redirect to a success page
            return view('managePayment.kioskParticipant.pendingApproval');

            } catch (\Throwable $th) {
           // Display error message along with the confirmation message
            return view('error', [
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function viewPaymentHistory(Request $request)
    {
        // Assuming you have user authentication and want to retrieve reports for the authenticated user
        $userId = auth()->user()->id;
        
        $query = Payments::join('kiosks', 'payments.kiosk_id', '=', 'kiosks.id')
                        ->join('users', 'payments.user_id', '=', 'users.id')
                        ->select(
                            'kiosks.id as kiosk_id',
                            'payments.payment_id', // Use the actual column name without an alias
                            'payments.payment_type',
                            'payments.payment_date',
                            'payments.payment_status'
                        );



        $sort = strtolower($request->input('sort', 'all'));

        if ($sort !== 'all') {
            switch ($sort) {
                case 'pending':
                    $query->where('payments.payment_status', 'Pending');
                    break;
                case 'approved':
                    $query->where('payments.payment_status', 'Approved');
                    break;
                case 'rejected':
                    $query->where('payments.payment_status', 'Rejected');
                    break;
                case 'new':
                    $query->where('payments.payment_status', 'New');
                    break;
            }
        }

        // Search logic based on the search query
        $searchQuery = $request->input('search');
        if ($searchQuery) {
            $query->where(function ($subquery) use ($searchQuery) {
                $subquery->where('payments.payment_type', 'like', '%' . $searchQuery . '%')
                    ->orWhere('payments.payment_date', 'like', '%' . $searchQuery . '%');
            });
        }

        // Execute the query with pagination
        $kioskPayments = $query->paginate(10);

        // Pass the data to the view along with the current sorting option and search query
        return view('managePayment.kioskParticipant.viewPaymentHistory', [
            'kioskPayments' => $kioskPayments,
            'currentSort' => $sort,
            'currentSearch' => $searchQuery,
        ]);
    }

    //To update payment information
    public function editPayment(Request $request, $id)
    {
        // Validate and update the payment data
        $request->validate([
            'kiosk_id' => 'required|numeric',
            'payment_type' => 'required|string',
            'payment_amount' => 'required|numeric',
            'payment_date' => 'required|date_format:Y-m-d',
            'payment_receipt' => 'required|mimes:pdf|max:10240',

        ]);

        $payment_receipt = $request->file('payment_receipt')->storeAs('payments', 'receipt_' . time() . '.pdf', 'public');


        // Update payment data
        $application = Applications::findOrFail($id);

        $application->update([
            'business_name' => $request->input('business_name'),
            'business_role' => $request->input('business_role'),
            'business_category' => $request->input('business_category'),
            'business_information' => $request->input('business_information'),
            'business_operating_hour' => $request->input('business_operating_hour'),

        ]);

        // Pass the updated application data to the view
        return view('manageKiosk.manageApplication.EditKiosk', ['application' => $application])
            ->with('success', 'Kiosk information updated successfully.');
    }

}
