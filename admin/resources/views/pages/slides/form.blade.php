
@extends('layouts.master')

@section('inline-css')
    <style>
        .c-d--none {
            display: none;
        }
        .c-d--block {
            display: block;
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
                        <li class="breadcrumb-item"><a href="{{url('/slides')}}">Slide</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        @php
                            $formTitle = !empty($slide) ? 'Update' : 'New'    
                        @endphp
                        <h2 class="card-title">{{ $formTitle }} Slide</h2>
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
                        @include('pages.partials.flash', ['$errors' => $errors])
                        @if (!empty($slide))
                            {!! Form::model($slide, ['url' => ['slides', $slide->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data']) !!}
                            {!! Form::hidden('id') !!}
                        @else
                            {!! Form::open(['url' => 'slides', 'enctype' => 'multipart/form-data']) !!}
                        @endif
                            <div class="form-group">
                                {!! Form::label('title', 'Title') !!}
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('url', 'URL') !!}
                                {!! Form::text('url', null, ['class' => 'form-control']) !!}
                            </div>
                        @if (empty($slide))
                            <div class="form-group">
                                {!! Form::label('image', 'Slide Image (1920x643 pixel)') !!}
                                {!! Form::file('image', ['class' => 'form-control-file', 'placeholder' => 'product image']) !!}
                            </div>
                        @endif
                            <div class="form-group">
                                {!! Form::label('body', 'Body') !!}
                                {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 3]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status') !!}
                                {!! Form::select('status', $statuses , null, ['class' => 'form-control', 'placeholder' => '-- Set Status --']) !!}
                            </div>
                            <div class="form-footer pt-5 border-top">
                                <button type="submit" class="btn btn-primary btn-default">Save</button>
                                <a href="{{ url('slides') }}" class="btn btn-secondary btn-default">Back</a>
                            </div>
                        {!! Form::close() !!}
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
@endsection