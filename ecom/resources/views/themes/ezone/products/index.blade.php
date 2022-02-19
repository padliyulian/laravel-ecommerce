@extends('themes.ezone.layout')

@section('content')
	<div class="breadcrumb-area pt-205 breadcrumb-padding pb-210" style="background-image: url({{ asset('themes/ezone/assets/img/bg/breadcrumb.jpg') }})">
		<div class="container-fluid">
			<div class="breadcrumb-content text-center">
				<h2>shop grid 3 column</h2>
				<ul>
					<li><a href="#">home</a></li>
					<li>shop grid 3 column</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="shop-page-wrapper shop-page-padding ptb-100">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
					@include('themes.ezone.products.sidebar')
				</div>
				<div class="col-lg-9">
					<div class="shop-product-wrapper res-xl">
						<div class="shop-bar-area">
							<div class="shop-bar pb-60">
								<div class="shop-found-selector">
									<div class="shop-found">
										<p><span>23</span> Product Found of <span>50</span></p>
									</div>
									<div class="shop-selector">
										<label>Sort By : </label>
                                        <select name="sort" id="js-short">
                                            @foreach ($sorts as $key => $val)
                                                <option value="{{$key}}" {{$selectedSort == $key ? 'selected':''}}>{{$val}}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>
								<div class="shop-filter-tab">
									<div class="shop-tab nav" role=tablist>
										<a class="active" href="#grid-sidebar3" data-toggle="tab" role="tab" aria-selected="false">
											<i class="ti-layout-grid4-alt"></i>
										</a>
										<a href="#grid-sidebar4" data-toggle="tab" role="tab" aria-selected="true">
											<i class="ti-menu"></i>
										</a>
									</div>
								</div>
							</div>
							<div class="shop-product-content tab-content">
								<div id="grid-sidebar3" class="tab-pane fade active show">
									@include('themes.ezone.products.grid_view')
								</div>
								<div id="grid-sidebar4" class="tab-pane fade">
									@include('themes.ezone.products.list_view')
								</div>
							</div>
						</div>
					</div>
					<div class="mt-50 text-center">
						{{ $products->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('inline-js')
{{-- <script>
    document.querySelector('#js-short').addEventListener('change', function(){
        window.location = this.value
    })

	$('.quick-view').on('click', function (e) {
		e.preventDefault();
		var product_slug = $(this).attr('product-slug');
		getQuickView(product_slug);
	});

	function getQuickView(product_slug) {
		$.ajax({
			type: 'GET',
			url: '/product/quick-view/' + product_slug,
			success: function (response) {
				$('#exampleModal').html(response);
				$('#exampleModal').modal();
			}
		});
	} 	

	$('.add-to-card').on('click', function (e) {
		e.preventDefault();

		var product_type = $(this).attr('product-type');
		var product_id = $(this).attr('product-id');
		var product_slug = $(this).attr('product-slug');

		if (product_type == 'configurable') {
			getQuickView(product_slug);
		} else {
			$.ajax({
				type: 'POST',
				url: '/carts',
				data:{
					_token: $('meta[name="csrf-token"]').attr('content'),
					product_id: product_id,
					qty: 1
				},
				success: function (response) {
					location.reload(true);
				}
			});
		}
	});
</script>     --}}
@endsection