<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Str;
use DataTables;


class ChildcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // all child category showing method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('childcategories')->leftJoin('categories', 'childcategories.category_id', 'categories.id')
                ->leftJoin('subcategories', 'childcategories.subcategory_id', 'subcategories.id')
                ->select('categories.category_name', 'subcategories.subcategory_name', 'childcategories.*')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = ' <a href="#" class="btn btn-info btn-sm edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="' . route('childcategory.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete">
                                    <i class="fas fa-trash"></i>
                                    </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $category = DB::table('categories')->get();

        return view('admin.category.childcategory.index', compact('category'));
    }

    //store child category method
    public function store(Request $request)
    {
        $cate = DB::table('subcategories')->where('id', $request->subcategory_id)->first();

        $data = array();
        $data['category_id'] = $cate->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_name'] = $request->childcategory_name;
        $data['childcategory_slug'] = Str::slug($request->childcategory_name, '-');
        DB::table('childcategories')->insert($data);

        $notification = array('messege' => 'Child Category Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //edit child category method
    public function edit($id)
    {
        $category = DB::table('categories')->get();
        $data = DB::table('childcategories')->where('id', $id)->first();

        return view('admin.category.childcategory.edit', compact('category', 'data'));
    }

    //update child category method
    public function update(Request $request)
    {
        $cate = DB::table('subcategories')->where('id', $request->subcategory_id)->first();

        $data = array();
        $data['category_id'] = $cate->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_name'] = $request->childcategory_name;
        $data['childcategory_slug'] = Str::slug($request->childcategory_name, '-');
        DB::table('childcategories')->where('id', $request->id)->update($data);

        $notification = array('messege' => 'Child Category Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //delete child category method
    public function destroy($id)
    {
        DB::table('childcategories')->where('id', $id)->delete();
        $notification = array('messege' => 'Child Category Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
