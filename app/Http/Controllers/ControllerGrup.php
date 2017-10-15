<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Log;
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

            if (!Grup::where('id_grup_line', $id_grup_line)->first()) {
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
                    Log::info($res['message']);

                    return response($res);
                } else {
                    $res['success'] = false;
                    $res['message'] = "Gagal mendaftarkan grup.";
                    Log::info($res['message']);

                    return response($res);
                }
            } else {
                $res['success'] = false;
                $res['message'] = "Grup ini sudah terdaftar ke dalam database dibawah divisi ".Grup::where('id_grup_line', $id_grup_line)->first()->divisi()->first()->nama.".";
                Log::info($res['message']);

                return response($res);
            }
        } else {
            $res['success'] = true;
            $res['message'] = "Divisi $nama tidak ada di Database.";
            Log::info($res['message']);

            return response($res);
        }
    }

    public function get_by_line_id($id){
        $grup = Grup::where('id_grup_line', $id)->first();

        if($grup){
            $divisi = $grup->divisi()->get();
            $res['success'] = true;
            $res['result'] = $grup;
            $res['result']['divisi'] = $divisi->nama;
            Log::info("Sukses get by line id");

            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = "Grup dengan ID LINE Group $id tidak dapat ditemukan di Database.";
            Log::info($res['message']);

            return response($res);
        }
    }

    public function get_grup_by_divisi($divisi){
        $div = Divisi::where('nama', $divisi)->first();
        if ($div) {
            $grup = $div->grup()->get();

            if ($grup->isNotEmpty()) {
                $res['success'] = true;
                $res['result'] = $grup;
                $i = 0;
                foreach ($grup as $g) {
                    $res['result'][$i]['divisi'] = $g->divisi()->first()->nama;
                    $i++;
                }
                Log::info("Sukses get grup by divisi");

                return response($res);
            } else {
                $res['success'] = false;
                $res['message'] = "Tidak ada grup yang dimiliki oleh divisi $divisi.";
                Log::info($res['message']);

                return response($res);
            }
        } else {
            $res['success'] = false;
            $res['message'] = "Tidak ada divisi dengan nama $divisi.";
            Log::info($res['message']);

            return response($res);
        }
    }

    public function unregister($id){
        $grup = Grup::where('id_grup_line', $id)->first();

        if($grup){
            if($grup->delete()){
                $res['success'] = true;
                $res['message'] = "Behasil menghapus grup dari database.";
                Log::info($res['message']);
    
                return response($res);
            } else {
                $res['success'] = false;
                $res['message'] = "Error dalam query.";
                Log::info($res['message']);

                return response($res);
            }
        } else {
            $res['success'] = false;
            $res['message'] = "Grup dengan ID LINE Group $id tidak dapat ditemukan di Database.";
            Log::info($res['message']);
        
            return response($res);
        }
    }
}

?>