<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function brands()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('admin.brands',compact('brands'));
    }

    public function add_brand()
    {
        return view('admin.brand-add');
    }
    public function brand_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $image = $request->file('image');
        $file_extention = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extention;
        $this->GenerateBrandThumbailImage($image, $file_name);
        $brand->image = $file_name;
        $brand->save();
        return redirect()->route('admin.brands')->with('success','Brand Added Successfully');
    }

    public function GenerateBrandThumbailImage($image, $imageName)
    {
        $destinationPath = public_path('images/brands');

        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Xử lý ảnh (tương thích cả v2.x và v3.x)
        try {
            // Cách 1: Dùng make() (cho v2.x)
            $img = Image::make($image->getRealPath());

            // Cách 2: Dùng read() (cho v3.x) - bỏ comment nếu dùng v3.x
            // $img = Image::read($image->getRealPath());

            // Resize và crop ảnh
            $img->fit(124, 124, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize(); // Ngăn ảnh phóng to nếu nhỏ hơn kích thước đích
            });

            // Lưu ảnh
            $img->save($destinationPath . '/' . $imageName);
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            logger()->error('Image processing failed: ' . $e->getMessage());
            throw $e; // Hoặc return false tùy logic của bạn
        }
    }
}