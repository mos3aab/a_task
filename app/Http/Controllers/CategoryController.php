<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // index of all categories 
        $data = DB::select("SELECT ca.*,cb.catageory_name AS parentName from `categories` as `ca` LEFT join `categories` as `cb` on `cb`.`id` = `ca`.`parent_cateegory` WHERE `ca`.`parent_cateegory` >= 0");
        return view('categories.index', [
            'categories' =>$data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::where('parent_cateegory','=',0)->get();
        // form for add category 
        return view('categories.add',[
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
        // persist category 
        $request->validate([
            'catageory_name' => 'required',
        ]);
  
        category::insert( [
            'catageory_name' => $request->catageory_name, 'parent_cateegory' => $request->parent_cateegory,
            'is_active' => $request->is_active
        ]);
        return redirect()->route('categories')->with('success','Category Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category,$id)
    {
        // edit for udpate 
        $getCateg = category::where('id','=',$id)->get();
        $categories = category::where('id','!=',$id)->where('parent_cateegory','=',0)->get();
        
        return view('categories.edit', [
            'category' => $getCateg,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category,$id)
    {
        // update catalog 
        category::where('id',$id)->update( [
            'catageory_name' => $request->catageory_name, 'parent_cateegory' => $request->parent_cateegory,
            'is_active' => $request->is_active
        ]);
        return redirect()->route('categories')->with('success','Category Updated Successfully.');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category,$id)
    {
        // Delete and change children to parent 
        category::where('parent_cateegory',$id)->update( [
            'parent_cateegory' => 0,
        ]);
        category::where('id',$id)->delete();
        return redirect()->route('categories')->with('success','Category Deleted Successfully.');
        
    }
}
