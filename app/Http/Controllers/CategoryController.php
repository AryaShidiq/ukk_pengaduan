<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Category $category)
    {
        //
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
