@extends('layouts.master')

@section('inline-css')
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attribute Option</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/product/attribute')}}">Attribute</a></li>
                        <li class="breadcrumb-item active">Attribute Option</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        @include('alerts.success')
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add Option</h5>
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
                        @php
                            $save = true; 
                            $id = $attribute->id   
                        @endphp

                        @isset($attributeOption)
                            @php
                                $save = false;   
                                $id = $attributeOption->id;
                            @endphp
                        @endisset
                        <form action="{{url('/product/attribute/option/'.$id)}}" method="POST">
                            @csrf

                            @if ($save)
                                @method('POST')          
                            @else
                                @method('PATCH')
                            @endif
                            
                            <div class="row">
                                @isset($attributeOption)
                                    <input type="hidden" name="attr_id" value="{{$attributeOption->id}}">
                                @endisset
                                <div class="form-group col-12">
                                    @if ($save)
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name">       
                                    @else
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $attributeOption->name }}" placeholder="Name">
                                    @endif
                                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary">{{$save ? 'Save':'Update'}}</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
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
                                            <th>Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        <tbody>
                                            @forelse ($attribute->attributeOptions as $option)
                                                <tr>
                                                    <td class="text-center">{{ $option->id }}</td>
                                                    <td>{{ $option->name }}</td>
                                                    <td class="text-center">
                                                        <a href="{{url('/product/attribute/option/edit/'.$option->id)}}" class="text-warning" title="Edit">
                                                            <span>
                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                            </span>
                                                        </a>
                                                        <form action="{{url('/product/attribute/option/'.$option->id)}}" method="POST" class="d-inline">
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
                                                    <td colspan="3" class="text-center">No records found ...</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </thead>
                                </table>
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

