<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    //
    public function index(Request $request) 
    {
    	$date_object = [
    		'year' => $request->year,
    		'month' => $request->month,
    		'date' => $request->date
    	];
    	$transactions = Transaction::getByDate(Auth::user(), $date_object)->get();
    	$dt = Carbon::create($date_object['year'],$date_object['month'],$date_object['date'])->format('d M, Y');
    	return view('reports.basic-report', compact('transactions', 'dt'));
    }
}
