<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setLocale('ar');
        $products = Product::where('is_special', 0)->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subs = SubCategory::where('is_special', 0)->get();
        return view('admin.products.add', compact('subs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'image' => 'required',
            'old_price' => 'required',
            'new_price' => 'required',
            'sub_id' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filepath = 'storage/images/products/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $data['image'] = $filename;
        }
        if ($request->hasFile('image2')) {
            $file = $request->file('image2');
            $filepath = 'storage/images/products/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $data['image2'] = $filename;
        }
        if ($request->hasFile('image3')) {
            $file = $request->file('image3');
            $filepath = 'storage/images/products/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $data['image3'] = $filename;
        }
        if ($request->hasFile('image4')) {
            $file = $request->file('image4');
            $filepath = 'storage/images/products/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $data['image4'] = $filename;
        }
        if ($request->hasFile('image5')) {
            $file = $request->file('image5');
            $filepath = 'storage/images/products/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $data['image5'] = $filename;
        }
        Product::create($data);

        return redirect(route('admin.products'))->with('success', 'تم إضافة المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function images($id){
        $product = Product::find($id);
        $images = [];
        array_push($images,
        $product->image,
        $product->image2,
        $product->image3,
        $product->image4,
        $product->image5);
        return view('admin.products.images', compact('images', 'product'));
    }
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $subs = SubCategory::where('is_special', 0)->get();
        return view('admin.products.edit', compact('product', 'subs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'old_price' => 'required',
            'new_price' => 'required',
            'sub_id' => 'required',
        ]);

        $data = $request->all();

        if($request->hasfile('image')){
            $file = $request->file('image');
            $filepath = 'storage/images/products/'.date('Y').'/'.date('m').'/';
            $filename =$filepath.time().'-'.$file->getClientOriginalName();
            $file->move($filepath, $filename);
            if(request('old-image')){
                $oldpath=request('old-image');
                if(File::exists($oldpath)){
                    unlink($oldpath);
                }
            }
          $data['image'] = $filename;
        }

        if($request->hasfile('image2')){
            $file = $request->file('image2');
            $filepath = 'storage/images/products/'.date('Y').'/'.date('m').'/';
            $filename =$filepath.time().'-'.$file->getClientOriginalName();
            $file->move($filepath, $filename);
            if(request('old-image2')){
                $oldpath=request('old-image2');
                if(File::exists($oldpath)){
                    unlink($oldpath);
                }
            }
          $data['image2'] = $filename;
        }

        if($request->hasfile('image3')){
            $file = $request->file('image3');
            $filepath = 'storage/images/products/'.date('Y').'/'.date('m').'/';
            $filename =$filepath.time().'-'.$file->getClientOriginalName();
            $file->move($filepath, $filename);
            if(request('old-image3')){
                $oldpath=request('old-image3');
                if(File::exists($oldpath)){
                    unlink($oldpath);
                }
            }
          $data['image3'] = $filename;
        }

        if($request->hasfile('image4')){
            $file = $request->file('image4');
            $filepath = 'storage/images/products/'.date('Y').'/'.date('m').'/';
            $filename =$filepath.time().'-'.$file->getClientOriginalName();
            $file->move($filepath, $filename);
            if(request('old-image4')){
                $oldpath=request('old-image4');
                if(File::exists($oldpath)){
                    unlink($oldpath);
                }
            }
          $data['image4'] = $filename;
        }

        if($request->hasfile('image5')){
            $file = $request->file('image5');
            $filepath = 'storage/images/products/'.date('Y').'/'.date('m').'/';
            $filename =$filepath.time().'-'.$file->getClientOriginalName();
            $file->move($filepath, $filename);
            if(request('old-image5')){
                $oldpath=request('old-image5');
                if(File::exists($oldpath)){
                    unlink($oldpath);
                }
            }
          $data['image5'] = $filename;
        }

        $product->update($data);

        return redirect()->back()->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect(route('admin.products'))->with('success', 'تم حذف المنتج بنجاح');
    }
}
