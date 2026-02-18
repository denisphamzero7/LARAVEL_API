<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllProduct(){
        return '<h2>API - Get all products</h2>';
    }
}