<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->json();

        $email = null;
        $address = null;

        $name = $data->get("name");
        $userId = $data->get("userId");
        $email = $data->get("email");
        $password = $data->get("password");
        $address = $data->get("address");

        $id = DB::table('users')->insertGetId([
            'name' => $name,
            'userId' => $userId,
            'email' => $email,
            'password' => $password,
            'address' => $address
        ]);

        return response([
            'status' => 200,
            'message' => 'success',
            'data' => DB::table('users')->where('id',$id)->first()
        ]);
    }

    public function login(Request $request){
        $data = $request->json();

        $userId = $data->get("userId");
        $password = $data->get("password");

        $id = DB::table('users')->where('userId',$userId)->where('password',$password)->value('id');

        if($id === "" || $id === null){
            return response([
                'status' => 404,
                'message' => 'NOT FOUND',
                'data' => null
            ]);
        }

        return response([
            'status' => 200,
            'message' => 'success',
            'data' => DB::table('users')->where('id',$id)->first()
        ]);
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
