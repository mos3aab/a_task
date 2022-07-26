<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =product::select('products.*','categories.catageory_name','products.id AS prod_id')->leftJoin('categories', 'categories.id', '=', 'products.category')->get();
        
        return view('products.index', [
            'products' => $products

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        // form for add category 
        $categories = category::where('parent_cateegory','=',0)->where('is_active','>',0)->get();
        return view('products.add',[
            'categories' => $categories
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // store product data 
        $request->validate([
            'product_name' => 'required',
            'category' => 'required',
            'picture' => 'required'
            
        ]);
        
        // file Upload 
        if($request->file('picture')){
            $file= $request->file('picture');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('Images'), $filename);
        }else{
            $filename = NULL;
        }

        product::insert( [
            'product_name' => $request->product_name, 'description' => $request->description,
            'category' => $request->category,'tags' => $request->tags,'tags' => $request->tags,
            'picture' => $filename
        ]);
        
        return redirect()->route('products')->with('success','Product Added Successfully.');            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product,$id)
    {
        // edit for udpate 
        $getProduct = product::where('id','=',$id)->get();
        $categories = category::where('parent_cateegory','=',0)->get();
        
        return view('products.edit', [
            'product' => $getProduct,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product,$id)
    {
        // update product 
        $product_pic = product::select('picture')->where('id','=',$id)->get();
        
        if($request->file('picture')){
            unlink("Images/".$product_pic[0]['picture']);
            $file= $request->file('picture');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('Images'), $filename);
        }else{
            $filename =$product_pic[0]['picture'];
        }
        // dd(str_replace('#',',',$request->tags)); 
        product::where('id',$id)->update( [
            'product_name' => $request->product_name, 'description' => $request->description,
            'category' => $request->category,'tags' =>$request->tags,
            'picture' => $filename
        ]);
        

        return redirect()->route('products')->with('success','Product Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product,$id)
    {
        // delete product 
        $product_pic = product::select('picture')->where('id','=',$id)->get();
        unlink("Images/".$product_pic[0]['picture']);   
        product::where('id',$id)->delete();
        return redirect()->route('products')->with('success','Product Deleted Successfully.');
    }
}
