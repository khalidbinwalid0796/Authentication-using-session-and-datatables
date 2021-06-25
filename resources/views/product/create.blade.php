@extends('layouts.app')

@section('title','Product Add')

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('product.index') }}" class="btn btn-warning my-3 float-right text-white">Back</a>
    </div>
    <div class="col-md-12">
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            @csrf 
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}" name="product_name" id="product_name">
                    @error('product_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="product_code">Product Code</label>
                    <input type="text" class="form-control @error('product_code') is-invalid @enderror" value="{{ old('product_code') }}" name="product_code" id="product_code">
                    @error('product_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="brand_id">Brand</label>
                    <select class="form-control @error('brand_id') is-invalid @enderror" name="brand_id" id="brand_id">
                        <option value="">Select Please</option>
                        @if (!$brands->isEmpty())
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('brand_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="category_id">Category</label>
                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                        <option value="">Select Please</option>
                        @if (!$categories->isEmpty())
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="price">Price</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" name="price" id="price">
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="qty">Quantity</label>
                    <input type="text" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty') }}" name="qty" id="qty">
                    @error('qty')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="min_qty">Minimum Quantity</label>
                    <input type="text" class="form-control @error('min_qty') is-invalid @enderror" value="{{ old('min_qty') }}" name="min_qty" id="min_qty">
                    @error('min_qty')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="max_qty">Maximum Quantity</label>
                    <input type="text" class="form-control @error('max_qty') is-invalid @enderror" value="{{ old('max_qty') }}" name="max_qty" id="max_qty">
                    @error('max_qty')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="form-group col-md-12 pt-3 text-center">
                    <button type="reset" class="btn btn-danger mr-3">Reset</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
