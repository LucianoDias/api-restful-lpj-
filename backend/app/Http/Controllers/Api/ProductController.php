<?php

namespace App\Http\Controllers\Api;

use App\Help\ApiError;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var Product
     */
    private $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    //List of products
    public function index(){
        return response()->json($this->product->paginate(10));
    }
    
    // search for id product
    public function show($id){
        $product = $this->product->find($id);

        if(! $product)
            return response()->json(ApiError::erroMessage(' Product not finding!',4040),404);
        $data = ['data' =>$product];
        return response()->json($data);
    }
    
    //add new product on table
    public function store(Request $request){

       try{
            $productData = $request->all();
            $this->product->create($productData);
            $result = ['data'=> ['msg'=> 'Product successfully created!']];
            return response()->json( $result, 201);
       }catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::erroMessage($e->getMessage(),2020),500);
            }
            return response()->json(ApiError::erroMessage("There is an error during the operation of new product",2020));
       }
    }

    //Update of product on table
    public function update(Request $request, $id){

        try{
             $productData = $request->all();
             $product = $this->product->find($id);
             $product->update($productData);
             $result = ['data'=> ['msg'=> 'The product updating with sucesso!']];
             return response()->json( $result, 201);
        }catch(\Exception $e){
             if(config('app.debug')){
                 return response()->json(ApiError::erroMessage($e->getMessage(),2021),500);
             }
             return response()->json(ApiError::erroMessage("There is an error during the operation update",2021));
        }
     }

     // destroy product
     public function delete(Product $id){
        try{
            $id->delete();
            return  response()->json(['data' => ['msg' => 'Product: '.$id->name.' removenig with sucesso!']],200);
       }catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::erroMessage($e->getMessage(),2022),500);
            }
            return response()->json(ApiError::erroMessage("There is an error during the operation remover",2022));
       }
     }


}
