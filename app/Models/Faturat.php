<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faturat extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'faturat';

    public function fatura_detajet (){
        return $this->hasMany(FaturatDetajet::class, 'id_fatures','nr_fature');
    }
    public function zbritjet (){
        return $this->hasOne(Discount::class, 'fatura_id','nr_fature');
    }

    public function agjenti (){
        return $this->belongsTo(User::class, 'agjent_id','id');
    }

    public function klienti (){
        return $this->belongsTo(Klientet::class, 'klient_id','id');
    }
}
