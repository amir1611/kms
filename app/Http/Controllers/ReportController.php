<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Report;
use App\Models\Kiosk;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

//  @foreach($kiosks as $kiosk)
// <option value="{{ $kiosk->id }}">1</option>
// @endforeach

class ReportController extends Controller
{

    public function uploadReportData(Request $request)
    {
        try {

            $request->validate([
                'kioskValue' => 'required|numeric',
                'revenue_Ringgit' => 'required|numeric',
                'revenue_Sen' => 'required|numeric',
                'optHours' => 'required|string',
                'remark' => 'required|string',
                'monthPicker' => 'required|date_format:Y-m',
                'formFile' => 'required|mimes:pdf|max:10240',
            ]);

            if ($request->hasFile('formFile') && $request->file('formFile')->isValid()) {
                $file = $request->file('formFile');
                $filePath = $file->store('reports', 'public');
            } else {
                // Handle file validation failure
                return redirect()->route('user.reportList');
                return redirect()->back()->withErrors(['formFile' => 'Invalid file.']);
            }


            $report = new Report([
                'kiosk_id' => $request->input('kioskValue'),
                'report_month' => $request->input('monthPicker'),
                'report_monthly_revenue' => $request->input('revenue_Ringgit') + ($request->input('revenue_Sen') / 100),
                'report_operating_hour' => $request->input('optHours'),
                'report_remark' => $request->input('remark'),
                'report_pdf' => $filePath,
                'report_status' => 'Under Review',
                'report_suggestion' => '',
            ]);


            $report->save();


            return redirect()->route('user.reportList');
        } catch (\Throwable $th) {
            return view('error', [
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function viewReport($id)
    {
        $report = Report::find($id);
        return view('manageReport.kioskParticipant.viewMonthlyReport', [
            'report' => $report
        ]);
        // $this->generateMonthlySaleReport('user');
    }

    public function showKioskListById()
    {
        $kiosks = Kiosk::where('user_id', auth()->user()->id)->get();
        return view('manageReport.kioskParticipant.uploadMonthlyReport', [
            'kiosks' => $kiosks
        ]);
    }

    public function viewAllKioskParticipantReport()
    {
        // Assuming you have user authentication and want to retrieve reports for the authenticated user
        $userId = auth()->user()->id;

        // Retrieve reports for the authenticated user
        $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
            ->where('kiosks.user_id', $userId)
            ->select(
                'reports.*',
            )->paginate(4);

        $revenues = $this->generateMonthlySaleReport('user');

        return view('manageReport.kioskParticipant.viewMonthlyReportList', compact('reports', 'revenues'));
    }

    public function displayEditKioskParticipantReport($id)
    {
        $userRole = auth()->user()->role;

        if ($userRole == 'user') {
            $kiosks = Kiosk::where('user_id', auth()->user()->id)->get();
            $report = Report::find($id);
            return view('manageReport.kioskParticipant.editMonthlyReport', [
                'report' => $report,
                'kiosks' => $kiosks
            ]);
        } else if ($userRole == 'pupuk-admin') {


            $report = Report::find($id);

            return view('manageReport.pupukAdmin.approveMonthlyReport', [
                'report' => $report
            ]);
        }
    }

    public function editKioskParticipantReport(Request $request, $id)
    {


        try {

            $userRole = auth()->user()->role;

            if ($userRole == 'user') {
                $request->validate([
                    'kioskValue' => 'required|numeric',
                    'revenue_Ringgit' => 'required|numeric',
                    'revenue_Sen' => 'required|numeric',
                    'optHours' => 'required|string',
                    'remark' => 'required|string'
                ]);

                if ($request->hasFile('formFile') && $request->file('formFile')->isValid()) {
                    $file = $request->file('formFile');
                    $filePath = $file->store('reports', 'public');

                    Report::where('id', $id)->update(
                        array(
                            'kiosk_id' => $request->input('kioskValue'),
                            'report_month' => $request->input('monthPicker'),
                            'report_monthly_revenue' => $request->input('revenue_Ringgit') + ($request->input('revenue_Sen') / 100),
                            'report_operating_hour' => $request->input('optHours'),
                            'report_remark' => $request->input('remark'),
                            'report_pdf' => $filePath,
                        )
                    );
                } else {

                    Report::where('id', $id)->update(
                        array(
                            'kiosk_id' => $request->input('kioskValue'),
                            'report_month' => $request->input('monthPicker'),
                            'report_monthly_revenue' => $request->input('revenue_Ringgit') + ($request->input('revenue_Sen') / 100),
                            'report_operating_hour' => $request->input('optHours'),
                            'report_remark' => $request->input('remark')
                        )
                    );
                }




                return redirect()->route('user.reportList');
            } else if ($userRole == 'pupuk-admin') {
                $request->validate([
                    'status' => 'required|string',
                ]);

                Report::where('id', $id)->update(
                    array(
                        'report_status' => $request->input('status'),
                        'report_suggestion' => $request->input('suggest') ?? '',
                    )
                );





                return redirect()->route('pupuk.reportList');
            }
        } catch (\Throwable $th) {
            return view('error', [
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function deleteKioskParticipantReport($id)
    {
        try {
            $report = Report::find($id);
            Storage::disk('public')->delete($report->report_pdf);
            $report->delete();
            return redirect()->route('user.reportList');
        } catch (\Throwable $th) {
            return view('error', [
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function filterTable()
    {

        $filterData = request('filterData');
        $userRole = auth()->user()->role;

        if ($userRole == 'user') {
            $userId = auth()->user()->id;
            if ($filterData == 'All') {
                $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
                    ->where('kiosks.user_id', $userId)
                    ->select(
                        'reports.*',
                    )->paginate(5);
            } elseif ($filterData == 'Under-Review') {
                $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
                    ->where('kiosks.user_id', $userId)
                    ->where('reports.report_status', 'Under Review')
                    ->select(
                        'reports.*',
                    )->paginate(5);
            } elseif ($filterData == 'Approve') {
                $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
                    ->where('kiosks.user_id', $userId)
                    ->where('reports.report_status', 'Approve')
                    ->select(
                        'reports.*',
                    )->paginate(5);
            } elseif ($filterData == 'Reject') {
                $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
                    ->where('kiosks.user_id', $userId)
                    ->where('reports.report_status', 'Reject')
                    ->select(
                        'reports.*',
                    )->paginate(5);
            } elseif ($filterData == 'Asc') {
                $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
                    ->where('kiosks.user_id', $userId)
                    ->orderBy('reports.report_month', 'asc')
                    ->select(
                        'reports.*',
                    )->paginate(5);
            } elseif ($filterData == 'Desc') {
                $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
                    ->where('kiosks.user_id', $userId)
                    ->orderBy('reports.report_month', 'desc')
                    ->select(
                        'reports.*',
                    )->paginate(5);
            }

            $revenues = $this->generateMonthlySaleReport($userRole);

            return view('manageReport.kioskParticipant.viewMonthlyReportList', compact('reports', 'revenues'));
        } else if ($userRole == 'pupuk-admin') {

            if ($filterData == 'All') {
                $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
                    ->join('users', 'users.id', '=', 'kiosks.user_id')
                    ->select('reports.*', 'users.name')
                    ->paginate(4);
            } elseif ($filterData == 'Under-Review') {
                $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
                    ->join('users', 'users.id', '=', 'kiosks.user_id')
                    ->where('reports.report_status', 'Under Review')
                    ->select('reports.*', 'users.name')
                    ->paginate(5);
            } elseif ($filterData == 'Approve') {
                $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
                    ->join('users', 'users.id', '=', 'kiosks.user_id')
                    ->where('reports.report_status', 'Approve')
                    ->select('reports.*', 'users.name')
                    ->paginate(5);
            } elseif ($filterData == 'Reject') {
                $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
                    ->join('users', 'users.id', '=', 'kiosks.user_id')
                    ->where('reports.report_status', 'Reject')
                    ->select('reports.*', 'users.name')
                    ->paginate(5);
            } elseif ($filterData == 'Asc') {
                $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
                    ->join('users', 'users.id', '=', 'kiosks.user_id')
                    ->orderBy('reports.report_month', 'asc')
                    ->select('reports.*', 'users.name')
                    ->paginate(5);
            } elseif ($filterData == 'Desc') {
                $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
                    ->join('users', 'users.id', '=', 'kiosks.user_id')
                    ->orderBy('reports.report_month', 'desc')
                    ->select('reports.*', 'users.name')
                    ->paginate(5);
            }

            $revenues = $this->generateMonthlySaleReport($userRole);

            return view('manageReport.pupukAdmin.viewAllMonthlyReport', compact('reports', 'revenues'));
        }
    }

    public function searchReport(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $userRole = auth()->user()->role;

        if ($userRole == 'user') {
            $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
                ->where('reports.kiosk_id', 'LIKE', '%' . $searchTerm . '%')
                ->select(
                    'reports.*',
                )->paginate(5);

            $revenues = $this->generateMonthlySaleReport($userRole);

            return view('manageReport.kioskParticipant.viewMonthlyReportList', compact('reports', 'revenues'));
        } else if ($userRole == 'pupuk-admin') {
            $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
                ->join('users', 'users.id', '=', 'kiosks.user_id')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('reports.kiosk_id', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('users.name', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('reports.report_month', 'LIKE', '%' . $searchTerm . '%');
                })
                ->select('reports.*', 'users.name')
                ->paginate(4);


            $revenues = $this->generateMonthlySaleReport($userRole);

            return view('manageReport.pupukAdmin.viewAllMonthlyReport', compact('reports', 'revenues'));
        }
    }

    public function generateMonthlySaleReport($userRole)
    {

        if ($userRole == 'user') {
            $userId = auth()->user()->id;

            // Your existing logic for filtering reports

            $report = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
             ->where('kiosks.user_id', $userId)
            ->orderBy('report_month')
            ->select(DB::raw('DATE_FORMAT(reports.report_month, "%Y-%m") as report_month'), 'report_monthly_revenue')
            ->get();

            // $formattedData = $report->map(function ($entry) {
            //     $entry->report_month = Carbon::parse($entry->report_month)->format('F'); // 'F' means full month name
            //     return $entry;
            // });

     



            // $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
            //     ->where('kiosks.user_id', $userId)
            //     ->select('reports.*')
            //     ->get();

           // $aggregatedData = [];

            // foreach ($reports as $report) {
            //     $kioskId = $report->kiosk_id;
            //     $month = $report->report_month;
            //     $revenue = $report->report_monthly_revenue;

            //     if (!isset($aggregatedData[$kioskId])) {
            //         $aggregatedData[$kioskId] = [];
            //     }

            //     if (!isset($aggregatedData[$kioskId][$month])) {
            //         $aggregatedData[$kioskId][$month] = 0;
            //     }

            //     $aggregatedData[$kioskId][$month] += $revenue;
            // }

            $revenues = $report;
        } else if ($userRole == 'pupuk-admin') {
            $reports = Report::where('reports.report_status', 'Approve')->get();

            // Extracting report_monthly_revenue values
            $revenues = $reports->groupBy('kiosk_id')->map(function ($group) {
                return $group->sum('report_monthly_revenue');
            });
        }

        return $revenues;
    }

    public function viewAllReport()
    {

        //   $reports = Report::paginate(4);
        $reports = Report::join('kiosks', 'kiosks.id', '=', 'reports.kiosk_id')
            ->join('users', 'users.id', '=', 'kiosks.user_id')
            ->select(
                'reports.*',
                'users.name'
            )->paginate(4);

        $userRole = auth()->user()->role;

        $revenues = $this->generateMonthlySaleReport($userRole);


        return view('manageReport.pupukAdmin.viewAllMonthlyReport', compact('reports', 'revenues'));
    }
}
