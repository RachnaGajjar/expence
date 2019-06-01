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
		$year = $request->year;
		$month = $request->month;
    	$transactions = Transaction::getByMonth(Auth::user(), compact('year', 'month'))->get();

        $options = Transaction::getListOfMonthYear(Auth::user())->get();
    	return view('reports.basic-report', compact('transactions', 'options', 'year', 'month'));
    }
}
