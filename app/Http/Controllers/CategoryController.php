<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $categories=Category::all();
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category= new Category;
        $user = Auth::user();
        $name = $user->name;
        $category->category_name=$request->get('category_name');
        $category->category_created_by=$name;
        $cat_name = $request->input('category_name');
        $data = DB::select('select category_name from categories where category_name=? ', [$cat_name]);

        if(count($data)==0){
        $category->save();

        return redirect('categories')->with('success', 'Information has been added');
        }

        else{
            return redirect('categories')->with('success', 'duplicate catergory');
        }
    }

}
