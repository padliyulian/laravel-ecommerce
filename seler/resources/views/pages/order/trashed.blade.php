
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
                    <h1>Trash</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Trash</li>
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
                @include('alerts.alert')
                <table class="table table-bordered table-stripped">
                    <thead>
                        <th>Order ID</th>
                        <th>Grand Total</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>    
                                <td>
                                    {{ $order->code }}<br>
                                    <span style="font-size: 12px; font-weight: normal"> {{\General::datetimeFormat($order->order_date) }}</span>
                                </td>
                                <td>{{\General::priceFormat($order->grand_total) }}</td>
                                <td>
                                    {{ $order->customer_full_name }}<br>
                                    <span style="font-size: 12px; font-weight: normal"> {{ $order->customer_email }}</span>
                                </td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>
                                    <a href="{{ url('orders/edit/'. $order->id) }}" class="btn btn-info btn-sm">show</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{$orders->links('vendor.pagination.custom')}}
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
