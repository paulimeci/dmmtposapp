<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blerjet extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'blerjet';

    public function furnitori(){
        return $this->belongsTo(Furnitoret::class, 'furnitor_id','id');
    }
    public function kategoria(){
        return $this->belongsTo(Kategorite::class, 'kategori_id','id');
    }
    public function produkti(){
        return $this->belongsTo(Produkti::class, 'produkt_id','id');
    }
}
