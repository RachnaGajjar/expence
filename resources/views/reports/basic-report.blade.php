@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Report

<div class="btn-group float-right">
  <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{ \Carbon\Carbon::create($year, $month, 1)->format('M-Y') }}
  </button>
  <div class="dropdown-menu dropdown-menu-right">
    @foreach($options as $opt)
        @php $is_active = $year == $opt->year && $month == $opt->month; @endphp
        <a
            class="dropdown-item {{ $is_active ? 'active': ''}}"
            href="{{ $is_active ? '#': route('report', ['year' => $opt->year, 'month' => $opt->month])}}">
            {{ \Carbon\Carbon::create($opt->year, $opt->month, 1)->format('M-Y') }}
        </a>
    @endforeach
  </div>
</div>

                </div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-error" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif



                    @if(count($transactions))
                        <table class="table table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th class="text-right">
                                        Amount
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                @php $total = 0; @endphp
                                @foreach($transactions as $tr)
                                    <tr>
                                        <td> {{ $tr->tr_date->format('d M') }} </td>
                                        <td> {{ $tr->description }} </td>
                                        <td class="text-right"> ₹ {{ number_format($tr->amount, 2, '.', ',') }} </td>
                                    </tr>
                                    @php $total += $tr->amount * ['CR' => -1, 'DB' => 1][$tr->tr_type] @endphp
                                @endforeach
                                <tr class="text-success border-top">
                                    <th colspan="2"> Total </th>
                                    <th class="text-right"> ₹ {{ number_format(abs($total), 2, '.', ',') }} </th>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        No records to display.
                        <a href="{{ route('home') }}">Let's make some entry</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
