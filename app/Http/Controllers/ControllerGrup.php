<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Grup;
use Divisi;

class ControllerGrup extends Controller {

    public function register(Request $request){
        $id_grup_line = $request->id_grup_line;
        $nama = $request->nama;
        $status_game = $request->status_game;
        $tipe_grup = $request->tipe_grup;

        $daftar = Grup::create([
            'id_grup_line' => $id_grup_line,
            'nama' => $nama,
            'status_game' => $status_game,
            'tipe_grup' => $tipe_grup
        ]);

        if($daftar){
            $res['success'] = true;
            $res['message'] = "Sukses mendaftarkan grup.";

            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = "Gagal mendaftarkan grup.";

            return response($res);
        }
    }

    public function get_by_line_id($id){
        $grup = Grup::where('id_grup_line', $id)->first();

        if($grup){
            $res['success'] = true;
            $res['result'] = $grup;

            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = "Grup dengan ID LINE Group $id tidak dapat ditemukan di Database.";

            return response($res);
        }
    }

    public function unregister($id){
        $grup = Grup::where('id_grup_line', $id)->first();

        if($grup){
            if($grup->delete()){
                $res['success'] = true;
                $res['result'] = $grup;
    
                return response($res);
            } else {
                $res['success'] = false;
                $res['message'] = "Error dalam query.";

                return response($res);
            }
        } else {
            $res['success'] = false;
            $res['message'] = "Grup dengan ID LINE Group $id tidak dapat ditemukan di Database.";
        
            return response($res);
        }
    }
}

?>