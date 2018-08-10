<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductPhotoController extends Controller
{
    /**
     * Store the uploaded product image
     *
     * @param Product $product
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, Request $request)
    {
        if (Auth::user()->can('upload', $product)) {

            $path = $request->file('image')->store('photos', 'local');
            $product->image = $path;

            if ($product->update()) {
                return response()->json([
                    'Photo uploaded successfully.'
                ], 200);
            } else {
                return response()->json([
                    'There was an error uploading your image.'
                ], 422);
            }
        } else {
            return response()->json([
                'You are not authorized to upload a photo to that product.'
            ], 401);
        }
    }
}
