@extends('layouts.master')

@section('inline-css')
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attribute</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/product/attribute')}}">Attribute</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-12">
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
                        <form action="{{url('/product/attribute')}}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="form-group col-12 col-lg-6">
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" placeholder="Code">
                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-lg-6">
                                    <select name="type" class="form-control @error('type') is-invalid @enderror">
                                        <option value="" selected disabled>Select Type</option>
                                        @foreach ($types as $key => $val)
                                            <option value="{{$key}}" {{old('type') == $key ? 'selected':''}}>{{$val}}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <select name="is_required" class="form-control @error('is_required') is-invalid @enderror">
                                        <option value="" selected disabled>Is Required</option>
                                        @foreach ($booleanOptions as $key => $val)
                                            <option value="{{$key}}" {{old('is_required') == $key ? 'selected':''}}>{{$val}}</option>
                                        @endforeach
                                    </select>
                                    @error('is_required')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-lg-6">
                                    <select name="is_unique" class="form-control @error('is_unique') is-invalid @enderror">
                                        <option value="" selected disabled>Is Unique</option>
                                        @foreach ($booleanOptions as $key => $val)
                                            <option value="{{$key}}" {{old('is_unique') == $key ? 'selected':''}}>{{$val}}</option>
                                        @endforeach
                                    </select>
                                    @error('is_unique')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <select name="validation" class="form-control @error('validation') is-invalid @enderror">
                                        <option value="" selected disabled>Validation</option>
                                        @foreach ($validations as $key => $val)
                                            <option value="{{$key}}" {{old('validation') == $key ? 'selected':''}}>{{$val}}</option>
                                        @endforeach
                                    </select>
                                    @error('validation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-lg-6">
                                    <select name="is_configurable" class="form-control @error('is_configurable') is-invalid @enderror">
                                        <option value="" selected disabled>Is Configurable</option>
                                        @foreach ($booleanOptions as $key => $val)
                                            <option value="{{$key}}" {{old('is_configurable') == $key ? 'selected':''}}>{{$val}}</option>
                                        @endforeach
                                    </select>
                                    @error('is_configurable')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <select name="is_filterable" class="form-control @error('is_filterable') is-invalid @enderror">
                                        <option value="" selected disabled>Is Filterable</option>
                                        @foreach ($booleanOptions as $key => $val)
                                            <option value="{{$key}}" {{old('is_filterable') == $key ? 'selected':''}}>{{$val}}</option>
                                        @endforeach
                                    </select>
                                    @error('is_filterable')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
