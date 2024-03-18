<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportStatusRequest;
use App\Models\Report;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class ReportStatusController extends Controller
{
    public function store(StoreReportStatusRequest $request)
    {
        $report = Report::findOrFail($request->report_id);

        $report->statuses()->create([
            'status' => $request->status,
            'description' => $request->description,
            'image' => $request->file('image'),
        ]);

        Swal::toast('Status laporan berhasil diperbarui.', 'success');

        return redirect()->route('admin.reports.show', $report->id);
    }
}
