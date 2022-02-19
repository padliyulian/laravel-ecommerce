@extends('layouts.master')

@section('inline-css')
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
                        <li class="breadcrumb-item"><a href="{{url('/product')}}">Product</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        @include('alerts.alert')
        <div class="row">
            <div class="col-12 col-lg-3">
                @include('pages.product.menu')
            </div>
            <div class="col-12 col-lg-9">
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
                            <div class="col-12">
                                <table class="table table-hover table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th>Image</th>
                                            <th>Upload Date</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody>
                                            @forelse ($productImages as $image)
                                                <tr>
                                                    <td class="text-center">{{ $image->id }}</td>
                                                    <td><img src="{{ asset('storage/'.$image->small) }}" style="width:150px"/></td>
                                                    <td>{{ $image->created_at }}</td>
                                                    <td>
                                                        <form action="{{url('/product/image/'.$image->id)}}" method="POST" class="d-inline">
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
                                                    <td colspan="4" class="text-center">No records found ...</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                            <div class="col-12 text-right">
                                <a href="{{url('/product/image/create/'.$product->id)}}" class="btn btn-primary">Add Image</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
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
</script>
@endsection
