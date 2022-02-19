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
                        <li class="breadcrumb-item active">Order</li>
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
                    <div class="form-group col-lg-1">
                        <a href="{{url('/orders')}}" class="btn btn-info btn-block">Reset</a>
                    </div>
                    <div class="form-group col-lg-1">
                        <select onchange="changeLength()" name="length" id="length" class="custom-select">
                            <option value="10" {{request()->get('length') == 2 ? 'selected':''}}>10</option>
                            <option value="25" {{request()->get('length') == 25 ? 'selected':''}}>25</option>
                            <option value="50" {{request()->get('length') == 50 ? 'selected':''}}>50</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-2">
                        <select onchange="groupBy('status')" name="status" id="status" class="custom-select">
                            <option value="all" selected>Status</option>
                            @foreach ($statuses as $status)
                                <option value="{{$status}}" {{request()->get('status') == strtolower($status) ? 'selected':''}}>{{$status}}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-2">
                        <input value="{{request()->get('start') ? request()->get('start'):''}}" class="form-control" type="date" name="start" id="start">
                    </div>
                    <div class="form-group col-lg-2">
                        <input value="{{request()->get('end') ? request()->get('end'):''}}" class="form-control" type="date" name="end" id="end">
                    </div>
                    <div class="form-group col-lg-4">
                        <input value="{{request()->get('search') ? request()->get('search'):''}}" class="form-control" type="text" name="search" id="search" placeholder="Cari data ...">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-hover table-striped table-responsive-sm">
                            <thead>
                                <tr>
                                    <th onclick="sortBy('code')" class="c--pointer" scope="col"><i class="fas fa-sort"></i> Order ID</th>
                                    <th onclick="sortBy('grand_total')" class="c--pointer" scope="col"><i class="fas fa-sort"></i> Grand Total</th>
                                    <th class="c--pointer" scope="col">Name</th>
                                    <th onclick="sortBy('status')" class="c--pointer" scope="col"><i class="fas fa-sort"></i> Status</th>
                                    <th onclick="sortBy('payment_status')" class="c--pointer" scope="col"><i class="fas fa-sort"></i> Payment</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $item)
                                    <tr>
                                        <td>
                                            {{$item->code}} <br>
											<span style="font-size: 12px; font-weight: normal">
                                                {{\General::datetimeFormat($item->order_date) }}
                                            </span>
                                        </td>
                                        <td>{{\General::priceFormat($item->grand_total) }}</td>
                                        <td>
                                            {{ $item->customer_full_name }} <br>
											<span style="font-size: 12px; font-weight: normal">
                                                {{ $item->customer_email }}
                                            </span>
                                        </td>
                                        <td>{{$item->status}}</td>
                                        <td>{{$item->payment_status}}</td>
                                        <td class="text-center">
                                            <a href="{{url('/orders/edit/'.$item->id)}}" class="text-warning" title="Edit">
                                                <span>
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data ...</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
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
        $('.js-btn--delete').on('click', function(ev){
            ev.preventDefault()
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().submit()
                    }
                })
        })
    })

    var app_url = @JSON(env('APP_URL').'/orders?page=1');
    var dir = @JSON(request()->get('dir'));
    var key = 'id'

    if (!dir) dir = 'desc'

    function sortBy(column) {
        key = column
        if (dir == 'desc') dir = 'asc'
        else dir = 'desc'

        getData(`${app_url}&length=${$('#length').val()}&column=${key}&dir=${dir}&status=${$('#status').val().toLowerCase()}&search=${$('#search').val()}&start=${$('#start').val()}&end=${$('#end').val()}`)
    }

    function changeLength() {
        getData(`${app_url}&length=${$('#length').val()}&column=${key}&dir=${dir}&status=${$('#status').val().toLowerCase()}&search=${$('#search').val()}&start=${$('#start').val()}&end=${$('#end').val()}`)
    }

    $('#search').on('keyup', function(ev){
        if (ev.keyCode === 13) {
            getData(`${app_url}&length=${$('#length').val()}&column=${key}&dir=${dir}&status=${$('#status').val().toLowerCase()}&search=${$('#search').val()}&start=${$('#start').val()}&end=${$('#end').val()}`)
        }
    })

    function groupBy(field) {
        getData(`${app_url}&length=${$('#length').val()}&column=${key}&dir=${dir}&${field}=${$('#status').val().toLowerCase()}&search=${$('#search').val()}&start=${$('#start').val()}&end=${$('#end').val()}`)
    }

    $('#end').on('change', function(){
        getData(`${app_url}&length=${$('#length').val()}&column=${key}&dir=${dir}&status=${$('#status').val().toLowerCase()}&search=${$('#search').val()}&start=${$('#start').val()}&end=${$('#end').val()}`)
    })

    function getData(url) {
        location.href = url
    }
</script>
@endsection
