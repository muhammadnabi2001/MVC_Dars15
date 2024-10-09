<?php
namespace App\Controllers;
use App\Models\Model;
class CategoryController
{
    public function index()
    {
        $models=Categorys::all();
        return view('index','Home',$models);

    }
    public function about()
    {
        return view('index','Home',$models);
        
    }
    public static function show()
    {
        return "created";
    }
}