@extends('layout')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="container w-80">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Active</th>
                    <th scope="col">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Create</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>
                            <img src="{{ Storage::Url($product->image) }}" width="60" alt="">
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->is_active ? 'Kích hoạt' : 'Ngừng kích hoạt' }}</td>
                        <td></td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        {{ $products->links() }}
    </div>
@endsection
