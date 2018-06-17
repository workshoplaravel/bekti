<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dictionary;
use DB;

class TFController extends Controller
{
    public function index()
    {
        $dictionary = Dictionary::with('recheck')
            ->paginate(10);
        return view('tf.index', compact('dictionary'));
    }
}
