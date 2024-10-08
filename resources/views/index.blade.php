<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container w-80">
        <h1>Products List</h1>

        <table class="table">
            <tr>
                <th class="col">#ID</th>
                <th class="col">Name</th>
                <th class="col">Image</th>
                <th class="col">Price</th>
                <th class="col">Quantity</th>
                <th class="col">Description</th>
                <th>
                    <a href="{{ route('create') }}" class="btn btn-primary">Create</a>
                </th>
            </tr>

            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        <img src="{{ Storage::url($product->image) }}" width="60" alt="">
                    </td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->is_active ? 'active' : 'deactive' }}</td>
                    <td>{{ $product->description }}</td>
                    <td></td>
                </tr>
            @endforeach
        </table>
        {{ $products->links() }}
    </div>
</body>

</html>
