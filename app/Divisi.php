<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model {
    
    protected $table = 'divisi';

    protected $fillable = [
        'id_divisi',
        'nama'
    ];

    public function grup(){
        return $this->hasMany('App\Grup');
    }
}

?>