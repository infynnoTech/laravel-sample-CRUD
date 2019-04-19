<?php

namespace App\Http\Controllers;

use Input,
    Config,
    Hash,
    Image,
    File,
	Redirect,
	Response,
    View,
    URL,
    Mail;
use Crypt;
use Session;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $data['users'] = User::paginate(5);
            return view('user.users', $data);

        } catch (Exception $e) {

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
    public function store(UserStoreRequest $request)
    {
        try {

            $user = new User();

            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make( $request->password );

            $bool = $user->save();

            if(isset($bool) && $bool > 0) {

                 return response()->json(['result' => 'sucess', 'message' => 'saved successfully.', 'status' => 200]);
            } else {

                 return response()->json(['result' => 'erro', 'message' => 'some thing went wrong.', 'status' => 500]);
            }

        } catch(Exception $e) {

           Log::error($e);

           return response()->json(['status' => 0, 'message' => 'Something went wrong.'], 500);
        }

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
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
        try {

            $user = User::find(Crypt::decrypt($request->val_id));

            if(isset($user->id) && !empty($user->id)){

                return response()->json(["result" => "success","status" => 200,'email' => $user->email,'name' => $user->name]);

            }else{

                return response()->json(["result" => "error","status" => 200,'message' => 'Something went wrong!']);
            }

        } catch (Exception $e) {

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
    public function update(UserStoreRequest $request)
    {
        try {

            $user=User::find(Crypt::decrypt($request->user));

            if(isset($user->id) && !empty($user->id)) {

                $user->name  = $request->name;
                $user->email = $request->email;

                $bool = $user->update();

                if(isset($bool) && $bool>0) {

                    Session::flash('success_message','Saved Successfully!');

                }else {

                    Session::flash('error_message','Try again, Something went wrong');
                }
            } else {

                return response()->json(["result" => "error","status" => 200,'message'=>'Something went wrong!']);
            }

            return redirect('/users');

        } catch (Exception $e) {

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
        try {

            $bool = 0;
            $user = User::find(Crypt::decrypt($request->val_id));

            if(isset($user->id) && !empty($user->id)) {

                $bool = $user->delete();
            }
            if(isset($bool) && $bool > 0) {

                return response()->json(["result" => "success","status" => 200,'message'=>'Successfully Deleted!']);

            } else {

                return response()->json(["result" => "error","status" => 200,'message'=>'Something went wrong!']);
            }

        } catch (Exception $e) {

           Log::error($e);
           return response()->json(['status' => 0, 'message' => 'Something went wrong.'], 500);
        }
    }
}
