@extends('layout')

@section('title', 'Thêm sản phẩm')

@section('content')
    <div class="container w-80">
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" name="name" id="" class="form-control">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Image</label>
                <input type="file" name="image" id="" class="form-control">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Quantity</label>
                <input type="number" name="quantity" min="0" id="" class="form-control">
                @error('quantity')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Price</label>
                <input type="number" name="price" step="0.1" id="" class="form-control">
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Active</label><br>
                <input type="radio" name="is_active" value="1" checked id=""> Active
                <input type="radio" name="is_active" value="0" id=""> deActive
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea name="description" id="" rows="10" class="form-control"></textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create New</button>
            <a href="{{ route('products.index') }}" class="btn btn-primary">List</a>
        </form>
    </div>
@endsection
