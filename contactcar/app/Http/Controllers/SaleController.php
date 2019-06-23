<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Symfony\Component\VarDumper\Cloner\Data;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
            return response([
                'status' => 200,
                'message' => 'success',
                'data' => DB::table('salehistorys')->get()
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
        //
        $data = $request->json();

        $content = null;
        $userId = null;

        $title = $data->get("title");
        $content = $data->get("content");
        $price = $data->get("price");
        $userId = $data->get("userId");

        if($userId == null){
            $response = response([
                'status' => 403,
                'message' => 'userId is null',
            ],403);
            return $response;
        }

        try{
            $id = DB::table('salehistorys')->insertGetId([
                'title' => $title,
                'content' => $content,
                'price' => $price,
                'userId' => $userId
            ]);

            return response([
                'status' => 200,
                'message' => 'success',
                'data' => DB::table('salehistorys')->where('id',$id)->first()
            ]);

        }catch (QueryException $ex){
            $response = response([
                'status' => 500,
                'message' => 'Server Error',
            ],500);
            return $response;
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
        try{
            return response([
                'status' => 200,
                'message' => 'success',
                'data' => DB::table('salehistorys')->where('id',$id)->first()
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
        $data = $request->json();

        $title = $data->get("title");
        $content = $data->get("content");
        $price = $data->get("price");

        try{
            DB::table('salehistorys')->where('id',$id)->update(['title' => $title, 'content' => $content, 'price' => $price, 'updated' => \Carbon\Carbon::now()->addHours(9)]);

            return response([
                'status' => 200,
                'message' => 'success',
                'data' => DB::table('salehistorys')->where('id',$id)->first()
            ]);
        }catch (QueryException $ex){
            $response = response([
                'status' => 500,
                'message' => 'Server Error',
            ],500);
            return $response;
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
        //
        try{
            DB::table('salehistorys')->select('price')->where('id',$id)->delete();
            return response([
                'status' => 200,
                'message' => 'success',
                'data' => true
            ]);
        }catch(QueryException $ex){
            return response([
                'status' => 500,
                'message' => 'Server error',
                'data' => false
            ]);
        }
    }
}
