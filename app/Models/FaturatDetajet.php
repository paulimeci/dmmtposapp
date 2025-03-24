<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaturatDetajet extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'faturat_detajet';

    public function produkti (){
        return $this->belongsTo(Produkti::class,'produkt_id','id');

    }





}
