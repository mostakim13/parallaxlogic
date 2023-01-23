@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="row justify-content-center">
        
        <div class="col-md-8">
        <div style="text-align:right">
        <a class="btn btn-secondary mb-2"   href="{{ url('/home') }}">Back</a>
        </div>
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" class="form-control" placeholder="Quantity">
                    @error('quantity')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" class="form-control" placeholder="Price">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="features">Features</label>
                    <input type="text" name="features" class="form-control" placeholder="Features">
                </div>
                <div class="form-group mb-2">
                    <label for="image">Image Url</label>
                    <input type="file" name="image_url" class="form-control">
                    @error('image_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection