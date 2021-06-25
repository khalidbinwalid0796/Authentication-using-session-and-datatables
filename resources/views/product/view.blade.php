@extends('layouts.app')

@section('title','Product View')

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('product.index') }}" class="btn btn-warning my-3 float-right text-white">Back</a>
    </div>
    <div class="col-md-12">
        <table class="table table-borderless">
            <tr>
                <td><b>Name</b></td><td><b>:</b></td><td>{{ $product->product_name }}</td>
            </tr>
            <tr>
                <td><b>Code</b></td><td><b>:</b></td><td>{{ $product->product_code }}</td>
            </tr>
            <tr>
                <td><b>Brand</b></td><td><b>:</b></td><td>{{ $product->brand->name }}</td>
            </tr>
            <tr>
                <td><b>Category</b></td><td><b>:</b></td><td>{{ $product->category->name }}</td>
            </tr>
            <tr>
                <td><b>Price</b></td><td><b>:</b></td><td>{{ number_format($product->price,2) }}</td>
            </tr>
            <tr>
                <td><b>Quantity</b></td><td><b>:</b></td><td>{{ $product->qty }}</td>
            </tr>
            <tr>
                <td><b>Min Quantity</b></td><td><b>:</b></td><td>{{ $product->min_qty }}</td>
            </tr>
            <tr>
                <td><b>Max Quantity</b></td><td><b>:</b></td><td>{{ $product->max_qty }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
