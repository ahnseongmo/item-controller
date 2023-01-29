<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\LoginController;

use App\Models\Product;

class ProductsController extends Controller
{
    // 프로덕트 리스트 페이지
    public function index(){
        $products = Product::get();
        return view('index', ['products'=>$products]);
    }

    // 생성하기 페이지 보여주기
    public function create(){
        return view('products.create');

    }

    // 상세 프로덕트 페이지 보여주기
    public function show(){  
        dd(request());
        $product = Product::find(last(request()->segments()));
        return view('products.detail')->with('product', $product);
    }

    // 수정하기 폼 보여주기
    public function edit($id){
        $product = Product::find($id);
        // dd($product);
        return view('products.edit')->with('product', $product);
    }

     // 삭제하기
     public function delete($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return back();
    }

    // 새 프로덕트 저장하기
    public function store(){
        $type_num = request()->type_num;
        switch($type_num){
            case '1' : $type = '노트북'; break;
            case '2' : $type = '마우스'; break;
            case '3' : $type = '핸드폰'; break;
            case '4' : $type = '이어폰'; break;
            case '5' : $type = '키보드'; break;
            default : break;
        }
        $product = new Product([
            'name'=>request()->name,
            'type'=>$type,
            'type_num'=>request()->type_num,
            'description'=>request()->description,
            'price'=>request()->price,
            'count'=>request()->count,
            'image'=>request()->image,
        ]);
        $product->save();
        return redirect('/');
    }

    // 프로덕트 업데이트 하기
    public function update($id){
        $product = Product::findOrFail($id);
        $type_num = request()->type_num;
        switch($type_num){
            case '1' : $type = '노트북'; break;
            case '2' : $type = '마우스'; break;
            case '3' : $type = '핸드폰'; break;
            case '4' : $type = '이어폰'; break;
            case '5' : $type = '키보드'; break;
            default : break;
        }
        $image = request()->image;
        if($image==null){
            $product->update([
                'name'=>request()->name,
                'type'=>$type,
                'type_num'=>request()->type_num,
                'description'=>request()->description,
                'price'=>request()->price,
                'count'=>request()->count,
            ]);
        } else{
            $product->update([
                'name'=>request()->name,
                'type'=>$type,
                'type_num'=>request()->type_num,
                'description'=>request()->description,
                'price'=>request()->price,
                'count'=>request()->count,
                'image'=>request()->image,
            ]);
        }
        return redirect('/');   
    }
}

