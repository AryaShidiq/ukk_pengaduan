<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Category::all();
        return view('Category.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data               = array();
        $data['id']         = '';
        $data['name']       = '';
        $data['slug']       = '';
        $data['status']     = '';
        $data['add_by']     = Petugas::all();
        $data['edit_by']    = '';
        $data['urlCancel']  = '/category';
        $data['urlForm']    = '/category/simpan';

        return view('Category.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpanCategory(Request $request)
    {
        $id = $request->input('id');
        if (empty($id)) {
            $validator  = Validator::make($request->all(),[
                'name' => 'required:unique:categories',
                'slug' => 'required:unique:categories',
                'status' => 'required',
            ]);
        } else {
            $validator  = Validator::make($request->all(),[
                'name' => 'required:unique:categories',
                'slug' => 'required:unique:categories',
                'status' => 'required',
            ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $id   = $request->input('id');
            $name = $request->input('name');
            $slug = $request->input('slug');
            $status = $request->input('status');
            $add_by = 1;

            if (empty($id)) {
                $simpan         = new Category();
                $simpan->name   = $name;
                $simpan->slug   = $slug;
                $simpan->status = $status;
                $simpan->add_by = $add_by;
                $simpan->save();
            } else {
                $simpan         = Category::find($id);
                $simpan->name   = $name;
                $simpan->slug   = $slug;
                $simpan->status = $status;
                $simpan->edit_by   = 2;
                $simpan->save();

            }
            DB::commit();
            return redirect('/category');
            
        } catch (Execption $e) {
            DB::rollBack();
            return redirect('/category');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category,$id)
    {
        $data   = array();

        $row    = Category::where('id', $id)->first();
        $data['id']         = $row->id;
        $data['name']       = $row->name;
        $data['slug']       = $row->slug;
        $data['status']     = $row->status;
        $data['add_by']     = Petugas::all();
        $data['edit_by']    = '';
        $data['urlCancel']  = '/category';
        $data['urlForm']    = '/category/simpan';


        return view('Category.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {
        switch ($request->aksi) {
            case 'p':
                Category::whereIn('id', $request->input('id'))->update(['status' => 'p']);
                return redirect()->back()->with('success', 'Data Sudah Di Publish');
                break;
            case 'h':
                Category::whereIn('id', $request->input('id'))->update(['status' => 'h']);
                return redirect()->back()->with('success', 'Data Sudah Di Hide');
                break;
            case 'd':
                Category::whereIn('id', $request->input('id'))->delete();
                return redirect()->back()->with('success', 'Data Sudah Di Hapus');
                break;
            default:
                return redirect()->back()->with('error', 'Error Connection !!!');
                break;
        }
    }
}
