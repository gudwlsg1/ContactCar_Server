<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PictureController extends Controller
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
                'data' => DB::table('pictures')->get()
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
        $postId = $request->postId;
        $data[] = null;
        $files = $request->file('images');
        try {
            if($request->hasFile("images")){
                foreach($files as $image) {
                    $name = $image->getClientOriginalName();
                    $path = str_random().filter_var($name, FILTER_SANITIZE_URL);
                    $image->move(public_path().'/images/',$path);
                    $data[] = $path;
                }
            }
        }catch(\Exception $e){
            return response([
                'status' => 500,
                'message' => $e,
                'data' => null
            ]);
        }

        foreach ($data as $path){
           if($path != null){
               DB::table('pictures')->insert([
                   'postId' => $postId,
                   'path' => $path
               ]);
           }
        }
        return response([
            'status' => 200,
            'message' => 'success',
            'data' => null
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        //
        echo $name;
        $path = public_path().'/images/'.$name;
        return response()->download($path, $name, ['Content-Type' => 'jpg']);
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
