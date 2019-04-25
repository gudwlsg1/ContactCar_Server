<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pictures extends Model
{
    //
    protected $fillable = [ "path" , "saleId" ];

    public function SaleHistroy(){
        return $this->belongsTo(SaleHistroy::class);
    }
}
