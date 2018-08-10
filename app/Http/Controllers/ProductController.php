<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use Illuminate\Http\Request;
use \App\Http\Requests\UserUpdatesProductRequest;

class ProductController extends Controller
{

    /**
     * Return all products
     *
     * @return Productu
     */
    public function index()
    {
        return $products = Product::all()->toArray();
    }

    /**
     * Store a Product
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Later
        $product = new Product($request->all());
        \Auth::user()->product()->save($product);

        return response()->json([
            'Product saved successfully.'
        ], 200);
    }

    /**
     * Display a Product
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product->toArray();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserUpdatesProductRequest  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, UserUpdatesProductRequest $request)
    {
        $product->update($request->all());

        return response()->json([
            'Product updated successfully.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy(Product $product)
    {

        if (\Auth::user()->can('delete', $product)) {
            $product->delete();

            return response()->json([
                'Product successfully removed.'
            ], 200);
        }

        return response()->json([
            'You are unauthorized to remove this product.'
        ], 403);
    }

    /**
     * Attach Product to User
     *
     * @param Product $product
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function attach(Product $product, User $user)
    {
        try {
            $user->products()->attach($product);
            return response()->json([
                'Product assigned successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'This product already belongs to this user.'
            ], 422);
        }
    }

    /**
     * Detach Product from User
     *
     * @param Product $product
     * @param User $user
     * @return null
     */
    public function detach(Product $product, User $user)
    {
        $user->products()->detach($product);
    }

    public function viewAssigned(User $user)
    {
        return $user->product->toArray();
    }

}
