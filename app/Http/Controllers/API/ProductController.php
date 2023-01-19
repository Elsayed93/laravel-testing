<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreRequest;
use App\Models\Product;


class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(StoreRequest $request)
    {
        return Product::create($request->validated());
    }
}
