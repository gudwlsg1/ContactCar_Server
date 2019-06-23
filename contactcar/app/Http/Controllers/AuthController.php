<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use DB;
use PDO;
use mysql_xdevapi\Exception;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return response([
                'status' => 200,
                'message' => 'success',
                'data' => DB::table('users')->get()
            ]);

        }catch (QueryException $ex){
            $response = response([
                'status' => 403,
                'message' => 'exist value',
            ],403);
            return $response;
        }
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

        try{
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

        }catch (QueryException $ex){
            $response = response([
                'status' => 403,
                'message' => 'exist value',
            ],403);
            return $response;
        }
    }

    public function login(Request $request){
        $data = $request->json();

        $userId = $data->get("userId");
        $password = $data->get("password");

        try{

            $data = DB::select('select * from users where userId = ? and password = ?',[$userId, $password]);
            //DB::select(`select * from users where userId = '$userId' and password = '$password'`);
            if(!$data){
                return response([
                    'status' => 404,
                    'message' => 'NOT FOUND',
                    'data' => null
                ]);
            }

            return response([
                'status' => 200,
                'message' => 'success',
                'data' => $data[0]
            ]);
        }catch (QueryException $ex){
//            return response([
//                'status' => 404,
//                'message' => $ex,
//                'data' => null
//            ]);
            return $ex;
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
