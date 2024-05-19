<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategorite extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'kategorite';


    public function kategoria_ame(){
        return $this->belongsTo(Kategorite::class,'parent_id', 'id');
    }

}
