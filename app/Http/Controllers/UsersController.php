<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Salary;
use App\Departments;
use DB;
use Session;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        return view('login', $data);
    }

    public function validateUser(Request $request) {
        
        // print_r($request->all());
        $this->validate($request, [
            'user_name' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        if ($request->has("user_name") && $request->has("user_name") != null || $request->has("password") && $request->has("password") != null) {
            $rs_employee = User::where("email_id", $request->user_name)
                    ->where('password', md5($request->password))
                    ->first();
                // echo $request->user_name."====".md5($request->password);
                // print_r($rs_employee);

            if ($rs_employee) {
                if($rs_employee->role_id != 1){
                    return response(array("message"=> "This is Administrator Login."), 400)
                    ->header('Content-Type', 'application/json');
                }

                $response = array(
                    "message" => "User validated successfully.",
                    "data" => $rs_employee
                );

                $user_rs = $rs_employee->toArray();

                Session::put(['user_name'=> $rs_employee->email_id,
                    "password"=> $request->password,
                    "role_id" => $rs_employee->role_id,
                    "organization_id" => $rs_employee->organization_id,
                    "user_data" => $rs_employee->toArray()
                ]);

                
                return redirect()->route('dashboard.index');
                
            } else {
                return response(array("message"=> "Invalid username or password"), 401)
                    ->header('Content-Type', 'application/json');
            }
        }else{
            return response(array("message"=> "Required input not found"), 406)
                ->header('Content-Type', 'application/json');
        }
    }

    public function getLogout(){
        // Auth::logout();
        Session::flush();
        return redirect()->route('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
