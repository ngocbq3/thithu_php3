<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function show($id)
    {
        try {
            $product = Product::query()->findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Chi tiết',
                'data' => $product
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy bản ghi nào',
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::query()->findOrFail($id);
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Xóa dữ liệu thành công'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy bản ghi nào',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        //Validate
        $validator = Validator::make($data, [
            'name' => ['required', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'is_active' => ['required'],
            'description' => ['required']
        ]);

        //Kiểm tra dữ liệu nếu lỗi
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi nhập dữ liệu',
                'data' => $validator->errors(),
            ]);
        }

        $product = Product::query()->findOrFail($id);
        //cập nhật
        $old_image =  $product->image;

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request, 'image');
        }
        $product->update($data);
        //Xóa ảnh
        if ($old_image) {
            Storage::delete($old_image);
        }
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật dữ liệu thành công',
            'data' => $product,
        ]);
    }

    //Phương thức xử lý ảnh
    public function uploadFile(Request $request, $filename)
    {
        if ($request->hasFile($filename)) {
            return $request->file($filename)->store('images');
        }
        return null;
    }
}
