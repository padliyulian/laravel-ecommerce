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
                    <h1>Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Role</li>
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
                    <div class="col-12">
                        <div class="accordion" id="accordionExample">
                            @forelse ($roles as $role)
                                <form action="{{url('/role/'.$role->id)}}" method="post">
                                    @csrf
                                    @method('patch')
                                    <div class="card mb-0">
                                        <div class="card-header" id="heading{{$role->name}}">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$role->name}}" aria-expanded="true" aria-controls="collapse{{$role->name}}">
                                                    {{$role->name}} Permission
                                                </button>
                                            </h2>
                                        </div>
                                    
                                        <div id="collapse{{$role->name}}" class="collapse {{$loop->iteration == 1 ? 'show':''}}" aria-labelledby="heading{{$role->name}}" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="row">
                                                    @forelse ($permissions as $permission)
                                                        <div class="col-12 col-lg-3">
                                                            @php
                                                                $col = explode("_", $permission->name)
                                                            @endphp
                                                            @if ($col[0] == 'view')
                                                                <div class="form-check">
                                                                    <input name="permissions[]" class="form-check-input" type="checkbox" value="{{$permission->id}}" {{$role->hasPermissionTo($permission->name) ? 'checked':''}}>
                                                                    <label class="form-check-label" for="check{{$permission->id}}">
                                                                        {{$permission->name}}
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if ($col[0] == 'add')
                                                                <div class="form-check">
                                                                    <input name="permissions[]" class="form-check-input" type="checkbox" value="{{$permission->id}}" {{$role->hasPermissionTo($permission->name) ? 'checked':''}}>
                                                                    <label class="form-check-label" for="check{{$permission->id}}">
                                                                        {{$permission->name}}
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if ($col[0] == 'edit')
                                                                <div class="form-check">
                                                                    <input name="permissions[]" class="form-check-input" type="checkbox" value="{{$permission->id}}" {{$role->hasPermissionTo($permission->name) ? 'checked':''}}>
                                                                    <label class="form-check-label" for="check{{$permission->id}}">
                                                                        {{$permission->name}}
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if ($col[0] == 'delete')
                                                                <div class="form-check">
                                                                    <input name="permissions[]" class="form-check-input" type="checkbox" value="{{$permission->id}}" {{$role->hasPermissionTo($permission->name) ? 'checked':''}}>
                                                                    <label class="form-check-label" for="check{{$permission->id}}">
                                                                        {{$permission->name}}
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @empty
                                                        no permission ...
                                                    @endforelse
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @empty
                                <span>no role ...</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="form-group col-12 text-right">
                        <a data-toggle="modal" data-target="#role-modal" href="#" class="btn btn-primary">Add Role</a>
                    </div>
                </div>
            </div>
        </div>

    </section>
  
    <!-- Modal -->
    <div class="modal fade" id="role-modal" tabindex="-1" aria-labelledby="role-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{url('/role')}}" method="post">
                @csrf
                @method('post')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="role-modalLabel">Add New Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" placeholder="Role Name">
                                @error('name')
                                    <span class="invalid-feedback error-name" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-save">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('inline-js')
<script src="{{asset('assets/js/sweetalert2@10.js')}}"></script>
<script>
    if ($('.is-invalid').length > 0) {
        $('#role-modal').modal('show')
    }
</script>
@endsection
