<?php

namespace App\Http\Controllers\Web\App;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Report;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recentReports = Report::orderBy('created_at', 'desc')->limit(5)->get();

        return view('pages.app.home', compact('recentReports'));
    }
}
