<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function list()
    {
        
        $Products = Products::where('user_id', Auth::user()->id)->get();
        return $Products;

    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    $userId=auth()->id();
    $request['user_id'] = $userId;
     Products::create($request->all());
     return ( 'Product added successfully');
    }
      /*  $file_extension = $request->image->getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = 'images/products'; 
        $request->image->move($path,$file_name);

        $product = new Products([
            'name' => $request->name,
            'prix' => $request->price,
            'couleur' => $request->couleur,
            'image' =>$file_name
        ]);
        
}
*/

public function getProductById($id){
    $product = Products::find($id);
    if(is_null($product)){
        return response()->json(['message'=>'Product Not Found'], 404);
    }
         return response()->json($product::find($id),200);
}

/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
       $product = Products::find($id);
       if(is_null($product)){
           return response()->json(['message'=> 'product not found'], 404);
       }
        $userId=auth()->id();
        $request['user_id'] = $userId;
        $product->update($request->all());
        return response($product,200);
    

    }
    
    public function destroy($id)
    {
        $product=Products::find($id);
        if($product) {
            $product->delete();
            $msg = "Successfully deleted product!";
        }
        else{
            $msg = "Product not found!";

        }
    return response()->json([
        'message' => $msg
    ], 201);
    }
}