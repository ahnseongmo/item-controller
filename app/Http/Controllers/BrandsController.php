<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::select('id', 'name')->get();
        return view('brands.index', ['brands' => $brands]);
    }

    // 생성하기 페이지 보여주기
    public function create()
    {
        return view('brands.create');
    }

    public function edit()
    {
        return view('brands.edit');
    }

    // 새 브랜드 저장하기
    public function store()
    {
        $brand = new Brand([
            'name' => request()->name,
        ]);
        $brand->save();
        return redirect('/brand');
    }

    // 삭제하기
    public function delete($id)
    {
        // 해당 카테고리를 가진 아이템을 검색한다.
        $items = Item::where('category_id', '=', $id)->get();
        if (count($items) > 0) {
            return back()->withErrors(['exist' => '삭제하려는 카테고리를 가진 아이템이 존재합니다.']);
        } else {
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect('/category');
        }
    }

}
