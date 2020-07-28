<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Product;
use App\Rules\MaxServerUploadLimit;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function import(Request $request)
    {
        request()->validate([
            'file' => [new MaxServerUploadLimit(), 'required', 'file', 'mimes:xlsx,xls']
        ]);
        Excel::import(new ProductImport(), $request->file('file'));
        return back();
    }
}
