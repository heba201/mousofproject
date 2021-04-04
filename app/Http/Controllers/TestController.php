<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;

class TestController extends Controller
{
    public function index()
    {
    	$words = Word::paginate(7);

        return view('welcome',compact('words'));
    }
}
