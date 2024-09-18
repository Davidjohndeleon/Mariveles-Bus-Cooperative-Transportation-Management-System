<?php

namespace App\Http\Controllers;
use App\Models\Report;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function index()
    { 
        $reports = Report::with('bus', 'user')->get();
        
        return view('admin.reports.index', compact('reports'));
    }
}
