<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::whereHas('statuses', function ($query) {
            $query->where('status', 'Menunggu');
        })->orderBy('created_at', 'asc')->get();

        return view('pages.admin.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        $statuses = $report->statuses()->oldest()->get();

        return view('pages.admin.reports.show', compact('report', 'statuses'));
    }
}
