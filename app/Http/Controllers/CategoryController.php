<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Http\Requests\CategoryStoreRequest;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data['categories'] = Category::get();
            $data['status'] = Config::get('constants.status');
            return view('category.categories', $data);
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
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        try{

            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            if(isset($request->status) && !empty($request->status) && $request->status=='1'){
                $category->status = '1';
            }else{
                $category->status = '0';
            }
            $bool = $category->save();
            if(isset($bool) && $bool > 0){
                Session::flash('success_message','Saved Successfully!');
            }else{
                Session::flash('error_message','Try again, Something went wrong');
            }

        }catch (Exception $e) {
           Log::error($e);
           return response()->json(['status' => 0, 'message' => 'Something went wrong.'], 500);
        }
        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try{
            $category=Category::find(Crypt::decrypt($request->val_id));
            if(isset($category->id) && !empty($category->id)){
                return response()->json(["result" => "success","status" => 200,'description'=>$category->description,'name'=>$category->name,'status'=>$category->status]);
            }else{
                return response()->json(["result" => "error","status" => 200,'message'=>'Something went wrong!']);
            }
        }catch (Exception $e) {
           Log::error($e);
           return response()->json(['status' => 0, 'message' => 'Something went wrong.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryStoreRequest $request)
    {
        try{
            $category=Category::find(Crypt::decrypt($request->category));
            if(isset($category->id) && !empty($category->id)){
                $category->name = $request->name;
                $category->description = $request->description;
                if(isset($request->status) && !empty($request->status) && $request->status=='1'){
                    $category->status = '1';
                }else{
                    $category->status = '0';
                }
                $bool = $category->update();
                if(isset($bool) && $bool>0){
                    Session::flash('success_message','Saved Successfully!');
                }else{
                    Session::flash('error_message','Try again, Something went wrong');
                }
            }else{
                return response()->json(["result" => "error","status" => 200,'message'=>'Something went wrong!']);
            }
            return redirect('/categories');
        }catch (Exception $e) {
           Log::error($e);
           return response()->json(['status' => 0, 'message' => 'Something went wrong.'], 500);
        }
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
            $category=Category::find(Crypt::decrypt($request->val_id));
            if(isset($category->id) && !empty($category->id)){
                $bool=$category->delete();
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
