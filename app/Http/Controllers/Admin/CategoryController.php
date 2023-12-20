<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // all category showing method
    public function index()
    {
        // $data = DB::table('categories')->get(); //query builder
        $data = Category::all(); //eloquent ORM
        return view('admin.category.index', compact('data'));

        // return response()->json($data);
    }

    //store category method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:55',
        ]);

        // query builder
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['category_slug'] = Str::slug($request->category_name, '-');
        // DB::table('categories')->insert($data);

        // eloquent ORM
        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name, '-'),
        ]);

        $notification = array('messege' => 'Category Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // edit category method
    public function edit($id)
    {
        // query builder
        // $data = DB::table('categories')->where('id', $id)->first();

        // eloquent ORM
        $data = Category::findOrFail($id);

        return response()->json($data);
    }

    // update category method
    public function update(Request $request)
    {
        // query builder
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['category_slug'] = Str::slug($request->category_name, '-');
        // DB::table('categories')->where('id', $request->id)->update($data);

        //eloquent ORM
        $category = Category::where('id', $request->id)->first();
        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name, '-'),
        ]);

        $notification = array('messege' => 'Category Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    // delete category method
    public function destroy($id)
    {
        // query builder
        // DB::table('categories')->where('id', $id)->delete();

        // eloquent ORM
        $category = Category::find($id);
        $category->delete();

        $notification = array('messege' => 'Category Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
