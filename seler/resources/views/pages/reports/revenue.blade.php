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
                        <li class="breadcrumb-item active">Revenue</li>
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
				<table class="table table-striped">
					<thead>
						<th>Date</th>
						<th>Orders</th>
						<th>Gross Revenue</th>
						<th>Taxes</th>
						<th>Shipping</th>
						<th>Net Revenue</th>
					</thead>
					<tbody>
						@php
							$totalOrders = 0;
							$totalGrossRevenue = 0;
							$totalTaxesAmount = 0;
							$totalShippingAmount = 0;
							$totalNetRevenue = 0;
						@endphp
						@forelse ($revenues as $revenue)
							<tr>    
								<td>{{ \General::datetimeFormat($revenue->date, 'd M Y') }}</td>
								<td>
									<a href="{{ url('orders?start='. $revenue->date .'&end='. $revenue->date . '&status=completed') }}">{{ $revenue->num_of_orders }}</a>
								</td>
								<td>{{ \General::priceFormat($revenue->gross_revenue) }}</td>
								<td>{{ \General::priceFormat($revenue->taxes_amount) }}</td>
								<td>{{ \General::priceFormat($revenue->shipping_amount) }}</td>
								<td>{{ \General::priceFormat($revenue->net_revenue) }}</td>
							</tr>

							@php
								$totalOrders += $revenue->num_of_orders;
								$totalGrossRevenue += $revenue->gross_revenue;
								$totalTaxesAmount += $revenue->taxes_amount;
								$totalShippingAmount += $revenue->shipping_amount;
								$totalNetRevenue += $revenue->net_revenue;
							@endphp
						@empty
							<tr>
								<td colspan="6">No records found</td>
							</tr>
						@endforelse
						
						@if ($revenues)
							<tr>
								<td>Total</td>
								<td><strong>{{ $totalOrders }}</strong></td>
								<td><strong>{{ \General::priceFormat($totalGrossRevenue) }}</strong></td>
								<td><strong>{{ \General::priceFormat($totalTaxesAmount) }}</strong></td>
								<td><strong>{{ \General::priceFormat($totalShippingAmount) }}</strong></td>
								<td><strong>{{ \General::priceFormat($totalNetRevenue) }}</strong></td>
							</tr>
						@endif
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
