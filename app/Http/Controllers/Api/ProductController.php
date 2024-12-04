<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function show($id)
    {
        try {
            $product = Product::query()->findOrFail($id);
            return response()->json([
                'status' => true,
                'message' => 'Chi tiết',
                'data' => $product
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message'   => "Không lấy được sản phẩm có id=$id",
                'error' => $th->getCode(),
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::query()->findOrFail($id);
            $image = $product->image;
            $product->delete();

            if ($image) {
                Storage::delete($image);
            }
            return response()->json([
                'status' => true,
                'message'   => 'Xóa dữ liệu thành công',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message'   => "Không có sản phẩm id=$id",
                'error' => $th->getCode(),
            ]);
        }
    }
}
