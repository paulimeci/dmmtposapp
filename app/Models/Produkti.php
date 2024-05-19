<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produkti extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'produkti';


    public function unit(){
        return $this->belongsTo(Njesia::class,'njesia_id','id');
    }

    public function category(){
        return $this->belongsTo(Kategorite::class,'category_id','id');
    }
    public function cmimi()
    {
        return $this->hasOne(ProductQP::class, 'product_id', 'id');
    }
}
