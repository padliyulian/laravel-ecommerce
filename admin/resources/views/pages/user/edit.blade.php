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
                    <h1>User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/user')}}">User</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                        <form action="{{url('/user/'.$user->id)}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="form-group col-12 col-lg-6">
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{$user->first_name}}" placeholder="First Name">
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{$user->last_name}}" placeholder="Last Name">
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" placeholder="Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <select name="role" class="form-control @error('roles') is-invalid @enderror">
                                        <option value="" selected disabled>Select Role</option>
                                        @foreach ($roles as $item)
                                            @forelse ($user->roles as $role)
                                                <option value="{{$item->id}}" {{$role->id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                            @empty
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforelse
                                        @endforeach
                                    </select>
                                    @error('roles')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
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

@section('inline-js')
<script>

</script>
@endsection
