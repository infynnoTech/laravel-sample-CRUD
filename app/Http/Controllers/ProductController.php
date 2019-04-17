<?php

namespace App\Http\Controllers;

use Input,
    Config,
    Image,
    File,
	Redirect,
	Response,
    View,
    URL,
    Mail;
use Crypt;
use Session;
use Carbon\Carbon;
use App\Product;
use App\ProductDetail;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data['products']=Product::get();
            $data['color'] = Config::get('constants.color');
            $data['weight'] = Config::get('constants.weight');
            $data['width'] = Config::get('constants.width');
            $data['height'] = Config::get('constants.height');
            return view('products.products', $data);
        }catch (Exception $e) {
           Log::error($e);

           return response()->json(['status' => 0, 'message' => 'Something went wrong.'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $data['color'] = Config::get('constants.color');
            $data['weight'] = Config::get('constants.weight');
            $data['width'] = Config::get('constants.width');
            $data['height'] = Config::get('constants.height');
            $data['categories'] = Category::get();

            return view('products.add_product', $data);
        }catch (Exception $e) {
           Log::error($e);

           return response()->json(['status' => 0, 'message' => 'Something went wrong.'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        try{
            $product = new Product();
            $product_detail = new ProductDetail();
            $product->name = $request->name;
            $product->category_id = $request->category;
            $product->price = $request->price;

            $product->save();

            if(isset($product->id) && $product->id > 0){

                $product_detail->product_id = $product->id;
                $product_detail->stock = $request->stock;
                $product_detail->color = $request->color;
                $product_detail->weight = $request->weight;
                $product_detail->weight = $request->weight;
                $product_detail->height = $request->height;
                $product_detail->description = $request->description;

                $product_detail->save();
                if(isset($product_detail->id) && $product_detail->id > 0){
                    Session::flash('success_message','Saved Successfully!');
                }else{
                    Session::flash('error_message','Try again, Something went wrong');
                }
            }else{
                Session::flash('error_message','Try again, Something went wrong');
            }

        }catch (Exception $e) {
           Log::error($e);
           return response()->json(['status' => 0, 'message' => 'Something went wrong.'], 500);
        }
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStoreRequest $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $bool=0;
            $product=Product::find(Crypt::decrypt($request->val_id));
            if(isset($product->id) && !empty($product->id)){
                $bool=$product->delete();
            }
            if(isset($bool) && $bool > 0){
                return response()->json(["result" => "success","status" => 200,'message'=>'Successfully Deleted!']);
            }else{
                return response()->json(["result" => "error","status" => 200,'message'=>'Something went wrong!']);
            }
        }catch (Exception $e) {
           Log::error($e);
           return response()->json(['status' => 0, 'message' => 'Something went wrong.'], 500);
        }
    }
}
