<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function brands()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('admin.brands', compact('brands'));
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
        $file_name = Carbon::now()->timestamp . '.' . $file_extention;
        $this->GenerateBrandThumbailImage($image, $file_name);
        $brand->image = $file_name;
        $brand->save();
        return redirect()->route('admin.brands')->with('success', 'Brand Added Successfully');
    }
    public function brand_edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand-edit', compact('brand'));
    }
    public function brand_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,' . $request->id,  // Bỏ qua bản ghi hiện tại khi check unique
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $brand = Brand::find($request->id);  // Lấy brand cần update

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if (File::exists(public_path('uploads/brands/' . $brand->image))) {
                File::delete(public_path('uploads/brands/' . $brand->image));
            }

            $image = $request->file('image');
            $file_extention = $image->extension();
            $file_name = Carbon::now()->timestamp . '.' . $file_extention;
            $this->GenerateBrandThumbailImage($image, $file_name);
            $brand->image = $file_name;
        }

        $brand->save();

        return redirect()->route('admin.brands')->with('success', 'Brand Updated Successfully');
    }
    
    public function GenerateBrandThumbailImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/brands');
        
        // Create directory if it doesn't exist
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }

        $img = Image::make($image->path());
        $img->fit(124,124, function($constraint)  {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $imageName);
    }

    public function brand_delete($id)
    {
        $brand = Brand::find($id);
        if (File::exists(public_path('uploads/brands/' . $brand->image))) {
            File::delete(public_path('uploads/brands/' . $brand->image));
        }
        $brand->delete();
        return redirect()->route('admin.brands')->with('success', 'Brand Deleted Successfully');
    }

    public function categories()
    {
        $categories = Category::orderBy('id','DESC')->paginate(10);
        return view('admin.categories', compact('categories'));
    }
    public function add_category()
    {
        return view('admin.category-add');
    }
    public function category_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $image = $request->file('image');
        $file_extention = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp . '.' . $file_extention;
        $this->GenerateCategoryThumbailImage($image, $file_name);
        $category->image = $file_name;
        $category->save();
        return redirect()->route('admin.categories')->with('success', 'Category Added Successfully');
    }
    public function GenerateCategoryThumbailImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/categories');

        // Create directory if it doesn't exist
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }

        $img = Image::make($image->path());
        $img->fit(124,124, function($constraint)  {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $imageName);
    }

    public function category_edit($id)
    {
        $category = Category::find($id);
        return view('admin.category-edit', compact('category'));
    }
    public function category_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $request->id,  // Bỏ qua bản ghi hiện tại khi check unique
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $category = Category::find($request->id);  // Lấy brand cần update

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if (File::exists(public_path('uploads/categories/' . $category->image))) {
                File::delete(public_path('uploads/categories/' . $category->image));
            }

            $image = $request->file('image');
            $file_extention = $image->extension();
            $file_name = Carbon::now()->timestamp . '.' . $file_extention;
            $this->GenerateCategoryThumbailImage($image, $file_name);
            $category->image = $file_name;
        }

        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category Updated Successfully');
    }
    public function category_delete($id)
    {
        $category = Category::find($id);
        if (File::exists(public_path('uploads/categories/' . $category->image))) {
            File::delete(public_path('uploads/categories/' . $category->image));
        }
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Category Deleted Successfully');
    }

    public function products()
    {
        $products = Product::orderBy('created_at','DESC')->paginate(10);
        return view('admin.products',compact('products'));
    }
    public function add_product()
    {
        $categories = Category::select('id','name')->orderBy('name','ASC')->get();
        $brands = Brand::select('id','name')->orderBy('name','ASC')->get();
        return view('admin.product-add',compact('categories','brands'));
    }
    public function product_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);
        $product = new Product();

        $product->name = $request->name;
        $product->slug = Str::slug($request->name) . '-' . time();
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;



        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = Carbon::now()->timestamp . '.' . $image->extension();
            $this->GenerateProductThumbailImage($image, $imageName);
            $product->image = $imageName;
        }
        
        $gallery_arr = array();
        $gallery_images ="";
        $count = 1;
        
        if($request->hasFile('images')){
            $files = $request->file('images');

            foreach($files as $file){

                $extension = $file->getClientOriginalExtension();
                $gcheck = in_array($extension,['png','jpg','jpeg']);

                if($gcheck){

                    $gfileName = Carbon::now()->timestamp . '_' . $count . '.' . $extension;
                    $this->GenerateProductThumbailImage($file, $gfileName);
                    array_push($gallery_arr,$gfileName);
                    $count = $count + 1;
                }
            }
            $gallery_images = implode(',',$gallery_arr);
        }
        $product->image = $gallery_images;
        $product->save();
        return redirect()->route('admin.products')->with('success','Product has been added Successfully!');
    }
    public function GenerateProductThumbailImage($image, $imageName)
    {
        $destinationPathThumbnail = public_path('uploads/products/thumbnails');

        $destinationPath = public_path('uploads/products');

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }
        if (!File::exists($destinationPathThumbnail)) {
            File::makeDirectory($destinationPathThumbnail, 0777, true);
        }

        $img = Image::make($image->path());

        $img->fit(540, 689, function($constraint)  {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $imageName);

        $img->fit(104, 104, function($constraint)  {
            $constraint->aspectRatio();
        })->save($destinationPathThumbnail . '/' . $imageName);
    }

}
