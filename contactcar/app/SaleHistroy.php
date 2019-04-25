<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleHistroy extends Model
{
    //
    protected $fillable = [
        'title', 'content', 'price',
    ];

    public function Pictures(){
        return $this->hasMany(Pictures::class);
    }
}
