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
    public function showAddPaymentForm()
    {
        $user = Auth::user();

        return view('managePayment.kioskParticipant.createPayment');

    }

    /**
     * Show the form for creating a new resource.
     */

   
     //To store payment
    public function addPayment(Request $request)
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
                'payment_status' => 'Pending',
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
        // Assuming you have user authentication and want to retrieve payments for the authenticated user
        $userId = auth()->user()->id;
        
        $query = Payments::join('kiosks', 'payments.kiosk_id', '=', 'kiosks.id')
                        ->join('users', 'payments.user_id', '=', 'users.id')
                        ->select(
                            'kiosks.id as kiosk_id',
                            'payments.payment_id', // Use the actual column name without an alias
                            'payments.payment_type',
                            'payments.payment_date',
                            'payments.payment_status',
                            'payments.payment_comment',
                        );



        $sort = strtolower($request->input('sort', 'all'));

        if ($sort !== 'all') {
            switch ($sort) {
                case 'approved':
                    $query->where('payments.payment_status', 'Approved');
                    break;
                case 'pending':
                    $query->where('payments.payment_status', 'Pending');
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




    //edit payment form
    public function viewEditPayment($id)
    {
        // Fetch the payment data based on the ID
        $payment = Payments::findOrFail($id);

        // Pass the payment data to the view
        return view('managePayment.kioskParticipant.editPayment', ['payment' => $payment]);
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

        ]);

        // Update payment data
        $payment = Payments::findOrFail($id);

        $payment->update([
            'user_id' => Auth::id(),
            'kiosk_id' => $request->input('kiosk_id'),
            'payment_type' => $request->input('payment_type'),
            'payment_amount' => $request->input('payment_amount'),
            'payment_date' => $request->input('payment_date'),

        ]);

        // Pass the updated payment data to the view
        return view('managePayment.kioskParticipant.editPayment', ['payment' => $payment])
            ->with('success', 'Payment information updated successfully.');
    }





    public function viewPaymentDetails($id)
    {
        // Get the authenticated user's ID
        $userId = auth()->user()->id;

        // Fetch data based on user ID and payment ID
        $data = Payments::where('user_id', $userId)
                        ->where('payment_id', $id)
                        ->first(); // Assuming you expect only one result

        // Pass the data to the view
        return view('managePayment.kioskParticipant.viewPaymentDetails', ['payment' => $data]);
    }





    public function deletePayment($id)
    {
        // Find the payment by id and delete it
        Payments::find($id)->delete();


        // Redirect back or wherever you want
        return redirect()->route('user.viewPaymentHistory')->with('success', 'Payment deleted successfully.');
    }





    // view payment list
    public function viewAllPayment(Request $request)
    {
        // Fetch payment data from the payments table and related user data
        $query = Payments::join('kiosks', 'payments.kiosk_id', '=', 'kiosks.id')
                    ->join('users', 'payments.user_id', '=', 'users.id')
                    ->select(
                        'payments.payment_id',
                        'kiosks.id as kiosk_id',
                        'payments.payment_type',
                        'users.email',
                        'users.contact',
                        'payments.created_at',
                        'payments.updated_at',
                        'payments.payment_status',
                        'payments.payment_comment',
                );

        //filter payment status
        $sort = strtolower($request->input('sort', 'all'));

        if ($sort !== 'all') {
            switch ($sort) {
                case 'approved':
                    $query->where('payments.payment_status', 'Approved');
                    break;
                case 'pending':
                    $query->where('payments.payment_status', 'Pending');
                    break;
                case 'rejected':
                    $query->where('payments.payment_status', 'Rejected');
                    break;
            }
        }

        // Search logic based on the search query
        $searchQuery = $request->input('search');
        if ($searchQuery) {
            $query->where(function ($subquery) use ($searchQuery) {
                $subquery->where('kiosks.kiosk_id', 'like', '%' . $searchQuery . '%')
                    ->orWhere('payments.payment_id', 'like', '%' . $searchQuery . '%')
                    ->orWhere('users.email', 'like', '%' . $searchQuery . '%')
                    ->orWhere('users.ic', 'like', '%' . $searchQuery . '%');
            });
        }

        // Execute the query with pagination
        $kioskPayments = $query->paginate(10);

        // Pass the data to the view along with the current sorting option and search query
        return view('managePayment.fkBursary.viewPaymentList', [
            'kioskPayments' => $kioskPayments,
            'currentSort' => $sort,
            'currentSearch' => $searchQuery,
        ]);
    }





    public function processPayment(Request $request, $id)
    {

        $payment = Payments::findOrFail($id);

        // Validate the request
        $request->validate([
            'payment_comment' => 'nullable|string',
        ]);

        // Update payment status and comment
        $payment->update([
            'payment_status' => ($request->input('action') === 'approve') ? 'Approved' : 'Rejected',
            'payment_comment' => $request->input('payment_comment'),
        ]);

        return redirect()->route('bursary.viewAllPayment', ['id' => $id])->with('success', 'Payment processed successfully.');
    }






//    // View payment details
//     public function viewPayment($id)
//     {
//         // Fetch payment details
//         $payment = Payments::findOrFail($id);
//         $user = $payment->user;

//         return view('managePayment.fkBursary.paymentApproval', ['payment' => $payment, 'user' => $user]);
//     }





    //viewPaymentApproval
    public function paymentApproval($id)
    {
        // // Fetch payment details
        $payment = Payments::findOrFail($id);
        $user = $payment->user;

        // Fetch payment data from the payments table and related user data
        $query = Payments::join('kiosks', 'payments.kiosk_id', '=', 'kiosks.id')
                    ->join('users', 'payments.user_id', '=', 'users.id')
                    ->select(
                        'payments.payment_id',
                        'kiosks.id as kiosk_id',
                        'payments.payment_type',
                        'payments.payment_amount',
                        'payments.payment_receipt',
                        'payments.payment_date',
                        'users.name',
                        'users.email',
                        'users.contact',
                        'payments.payment_status',
                        'payments.payment_comment',
                );

        return view('managePayment.fkBursary.paymentApproval', ['payment' => $payment, 'user' => $user]);
    }


}
