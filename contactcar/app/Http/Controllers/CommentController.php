<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CommentController extends Controller
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
                'data' => DB::table('comments')->get()
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

        $userId = $data->get("userId");
        $postId = $data->get("postId");
        $content = $data->get("content");

        if($userId == null || $postId == null){
            $response = response([
                'status' => 403,
                'message' => 'userId or postId is null',
            ],403);
            return $response;
        }

        try{
            $id = DB::table('comments')->insertGetId([
                'userId' => $userId,
                'postId' => $postId,
                'content' => $content
            ]);

            return response([
                'status' => 200,
                'message' => 'success',
                'data' => DB::table('comments')->where('id',$id)->first()
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
                'data' => DB::table('comments')->where('postId',$id)->get()
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

        $content = $data->get("content");

        try{
            DB::table('comments')->where('id',$id)->update(['content' => $content]);

            return response([
                'status' => 200,
                'message' => 'success',
                'data' => DB::table('comments')->where('id',$id)->first()
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
            DB::table('comments')->where('id',$id)->delete();
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
