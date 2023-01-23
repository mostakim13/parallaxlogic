@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-header">
                <a class="btn btn-warning" href="{{ route('deleted-data') }}">Deleted Data</a>
                <a class="btn btn-info" href="{{ route('log-details') }}">Log</a>
                    <a class="btn btn-success" style="float:right" href="{{ route('product.create') }}">Create</a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">description</th>
                                <th scope="col">features</th>
                                <th scope="col">image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->product_details->description ?? '' }}</td>
                                <td>{{ $product->product_details->features ?? '' }}</td>
                           
                                <td>
                                    <div>
                                        <img src="{{ $product->product_details->image_url ?? '' }}" alt="" height="50px"
                                            width="50px">
                                    </div>
                                </td>
                                <td>
                                    <div style="display:flex">
                                    <a class="btn btn-primary" style="margin-right: 5px" href="{{ route('product.edit',$product->id) }}">Edit</a>
                                    <form action="{{ route('product.destroy', $product->id ) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure to delete this product?')">Delete</button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection