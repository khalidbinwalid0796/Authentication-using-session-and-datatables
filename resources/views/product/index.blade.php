@extends('layouts.app')

@section('title','Product List')

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('product.create') }}" class="btn btn-success my-3 float-right text-white"> <i class="fas fa-plus-square"></i> Add New</a>
    </div>
    <div class="col-md-12">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successfull!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
        <table class="table table-bordered">
            <thead class="bg-primary text-white">
                <th>SL</th>
                <th>Name</th>
                <th>Code</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Min Qty</th>
                <th>Max Qty</th>
                <th>Action</th>
            </thead>
            <tbody>
                @if (!$products->isEmpty())
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_code }}</td>
                            <td>{{ $product->brand->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ number_format($product->price,2) }}</td>
                            <td>{{ $product->qty }}</td>
                            <td>{{ $product->min_qty }}</td>
                            <td>{{ $product->max_qty }}</td>
                            <td>
                                <a href="{{ route('product.edit',['product'=>$product->id]) }}" class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i> </a>
                                <a href="{{ route('product.show',['product'=>$product->id]) }}" class="btn btn-warning btn-sm"> <i class="fas fa-eye"></i> </a>
                                <a onclick="event.preventDefault();document.getElementById('deleteForm').submit();" class="btn btn-danger btn-sm">
                                     <i class="fas fa-trash"></i> 
                                </a>
                                <form action="{{ route('product.destroy',['product'=>$product->id]) }}" id="deleteForm" method="POST">
                                @csrf 
                                @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
