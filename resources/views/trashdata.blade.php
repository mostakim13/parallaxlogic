@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
                <div style="text-align:right">
                    <a class="btn btn-secondary mb-2" href="{{ url('/home') }}">Back</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <div style="display:flex">

                                        <a class="btn btn-primary" style="margin-right: 5px"
                                            href="{{ route('restoreDeletedProduct',$product->id) }}">Restore</a>
                                        <a class="btn btn-danger" href="{{ route('deletePermanently', $product->id ) }}"
                                            onclick="return confirm('Are you sure to permanent delete this product?')">Permanent
                                            Delete</a>

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
@endsection