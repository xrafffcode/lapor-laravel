<?php

namespace App\Http\Controllers\Web\App;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->get();

        return view('pages.app.reports.index', compact('reports'));
    }

    public function myReport()
    {
        $reports = auth()->user()->resident->reports()->latest()->get();

        return view('pages.app.reports.my-report', compact('reports'));
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);

        $statuses = $report->statuses()->oldest()->get();

        return view('pages.app.reports.show', compact('report', 'statuses'));
    }

    public function take()
    {
        return view('pages.app.reports.take');
    }

    public function preview()
    {
        return view('pages.app.reports.preview');
    }

    public function create()
    {
        return view('pages.app.reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'title' => 'required',
            'description' => 'required',
        ], [
            'image.required' => 'Foto tidak boleh kosong',
            'title.required' => 'Judul tidak boleh kosong',
            'description.required' => 'Deskripsi tidak boleh kosong',
        ]);

        $data = $request->all();

        $decodedImage = base64_decode(explode(',', $request->image)[1]);

        $data['resident_id'] = auth()->user()->resident->id;
        $data['code'] = 'SCP' . Carbon::now()->format('Ymd') . rand(1000, 9999);
        $data['image'] = 'assets/reports/' . auth()->user()->resident->id . '/' . uniqid() . '.jpg';

        Storage::disk('public')->put($data['image'], $decodedImage);



        $report = auth()->user()->resident->reports()->create($data);

        $report->statuses()->create([
            'status' => 'Menunggu',
            'description' => 'Laporan sedang menunggu untuk diproses',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dibuat',
            'data' => $report
        ]);
    }

    public function success()
    {
        return view('pages.app.reports.success');
    }
}
