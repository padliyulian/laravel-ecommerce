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
                    <h1>Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/orders')}}">Order</a></li>
                        <li class="breadcrumb-item active">Detail</li>
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
                <div class="row">
                    <div class="col-12 col-lg-10">
                        <h2 class="text-dark font-weight-medium">Order ID #{{ $order->code }}</h2>
                    </div>
                    <div class="col-12 col-lg-2 text-right">
                        <div class="btn-group">
                            <button class="btn btn-secondary">
                                <i class="mdi mdi-content-save"></i> Save
                            </button>
                            <button class="btn btn-secondary">
                                <i class="mdi mdi-printer"></i> Print
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-12 col-lg-4">
                        <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Billing Address</p>
                        <address>
                            {{ $order->customer_first_name }} {{ $order->customer_last_name }}
                            <br> {{ $order->customer_address1 }}
                            <br> {{ $order->customer_address2 }}
                            <br> Email: {{ $order->customer_email }}
                            <br> Phone: {{ $order->customer_phone }}
                            <br> Postcode: {{ $order->customer_postcode }}
                        </address>
                    </div>
                    <div class="col-12 col-lg-4">
                        <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Shipment Address</p>
                        <address>
                            {{ $order->shipment->first_name }} {{ $order->shipment->last_name }}
                            <br> {{ $order->shipment->address1 }}
                            <br> {{ $order->shipment->address2 }}
                            <br> Email: {{ $order->shipment->email }}
                            <br> Phone: {{ $order->shipment->phone }}
                            <br> Postcode: {{ $order->shipment->postcode }}
                        </address>
                    </div>
                    <div class="col-12 col-lg-4">
                        <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Details</p>
                        <address>
                            ID: <span class="text-dark">#{{ $order->code }}</span>
                            <br> {{ \General::datetimeFormat($order->order_date) }}
                            <br> Status: {{ $order->status }} {{ $order->isCancelled() ? '('. \General::datetimeFormat($order->cancelled_at) .')' : null}}
                            @if ($order->isCancelled())
                                <br> Cancellation Note : {{ $order->cancellation_note}}
                            @endif
                            <br> Payment Status: {{ $order->payment_status }}
                            <br> Shipped by: {{ $order->shipping_service_name }}
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table mt-3 table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Cost</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->sku }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @foreach (json_decode($item->attributes, true) as $key => $attribute)
                                                <div>
                                                    <span>{{ucwords($key)}}</span> : <span>{{$attribute}}</span>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ \General::priceFormat($item->base_price) }}</td>
                                        <td>{{ \General::priceFormat($item->sub_total) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Order item not found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-12 col-lg-5 col-xl-4 col-xl-3 ml-sm-auto">
                        <ul class="list-unstyled mt-4">
                            <li class="mid pb-3 text-dark">Subtotal
                                <span class="d-inline-block float-right text-default">{{ \General::priceFormat($order->base_total_price) }}</span>
                            </li>
                            <li class="mid pb-3 text-dark">Tax(10%)
                                <span class="d-inline-block float-right text-default">{{ \General::priceFormat($order->tax_amount) }}</span>
                            </li>
                            <li class="mid pb-3 text-dark">Shipping Cost
                                <span class="d-inline-block float-right text-default">{{ \General::priceFormat($order->shipping_cost) }}</span>
                            </li>
                            <li class="pb-3 text-dark">Total
                                <span class="d-inline-block float-right">{{ \General::priceFormat($order->grand_total) }}</span>
                            </li>
                        </ul>
                        @if (!$order->trashed())
                            @if ($order->isPaid() && $order->isConfirmed())
                                <a href="{{ url('shipments/edit/'.$order->shipment->id)}}" class="btn btn-block mt-2 btn-primary"> Procced to Shipment</a>
                            @endif

                            @if (in_array($order->status, [\App\Models\Order::CREATED, \App\Models\Order::CONFIRMED]))
                                <a href="{{ url('orders/cancel/'.$order->id)}}" class="btn btn-block mt-2 btn-warning"> Cancel</a>
                            @endif

                            @if ($order->isDelivered())
                                <a href="#" class="btn btn-block mt-2 btn-success" onclick="event.preventDefault();
                                document.getElementById('complete-form-{{ $order->id }}').submit();"> Mark as Completed</a>

                                {!! Form::open(['url' => 'orders/complete/'. $order->id, 'id' => 'complete-form-'. $order->id, 'style' => 'display:none']) !!}
                                {!! Form::close() !!}
                            @endif

                            @if (!in_array($order->status, [\App\Models\Order::DELIVERED, \App\Models\Order::COMPLETED]))
                                <a href="#" class="btn btn-block mt-2 btn-secondary delete" order-id="{{ $order->id }}"> Remove</a>

                                {!! Form::open(['url' => 'orders/'. $order->id, 'class' => 'delete', 'id' => 'delete-form-'. $order->id, 'style' => 'display:none']) !!}
                                {!! Form::hidden('_method', 'DELETE') !!}
                                {!! Form::close() !!}
                            @endif
                        @else
                            <a href="{{ url('orders/restore/'. $order->id)}}" class="btn btn-block mt-2 btn-outline-secondary restore"> Restore</a>
                            <a href="#" class="btn btn-block mt-2 btn-danger delete" order-id="{{ $order->id }}"> Remove Permanently</a>

                            {!! Form::open(['url' => 'orders/'. $order->id, 'class' => 'delete', 'id' => 'delete-form-'. $order->id, 'style' => 'display:none']) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
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
        $('a.delete').on('click', function(ev){
            ev.preventDefault()
            let orderId = $(this).attr('order-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    setTimeout(() => {
                        // document.getElementById('delete-form-' + orderId ).submit()
                        $(`#delete-form-${orderId}`).submit()
                    }, 3000)
                }
            })
        })
    })
</script>
@endsection
