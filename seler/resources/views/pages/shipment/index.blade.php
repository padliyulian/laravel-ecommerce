
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
                    <h1>Shipment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Shipment</li>
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
                        <th>Name</th>
                        <th>Status</th>
                        <th>Total Qty</th>
                        <th>Total Weight (gram)</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($shipments as $shipment)
                            <tr>    
                                <td>
                                    {{ $shipment->order->code }}<br>
                                    <span style="font-size: 12px; font-weight: normal"> {{\General::datetimeFormat($shipment->order->order_date) }}</span>
                                </td>
                                <td>{{ $shipment->order->customer_full_name }}</td>
                                <td>
                                    {{ $shipment->status }}
                                    <br>
                                    <span style="font-size: 12px; font-weight: normal"> {{ $shipment->shipped_at }}</span>
                                </td>
                                <td>{{ $shipment->total_qty }}</td>
                                <td>{{ \General::priceFormat($shipment->total_weight) }}</td>
                                <td>
                                    <a href="{{ url('orders/edit/'. $shipment->order->id) }}" class="btn btn-info btn-sm">show</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $shipments->links() }}
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
