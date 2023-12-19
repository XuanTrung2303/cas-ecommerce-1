<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;

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
        $data = Category::all();
        return view('admin.category.index', compact('data'));

        // return response()->json($data);
    }
}
