<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->latest('id')->paginate(8);
        return view('index', compact('products'));
    }

    public function create()
    {
        return view('create');
    }

    //Phương thức xử lý ảnh
    public function uploadFile(Request $request, $filename)
    {
        if ($request->hasFile($filename)) {
            return $request->file($filename)->store('images');
        }
        return null;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:products', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'is_active' => ['required'],
            'description' => ['required']
        ]);

        $data['image'] = $this->uploadFile($request, 'image');

        Product::query()->create($data);

        return redirect()->route('index')->with('message', 'Thêm dữ liệu thành công');
    }
}
