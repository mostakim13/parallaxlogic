@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="text-align:right">
                <a class="btn btn-secondary mb-2" href="{{ url('/home') }}">Back</a>
            </div>
            <form action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="old_img" value="{{ $product->product_details->image_url ?? '' }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter name" value={{$product->name}}>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" class="form-control" placeholder="Quantity"
                        value={{$product->quantity}}>
                    @error('quantity')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" class="form-control" placeholder="Price"
                        value={{$product->price}}>
                    @error('price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="" cols="30"
                        rows="5">{{ $product->product_details->description ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="features">Features</label>
                    <input type="text" name="features" class="form-control" placeholder="Features"
                        value={{ $product->product_details->features ?? '' }}>
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