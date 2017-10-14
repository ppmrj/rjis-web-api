<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Grup;
use App\Divisi;

class ControllerGrup extends Controller {

    public function register(Request $request, $nama){
        $divisi = Divisi::where('nama', $nama)->first();
        if ($divisi) {
            $id_grup_line = $request->id_grup_line;
            $nama = $request->nama;
            $status_game = $request->status_game;
            $tipe_grup = $request->tipe_grup;
            $id_divisi = $divisi->id;

            $daftar = Grup::create([
                'id_grup_line' => $id_grup_line,
                'nama' => $nama,
                'status_game' => $status_game,
                'tipe_grup' => $tipe_grup,
                'id_divisi' => $id_divisi
            ]);

            if ($daftar) {
                $res['success'] = true;
                $res['message'] = "Sukses mendaftarkan grup.";

                return response($res);
            } else {
                $res['success'] = false;
                $res['message'] = "Gagal mendaftarkan grup.";

                return response($res);
            }
        } else {
            $res['success'] = true;
            $res['message'] = "Divisi $nama tidak ada di Database.";

            return response($res);
        }
    }

    public function get_by_line_id($id){
        $grup = Grup::where('id_grup_line', $id)->first();

        if($grup){
            $divisi = $grup->divisi()->first();
            $res['success'] = true;
            $res['result'] = $grup;
            $res['result']['divisi'] = $divisi->nama;

            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = "Grup dengan ID LINE Group $id tidak dapat ditemukan di Database.";

            return response($res);
        }
    }

    public function get_grup_by_divisi($divisi){
        $grup = Divisi::where('nama', $divisi)->grup()->get();

        if($grup){
            $res['success'] = true;
            $res['result'] = $grup;
            $i=0;
            foreach ($grup as $g){
                $res['result'][$i]['divisi'] = $g->divisi()->nama;
                $i++;
            }

            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = "Tidak ada divisi dengan nama $divisi.";

            return response($res);
        }
    }

    public function unregister($id){
        $grup = Grup::where('id_grup_line', $id)->first();

        if($grup){
            if($grup->delete()){
                $res['success'] = true;
                $res['message'] = "Behasil menghapus grup dari database.";
    
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