<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\LogDetail;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\Helpers;
use DB;

class ProductController extends Controller
{





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
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
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'image_url.required' => 'Please upload image',
        ]);

      DB::transaction(function() use ($request){
            if ($request->hasFile('image_url')) {
                $image = $request->file('image_url');
                $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save('uploads/products/'.$name_gen);
                $save_url = 'uploads/products/'.$name_gen;
                }
                else{
                    $save_url = '';
                }
                
                $productId = Product::create([
                    'name' => $request->name,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'slug' => createSlug($request->name),
                    'created_at' => Carbon::now(),
                ]);
                ProductDetail::create([
                    'product_id' => $productId->id,
                    'description' => $request->description,
                    'features' => $request->features,
                    'image_url' => $save_url,
                    'created_at' => Carbon::now(),
                ]);
            });
            return redirect()->back()->with('success','Product created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('product_details')->where('id',$id)->first();
        return view('edit',compact('product'));
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
        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'image_url.required' => 'Please upload image',
        ]);
        DB::transaction(function() use ($request,$id){
            $product = Product::with('product_details')->findOrFail($id);

            if ($request->hasFile('image_url')) {
                unlink($product->product_details->image_url);
                $image = $request->file('image_url');
                $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save('uploads/products/'.$name_gen);
                $save_url = 'uploads/products/'.$name_gen;
                
            }
            else{
                $save_url = $product->product_details->image_url;
            }
           
            Product::findOrFail($id)->update([
                'name' => $request->name,
                'slug' => createSlug($request->name),
                'quantity' => $request->quantity,
                'price' => $request->price,
                'updated_at' => Carbon::now(),
            ]);
    
            ProductDetail::where('product_id',$product->id)->update([
                'product_id' => $product->id,
                'description' => $request->description,
                'features' => $request->features,
                'image_url' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
        });
        return redirect()->back()->with('success','Product updated successfully!');
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
        $productdetail = ProductDetail::where('product_id',$product->id)->first();
        $product->delete();
        $productdetail->delete();
        return redirect()->back()->with('success','Product deleted successfully!');
    }

    public function deletedData(){
        $data = Product::with('product_details')->onlyTrashed()->get();
        return view('trashdata',compact('data'));
    }

    public function restoreDeletedProduct($id) 
    {

        $product = Product::where('id', $id)->withTrashed()->first();
        $productdetail = ProductDetail::where('product_id', $id)->withTrashed()->first();
        $product->restore();
        $productdetail->restore();
        return redirect()->back()->with('success','Product restored successfully!');
    }

    public function deletePermanently(Request $request,$id)
    {
        $product = Product::where('id', $id)->withTrashed()->first();
        $productdetail = ProductDetail::where('product_id', $id)->withTrashed()->first();
        if ($productdetail->image_url != NULL) {
            unlink($productdetail->image_url);
        }
        $product->forceDelete();
        $productdetail->forceDelete();
        return redirect()->back()->with('success','Product permanently deleted successfully!');
    }

    public function logDetails(){
        $logDetails = LogDetail::paginate(10);
        return view('productlog',compact('logDetails'));
    }

    public function logDetailsDelete($id){
        LogDetail::findOrFail($id)->delete();
        return redirect()->back()->with('success','Log data deleted successfully!');
    }

    public function dataDetails($id){
        $logdata = LogDetail::findOrFail($id);
        return view('datadetails',compact('logdata'));
    }
}