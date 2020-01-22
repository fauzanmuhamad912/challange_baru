<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Siswa;
use App\Kelas;
use App\Sekolah;

class SekolahController extends Controller
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
        $sekolah = Sekolah::get();
        $massage = "";
        if($sekolah->count()>0){
            $massage = "Berhasil menampilkan data";
        }
            else{
                $massage = "Data tidak ada";
            }
            $result = array(
                "massage" => $massage,
                "data" => $sekolah,
            );
        
        return response()->json($result);
    }
    public function store(Request $request)
    {
        // Memvalidasi Field Yang Masuk.
        $this->validate($request, [
            'nama' => 'required',
        ]);

        $insert = Sekolah::create([
            'nama' => $request->nama,
        ]);

        $result = array(
            'message' => 'Data Siswa Berhasil di Simpan.',
            'data' => $insert
        );

        return response()->json($result);
    }
}
