{!! Form::open(['url'=> Request::path(),'method'=>'GET']) !!}
	<div class="row">
		<div class="form-group col-12 col-lg-3 mb-2">
			<input type="date" class="form-control" value="{{ !empty(request()->input('start')) ? request()->input('start') : '' }}" name="start">
		</div>
		<div class="form-group col-12 col-lg-3 mb-2">
			<input type="date" class="form-control" value="{{ !empty(request()->input('end')) ? request()->input('end') : '' }}" name="end">
		</div>
		<div class="form-group col-12 col-lg-2 mb-2">
			{{ Form::select('export', $exports, !empty(request()->input('export')) ? request()->input('export') : null, ['placeholder' => '-- Export to --', 'class' => 'form-control input-block']) }}
		</div>
		<div class="form-group col-12 col-lg-2 mb-2">
			<button type="submit" class="btn btn-primary btn-block">Show</button>
		</div>
		<div class="form-group col-12 col-lg-2 mb-2">
			<a href="{{url(Request::path())}}" class="btn btn-primary btn-block">Reset</a>
		</div>
	</div>
{!! Form::close() !!}
