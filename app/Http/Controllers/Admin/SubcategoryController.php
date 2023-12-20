<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index method for read data
    public function index()
    {
        // Query builder with one to one join
        // $data = DB::table('subcategories')->leftJoin('categories', 'subcategories.category_id', 'categories.id')
        //     ->select('subcategories.*', 'categories.category_name')->get();

        // Eloquent ORM
        $data = Subcategory::all();
        $category = Category::all();
        // $category=DB::table('categories')->get();

        return view('admin.category.subcategory.index', compact('data', 'category'));
    }

    //store subcategory method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => 'required|max:55',
        ]);

        // query builder
        // $data = array();
        // $data['category_id'] = $request->category_id;
        // $data['subcategory_name'] = $request->subcategory_name;
        // $data['subcategory_slug'] = Str::slug($request->subcategory_name, '-');
        // DB::table('subcategories')->insert($data);

        // eloquent ORM
        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name, '-'),
        ]);

        $notification = array('messege' => 'Sub Category Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // edit subcategory method
    public function edit($id)
    {
        // eloquent ORM
        // $data = Subcategory::find($id);
        // $category = Category::all();

        // query builder
        $data = Subcategory::find($id);
        $category = DB::table('categories')->get();

        return view('admin.category.subcategory.edit', compact('data', 'category'));
    }

    // update subcategory method
    public function update(Request $request)
    {
        //eloquent ORM
        $subcategory = Subcategory::where('id', $request->id)->first();
        $subcategory->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name, '-'),
        ]);

        // query builder
        // $data = array();
        // $data['category_id'] = $request->category_id;
        // $data['subcategory_name'] = $request->subcategory_name;
        // $data['subcategory_slug'] = Str::slug($request->subcategory_name, '-');
        // DB::table('subcategories')->where('id', $request->id)->update($data);

        $notification = array('messege' => 'Sub Category Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    // delete subcategory method
    public function destroy($id)
    {
        // query builder
        // DB::table('categories')->where('id', $id)->delete();

        $subcategory = Subcategory::find($id);
        $subcategory->delete();

        $notification = array('messege' => 'Sub Category Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
