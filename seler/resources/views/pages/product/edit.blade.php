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
        <div class="row">
            <div class="col-12 col-lg-3">
                @include('pages.product.menu')
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
                        <form action="{{url('/product/'.$product->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="form-group col-12">
                                    <select name="type" class="form-control @error('type') is-invalid @enderror">
                                        <option value="" selected disabled>Select Type</option>
                                        @foreach ($types as $key => $val)
                                            <option value="{{$key}}" {{$product->type == $key ? 'selected':''}}>{{$val}}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" value="{{$product->sku}}" placeholder="SKU">
                                    @error('sku')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$product->name}}" placeholder="Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$product->price}}" placeholder="Price">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="">Select Category</label>
                                    {!! General::selectMultiLevel('category_ids[]', $categories, ['class' => 'form-control', 'multiple' => true, 'selected' => !empty(old('category_ids')) ? old('category_ids') : $categoryIDs]) !!}

                                    @error('category_ids')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-primary mt-4">Product Variants</p>
                                    <hr/>
                                </div>
                                @foreach ($product->variants as $variant)
                                    <input type="hidden" name="variants[{{$variant->id}}][id]" value="{{$variant->id}}">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('sku') is-invalid @enderror" name="variants[{{$variant->id}}][sku]" value="{{$variant->sku}}" placeholder="SKU">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="variants[{{$variant->id}}][name]" value="{{$variant->name}}" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="variants[{{$variant->id}}][price]" value="{{$variant->price}}" placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('qty') is-invalid @enderror" name="variants[{{$variant->id}}][qty]" value="{{$variant->productInventory ? $variant->productInventory->qty : null}}" placeholder="Stock">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('weight') is-invalid @enderror" name="variants[{{$variant->id}}][weight]" value="{{$variant->weight}}" placeholder="Weight">
                                        </div>
                                    </div>
                                @endforeach
                                <hr/>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="3">{{$product->short_description ?? 'short_description'}}</textarea>
                                    @error('short_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{$product->description ?? 'description'}}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-lg-3">
                                    <input type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ $product->weight }}" placeholder="weight">
                                    @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-lg-3">
                                    <input type="number" class="form-control @error('length') is-invalid @enderror" name="length" value="{{ $product->length }}" placeholder="length">
                                    @error('length')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-lg-3">
                                    <input type="number" class="form-control @error('width') is-invalid @enderror" name="width" value="{{ $product->width }}" placeholder="width">
                                    @error('width')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-lg-3">
                                    <input type="number" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ $product->height }}" placeholder="height">
                                    @error('height')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-lg-8">
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="" selected disabled>Select Status</option>
                                        @foreach ($statuses as $key => $val)
                                            <option value="{{$key}}" {{$product->status == $key ? 'selected':''}}>{{$val}}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-lg-4">
                                    <input type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" value="{{ $product->productInventory->qty ?? 0 }}" placeholder="Stock">
                                    @error('qty')
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
