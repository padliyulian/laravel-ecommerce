
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
                    <h1>Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Inventory</li>
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
				{!! Form::open(['url'=> Request::path(),'method'=>'GET','class' => 'form-inline']) !!}
					<div class="form-group mb-2">
						{{ Form::select('export', $exports, !empty(request()->input('export')) ? request()->input('export') : null, ['placeholder' => '-- Export to --', 'class' => 'form-control input-block']) }}
					</div>
					<div class="form-group mx-sm-3 mb-2">
						<button type="submit" class="btn btn-primary btn-default">Go</button>
					</div>
				{!! Form::close() !!}
				<table class="table table-bordered table-striped">
					<thead>
						<th>Name</th>
						<th>SKU</th>
						<th>Stock</th>
					</thead>
					<tbody>
						@forelse ($products as $product)
							<tr>    
								<td>{{ $product->name }}</td>
								<td>{{ $product->sku }}</td>
								<td>{{ $product->stock }}</td>
							</tr>
						@empty
							<tr>
								<td colspan="3">No records found</td>
							</tr>
						@endforelse
					</tbody>
				</table>
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

    })  
</script>
@endsection
