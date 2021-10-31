<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Image;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return $products;

        // $count = Product::all()->count();

        // if ($products) {
        //     return response()->json(['products' => $products, 'count'=>$count], 200);
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        if($request->hasFile("image")){
            $img = $request->image;
            $img_name = time().'-'.$img->getClientOriginalName();
            Image::make($img)->save(storage_path("/app/public/".$img_name));
            $product->image = $img_name;
        }

        if($product->save()){
            return response()->json([
                "product"=>$product,
                "msg"=>"Producto creado correctamente"
            ],201);
        }else{
            return response()->json([
                "product"=>null,
                "msg"=>"Producto no creado"
            ],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Product::find($id);
        $data->name = $request->name;
        $data->description = $request->description;
        $data->price = $request->price;

        if($request->hasFile("image")){
            $img = $request->image;
            $img_name = time().'-'.$img->getClientOriginalName();
            Image::make($img)->save(storage_path("/app/public/".$img_name));
            $data->image = $img_name;
        }

        if($data->save()){
            return response()->json([
                "data"=>$data,
                "msg"=>"Producto actualizado correctamente"
            ],200);
        }else{
            return response()->json([
                "data"=>null,
                "msg"=>"Producto no actualizado"
            ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id)->delete();
        return 'se ha eliminado correctamente';
    }
}
