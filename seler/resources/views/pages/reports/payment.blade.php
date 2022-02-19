
@extends('layouts.master')

@section('inline-css')
<style>
    .c-w75 {
        width: 75px;
    }
    .c--pointer {
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Payment</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        @include('alerts.alert')
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
				@include('pages.reports.filter')
				<table class="table table-bordered table-striped">
					<thead>
						<th>Order ID</th>
						<th>Date</th>
						<th>Status</th>
						<th>Amount</th>
						<th>Gateway</th>
						<th>Payment Type</th>
						<th>Ref</th>
					</thead>
					<tbody>
						@forelse ($payments as $payment)
							<tr>    
								<td>{{ $payment->code }}</td>
								<td>{{ \General::datetimeFormat($payment->created_at) }}</td>
								<td>{{ $payment->status }}</td>
								<td>{{ \General::priceFormat($payment->amount) }}</td>
								<td>{{ $payment->method }}</td>
								<td>{{ $payment->payment_type }}</td>
								<td>{{ $payment->token }}</td>
							</tr>
						@empty
							<tr>
								<td colspan="8">No records found</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
            <div class="card-footer">
            </div>
        </div>

    </section>
</div>
@endsection

@section('inline-js')
<script src="{{asset('assets/js/sweetalert2@10.js')}}"></script>
<script>
    $(document).ready(function(){

    })  
</script>
@endsection


