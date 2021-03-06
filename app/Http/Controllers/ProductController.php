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
    Log,
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
    public function index(Request $request)
    {
        try{
            //$data['products'] = Product::get();
            $data['color'] = Config::get('constants.color');
            $data['weight'] = Config::get('constants.weight');
            $data['width'] = Config::get('constants.width');
            $data['height'] = Config::get('constants.height');
            //print_r( $data['products']->productdetail->color);exit;

            $data['products'] = Product::paginate(5);
            if ($request->ajax()) {
               return view('products.product_table',$data);
            }
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
             // print_r($request->all());
             // exit;
            $product = new Product();
            $product_detail = new ProductDetail();

            //product Create
            $product->name = $request->name;
            $product->category_id = $request->category;
            $product->price = $request->price;

            $product->save();

            if(isset($product->id) && $product->id > 0){

                //product detail save
                $product_detail->product_id = $product->id;
                $product_detail->stock = $request->stock;
                $product_detail->color = implode(',', $request->color) ;
                $product_detail->weight = $request->weight;
                $product_detail->weight = $request->weight;
                $product_detail->height = $request->height;
                $product_detail->description = $request->description;

                $FiledataSave=array();
    		 	$file = array('files' => Input::file('files'));
                if(!empty(Input::file('files'))){
                    foreach(Input::file('files') as $fileData){

                            $destinationPath = 'uploads/products/';
							$destinationThumbPath = 'uploads/products/thumbnail/';

							if(!File::exists($destinationPath)) {
								File::makeDirectory($destinationPath, $mode = 0777, true, true);
							}
							if(!File::exists($destinationThumbPath)) {
								File::makeDirectory($destinationThumbPath, $mode = 0777, true, true);
							}
                            $extension = $fileData->getClientOriginalExtension(); // getting image extension
							$filenameoriginal = $fileData->getClientOriginalName(); // getting  file name

                            $filenameor =  rand(11111,99999).'_'.time();
							$fileName =$filenameor.".{$extension}";  // renameing image

                            $img = Image::make($fileData->getRealPath());
							$img->resize(100, null, function ($constraint)
							{
								$constraint->aspectRatio();
							})->save($destinationThumbPath.$fileName, 70);

							$upload_success = $fileData->move($destinationPath, $fileName);  //move uploaded file
                            if(!empty($upload_success))
							{
								$FiledataSave[]=$fileName;

							}

                    }
                }
                if(!empty($FiledataSave)){
    				$product_detail->images = implode(',',$FiledataSave);
    			}

                $product_detail->save();

                if(isset($product_detail->id) && $product_detail->id > 0){

                    Log::info('product added successfully');
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
     * @param  $page
     * @return \Illuminate\Http\Response
     */
    public function ajaxPagination($page)
    {
        $data['products'] = Product::paginate(1);
        if ($request->ajax()) {
           return view('products.add_product', compact('data'));
       }

       return view('ajaxPagination',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id  product id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $product = Product::find(Crypt::decrypt($id));

            if(isset($product) && !empty($product->id)){

                $data['product'] = $product;
                $data['color'] = Config::get('constants.color');
                $data['weight'] = Config::get('constants.weight');
                $data['width'] = Config::get('constants.width');
                $data['height'] = Config::get('constants.height');
                $data['categories'] = Category::get();

                return view('products.edit_product', $data);
            }else{
                return response()->json(["result" => "error","status" => 200,'message'=>'Something went wrong!']);
            }
        }catch (Exception $e) {
           Log::error($e);
           return response()->json(['status' => 0, 'message' => 'Something went wrong.'], 500);
        }
        return redirect('/products');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStoreRequest $request)
    {
        try{
            $product = Product::find(Crypt::decrypt($request->product));
            $product_detail = ProductDetail::where('product_id','=',Crypt::decrypt($request->product))->first();

            if(isset($product) && !empty($product->id) && isset($product_detail) && !empty($product_detail->id)){

                //product Update
                $product->name = $request->name;
                $product->category_id = $request->category;
                $product->price = $request->price;
                $bool_product = $product->update();

                //product detail Update
                $product_detail->stock = $request->stock;
                $product_detail->color = implode(',', $request->color) ;
                $product_detail->weight = $request->weight;
                $product_detail->width = $request->width;
                $product_detail->height = $request->height;
                $product_detail->description = $request->description;

                $FiledataSave=array();
    		 	$file = array('files' => Input::file('files'));
                if(!empty(Input::file('files'))){
                    foreach(Input::file('files') as $fileData){

                            $destinationPath = 'uploads/products/';
							$destinationThumbPath = 'uploads/products/thumbnail/';

							if(!File::exists($destinationPath)) {
								File::makeDirectory($destinationPath, $mode = 0777, true, true);
							}
							if(!File::exists($destinationThumbPath)) {
								File::makeDirectory($destinationThumbPath, $mode = 0777, true, true);
							}
                            $extension = $fileData->getClientOriginalExtension(); // getting image extension
							$filenameoriginal = $fileData->getClientOriginalName(); // getting  file name

                            $filenameor =  rand(11111,99999).'_'.time();
							$fileName =$filenameor.".{$extension}";  // renameing image

                            $img = Image::make($fileData->getRealPath());
							$img->resize(100, null, function ($constraint)
							{
								$constraint->aspectRatio();
							})->save($destinationThumbPath.$fileName, 70);

							$upload_success = $fileData->move($destinationPath, $fileName);  //move uploaded file
                            if(!empty($upload_success))
							{
								$FiledataSave[]=$fileName;

							}

                    }
                }

                if(!empty($FiledataSave)){
                    if(isset($product_detail->images) && !empty($product_detail->images)){
                        $product_detail->images .= ','.implode(',',$FiledataSave);
                    }else{
                        $product_detail->images = implode(',',$FiledataSave);
                    }
    			}

                $bool_product_detail = $product_detail->update();

                if(isset($bool_product) && $bool_product > 0 && isset($bool_product_detail) && $bool_product_detail > 0){
                    Log::info('product updated successfully');
                    Session::flash('success_message','Updated Successfully!');
                }else{
                    Session::flash('error_message','Try again, Something went wrong');
                }
                return redirect()->route('edit_product',$request->product);
            }else{
                return response()->json(["result" => "error","status" => 200,'message'=>'Something went wrong!']);
            }
        }catch (Exception $e) {
           Log::error($e);
           return response()->json(['status' => 0, 'message' => 'Something went wrong.'], 500);
        }
        return redirect('/products');
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
            $bool = 0;
            $product = Product::find(Crypt::decrypt($request->val_id));
            if(isset($product->id) && !empty($product->id)){

                if(isset($product->productdetail->images) && !empty($product->productdetail->images)){

                    $image_array = explode(',',$product->productdetail->images);

    				for($i=0; $i < count($image_array); $i++){

    					if(isset($image_array[$i]) && !empty($image_array[$i])){

    						$destinationPath = 'uploads/products/';
    						$destinationThumbPath = 'uploads/products/thumbnail/';

    						if(isset($image_array[$i]) && File::exists($destinationThumbPath.$image_array[$i])){
    							$delete=File::delete($destinationThumbPath.$image_array[$i]);
    						}
    						if( isset( $image_array[$i] ) && File::exists( $destinationPath.$image_array[$i] ) ){
    							$delete=File::delete( $destinationPath.$image_array[$i] );
    						}

    					}
    				}
                }
                $bool = $product->delete();
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


    /**
     * Remove image the specified resource from storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroyProductImage(Request $request)
    {
        try{
            $bool = 0;
            $product_detail = ProductDetail::where('product_id','=',Crypt::decrypt($request->val_id))->first();
            if(isset($product_detail->id) && !empty($product_detail->id)){

                if(isset($product_detail->images) && !empty($product_detail->images)){

                    $image_array = explode(',',$product_detail->images);

                    $image_key = array_search($request->img,$image_array);

					if(isset($image_array[$image_key]) && !empty($image_array[$image_key])) {

						$destinationPath = 'uploads/products/';
						$destinationThumbPath = 'uploads/products/thumbnail/';

						if(isset($image_array[$image_key]) && File::exists($destinationThumbPath.$image_array[$image_key])){
							$delete=File::delete($destinationThumbPath.$image_array[$image_key]);
						}
						if( isset( $image_array[$image_key] ) && File::exists( $destinationPath.$image_array[$image_key] ) ){
							$delete=File::delete( $destinationPath.$image_array[$image_key] );
						}
                        unset($image_array[$image_key]);
					}
                    $img_srt=implode(',',$image_array);
                    $product_detail->images=$img_srt;

                    $bool = $product_detail->update();
                }
            }

            if(isset($bool) && $bool > 0){
                Log::info('product deleted successfully');
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
