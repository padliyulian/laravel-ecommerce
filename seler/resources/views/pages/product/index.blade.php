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
                    <h1>Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product</li>
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
                    <div class="form-group col-lg-2">
                        <a href="{{url('/product/create')}}" class="btn btn-primary btn-block">Add</a>
                    </div>
                    <div class="form-group col-lg-2">
                        <a href="{{url('/product')}}" class="btn btn-info btn-block">Reset</a>
                    </div>
                    <div class="form-group col-lg-2">
                        <select onchange="changeLength()" name="length" id="length" class="custom-select">
                            <option value="10" {{request()->get('length') == 2 ? 'selected':''}}>10</option>
                            <option value="25" {{request()->get('length') == 25 ? 'selected':''}}>25</option>
                            <option value="50" {{request()->get('length') == 50 ? 'selected':''}}>50</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <input value="{{request()->get('search') ? request()->get('search'):''}}" class="form-control" type="text" name="search" id="search" placeholder="Cari data ...">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-hover table-striped table-responsive-sm">
                            <thead>
                                <tr>
                                    <th onclick="sortBy('id')" class="text-center c--pointer" scope="col"><i class="fas fa-sort"></i> ID</th>
                                    <th onclick="sortBy('sku')" class="c--pointer" scope="col"><i class="fas fa-sort"></i> SKU</th>
                                    <th onclick="sortBy('type')" class="c--pointer" scope="col"><i class="fas fa-sort"></i> Type</th>
                                    <th onclick="sortBy('name')" class="c--pointer" scope="col"><i class="fas fa-sort"></i> Name</th>
                                    <th onclick="sortBy('price')" class="c--pointer" scope="col"><i class="fas fa-sort"></i> Price</th>
                                    <th onclick="sortBy('status')" class="c--pointer" scope="col"><i class="fas fa-sort"></i> Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $item)
                                    <tr>
                                        <td class="text-center">{{$item->id}}</td>
                                        <td>{{$item->sku}}</td>
                                        <td>{{$item->type}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->statusLabel()}}</td>
                                        <td class="text-center">
                                            <a href="{{url('/product/edit/'.$item->id)}}" class="text-warning" title="Edit">
                                                <span>
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </span>
                                            </a>
                                            <form action="{{url('/product/'.$item->id)}}" method="POST" class="d-inline">
                                                @csrf
                                                @method("DELETE")
                                                <a href="#" class="text-danger js-btn--delete" title="Delete">
                                                    <span>
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </span>
                                                </a>
                                            </form>
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
                {{$products->links('vendor.pagination.custom')}}
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

    var app_url = @JSON(env('APP_URL').'/product?page=1');
    var dir = @JSON(request()->get('dir'));
    var key = 'id'

    if (!dir) dir = 'desc'

    function sortBy(column) {
        key = column
        if (dir == 'desc') dir = 'asc'
        else dir = 'desc'

        getData(`${app_url}&length=${$('#length').val()}&column=${key}&dir=${dir}&search=${$('#search').val()}`)
    }

    function changeLength() {
        getData(`${app_url}&length=${$('#length').val()}&column=${key}&dir=${dir}&search=${$('#search').val()}`)
    }

    $('#search').on('keyup', function(ev){
        if (ev.keyCode === 13) {
            getData(`${app_url}&length=${$('#length').val()}&column=${key}&dir=${dir}&search=${$('#search').val()}`)
        }
    })

    function getData(url) {
        location.href = url
    }
</script>
@endsection
