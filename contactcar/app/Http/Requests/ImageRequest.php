<?php
/**
 * Created by PhpStorm.
 * User: 45879
 * Date: 2019-06-20
 * Time: 오후 1:11
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class ImageRequest extends FormRequest
{
    protected $dontFlash = ['files'];

    public function rules(){
        try{
            return [
                'images' => ['array'],
                'images.*' => ['mimes:jpg,png,zip,tar', 'max:30000'],
            ];
        }catch (\Exception $e){
            echo $e;
        }
    }
}