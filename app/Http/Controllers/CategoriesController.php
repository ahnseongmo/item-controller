<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        // $categories = Category::get();
        $categories = Category::join('brands', 'categories.brand_id', '=', 'brands.id')->select('categories.*', 'brands.id as brand_id', 'brands.name as brand_name')->get();
        return view('categories.index', ['categories' => $categories]);
    }

    // 생성하기 페이지 보여주기
    public function create()
    {
        $brands = Brand::get();
        return view('categories.create', ['brands' => $brands]);
    }

    // 카테고리 수정 페이지 보여주기
    public function edit($id)
    {
        $brands = Brand::get();
        $category = Category::find($id)->get()->first();
        return view('categories.edit', ['brands' => $brands, 'category' => $category]);
    }

    // 새 카테고리 저장하기
    public function store()
    {
        $categories = Category::where('name', request()->name)->where('brand_id', request()->brand_id)->get();
        if (count($categories) > 0) {
            return redirect()->back()->withErrors(['msg' => '이미 존재하는 카테고리 조합입니다.']);
        } else {
            $category = new Category([
                'name' => request()->name,
                'brand_id' => request()->brand_id,
            ]);
            $category->save();
            return redirect('/category');
        }
    }

    public function getBrandNameFromCategory($category_name)
    {
        $available_brand = Category::join('brands', 'categories.brand_id', '=', 'brands.id')
            ->where('categories.name', '=', $category_name)
            ->select('brands.id as brand_id', 'brands.name as brand_name')
            ->distinct()->get();
        return $available_brand;
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
