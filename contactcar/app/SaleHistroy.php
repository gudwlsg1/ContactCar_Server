<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleHistroy extends Model
{
    //
    protected $fillable = [
        'title', 'content', 'price','userId',
    ];

    public function Pictures(){
        return $this->hasMany(Pictures::class);
    }
}
