<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Siswa;
use App\Sekolah;
use App\Kelas;

class KelasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show(Request $request)
    {
        $kelas = Kelas::get();
        $massage = "";
        if($kelas->count()>0){
            $massage = "Berhasil menampilkan data";
        }
            else{
                $massage = "Data tidak ada";
            }
            $result = array(
                "massage" => $massage,
                "data" => $kelas,
            );
        
        return response()->json($result);
    }
    public function store(Request $request)
    {
        // Memvalidasi Field Yang Masuk.
        $this->validate($request, [
            'nama' => 'required',
            'sekolah_id' => 'required',
        ]);

        $insert = Kelas::create([
            'nama' => $request->nama,
            'sekolah_id' => $request->sekolah_id,
        ]);

        $result = array(
            'message' => 'Data Siswa Berhasil di Simpan.',
            'data' => $insert
        );

        return response()->json($result);
    }
}
