@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Expence</div>

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


                    <form action="{{ route('transaction.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input
                                type="text"
                                class="form-control {{@$errors->has('amount')?'is-invalid':''}}"
                                id="amount"
                                placeholder="Enter amount"
                                name="amount"
                                value="{{old('amount')}}">
                            @if(@$errors->has('amount'))
                            <span class="invalid-feedback">
                                {{@$errors->first('amount')}}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input
                                type="text"
                                class="form-control {{@$errors->has('description')?'is-invalid':''}}"
                                id="description"
                                placeholder="Enter description"
                                name="description"
                                value="{{ old('description') }}">
                            @if(@$errors->has('description'))
                            <span class="invalid-feedback">
                                {{@$errors->first('description')}}
                            </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input
                                        type="text"
                                        class="form-control datepicker {{@$errors->has('tr_date')?'is-invalid':''}}"
                                        id="date"
                                        placeholder="Enter date"
                                        name="tr_date"
                                        value="{{ \Carbon\Carbon::now()->format('d M, Y') }}">
                                    @if(@$errors->has('tr_date'))
                                    <span class="invalid-feedback">
                                        {{@$errors->first('tr_date')}}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control" id="type" placeholder="Select type" name="tr_type">
                                        <option value="DB">Debit</option>
                                        <option value="CR">Credit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit"> Save </button>
                        <button class="btn btn-default" type="clear"> Clear </button>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
