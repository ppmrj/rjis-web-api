<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grup extends Model {
    
    protected $table = 'grup';

    protected $fillable = [
        'id_grup_line',
        'nama',
        'status_game',
        'tipe_grup',
        'id_divisi'
    ];

    public function divisi(){
        return $this->belongsTo('App\Divisi', 'id_divisi');
    }
}

?>