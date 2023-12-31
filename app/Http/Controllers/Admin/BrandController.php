<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Brand;
use Illuminate\Support\Str;
use DataTables;
use Image;
use File;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // all brand showing method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('brands')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = ' <a href="#" class="btn btn-info btn-sm edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="' . route('brand.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete">
                                    <i class="fas fa-trash"></i>
                                    </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.brand.index');
    }

    //store brand method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
        ]);

        $slug = Str::slug($request->brand_name, '-');

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_name, '-');
        // working with image
        $photo = $request->brand_logo;
        $photo_name = $slug . '.' . $photo->getClientOriginalExtension();
        // $photo->move('public/files/brand/' . $photo_name);   //without image intervention
        Image::make($photo)->resize(240, 120)->save(public_path('files/brand/') . $photo_name); // image intervention

        $data['brand_logo'] = 'files/brand/' . $photo_name;
        DB::table('brands')->insert($data);

        $notification = array('messege' => 'Brand Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //edit brand method
    public function edit($id)
    {
        $data = DB::table('brands')->where('id', $id)->first();
        return view('admin.brand.edit', compact('data'));
    }

    //update brand method
    public function update(Request $request)
    {
        $slug = Str::slug($request->brand_name, '-');

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_name, '-');
        if ($request->brand_logo) {
            if (File::exists($request->old_logo)) {
                unlink($request->old_logo);
            }
            // working with image
            $photo = $request->brand_logo;
            $photo_name = $slug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(240, 120)->save(public_path('files/brand/') . $photo_name); // image intervention
            $data['brand_logo'] = 'files/brand/' . $photo_name;
            DB::table('brands')->where('id', $request->id)->update($data);

            $notification = array('messege' => 'Brand Updated!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            $data['brand_logo'] = $request->old_logo;
            DB::table('brands')->where('id', $request->id)->update($data);

            $notification = array('messege' => 'Brand Updated!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        };
    }

    //destroy brand method
    public function destroy($id)
    {
        $data = DB::table('brands')->where('id', $id)->first();
        $image = $data->brand_logo;

        if (File::exists($image)) {
            unlink($image);
        }
        DB::table('brands')->where('id', $id)->delete();

        $notification = array('messege' => 'Brand Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
