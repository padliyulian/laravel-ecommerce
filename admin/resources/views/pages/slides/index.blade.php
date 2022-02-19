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
                    <h1>Slide</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Slide</li>
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
                        <a href="{{url('/slides/create')}}" class="btn btn-primary btn-block">Add</a>
                    </div>
                </div>
                <table class="table table-bordered table-stripped">
                    <thead>
                        <th>#</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($slides as $slide)
                            <tr>    
                                <td>{{ $slide->id }}</td>
                                <td>{{ $slide->title }}</td>
                                <td><img src="{{ asset('storage'. $slide->small) }}" /></td>
                                <td>
                                    @if ($slide->prevSlide())
                                        <a href="{{ url('slides/up/'.$slide->id) }}">up</a>
                                    @else
                                        up
                                    @endif
                                     | 
                                    @if ($slide->nextSlide())
                                        <a href="{{ url('slides/down/'.$slide->id) }}">down</a>
                                    @else
                                        down
                                    @endif
                                </td>
                                <td>{{ $slide->status }}</td>
                                <td class="text-center">
                                    <a href="{{url('slides/edit/'.$slide->id)}}" class="text-warning" title="Edit">
                                        <span>
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                    <form action="{{url('/slides/'.$slide->id)}}" method="POST" class="d-inline">
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
                                <td colspan="6">No records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{$slides->links('vendor.pagination.custom')}}
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
</script>
@endsection
