<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    // public function about(){
    //   $data = [];
    //   $data["first_name"] = "Harry";
    //   $data["last_name"] = "Potter";
    //   return view('pages.about', $data);
    //   // return view('pages.about');
    // }
    
    public function about(){
      $first_name = "Harry";
      $last_name = "Potter";
      return view('pages.about', compact('first_name', 'last_name'));
      // return view('pages.about');
    }


    public function contact(){
      return view("pages.contact");
    }
}
