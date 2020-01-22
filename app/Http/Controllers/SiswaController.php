<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Siswa;
use App\Kelas;
use App\Sekolah;

class SiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    public function show(Request $request)
    {
        $siswa = Siswa::get();
        // Inisisasi Variable
        $message = "";

        // Jika Siswa Nya Lebih Dari Kosong;
        if ($siswa->count() > 0) {
            // Set Ulang Variable $message;
            $message = "Berhasil Mengambil Data Siswa.";
        } else {
            // Set Ulang Variable $message;
            $message = "Data Kosong.";
        }

        $result = array(
            "message" => $message,
            "data" => $siswa
        );

        return response()->json($result);

    }
    public function store(Request $request)
    {
        // Memvalidasi Field Yang Masuk.
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email|unique:siswa',
            'kelas_id' => 'required',
            'gender' => 'required',
        ]);

        $insert = Siswa::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'kelas_id' => $request->kelas_id,
            'gender' => $request->gender,
        ]);

        $result = array(
            'message' => 'Data Siswa Berhasil di Simpan.',
            'data' => $insert
        );

        return response()->json($result);
    }
    public function showrombel(Request $request, $kelas_id)
    {
        $kelas = Kelas::find($kelas_id);
        $siswa = Siswa::where('kelas_id',$kelas_id)->get();

        $data = [];
        $data = $kelas;
        $data['siswa'] = $siswa;

        $massage = "";
        if($siswa){
            $massage = "Berhasil menampilkan data";
            $result = array(
                "massage" => $massage,
                "data" => $data,
            );

            return response()->json($result);
        }else{
            $massage = "Data Kosong.";
        } 

        $result = array([
        "massage" => $massage,
        ]);
        return response()->json($result);
    }
    public function update(Request $request, $id)
    {
        {
            $siswa = Siswa::find($id);
            $result = ['massage' => 'Data tidak ditemukan'];
            if ($siswa){
                $siswa->nama = $request->nama;
                // $siswa->email = $request->email;
                $siswa->kelas_id = $request->kelas_id;
                $siswa->gender = $request->gender;
    
                $siswa->save();
    
                $result = array([
                    'massage' => 'Data berhasil diUpdate',
                    'data' => $siswa
                ]);
    
                return response()->json($result);
            }
            return response()->json($result);
        }
    }
    public function delete(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        $result = ['massage' => 'Data tidak ditemukan.'];

        if($siswa){
            $siswa->delete();

            $result = array([
                "massage" => "Data Berhasil di Delete",
                "data" => $siswa
            ]);
            return response()->json($result);
        }
        return response()->json($result);
    }
    public function showBySekolah(Request $request, $id)
    {
        $sekolah = Sekolah::find($id);
        $kelas = Kelas::where('sekolah_id',$id)->get();
        // $siswa = Siswa::where('kelas_id',$id)->get();

        $data = [];
        // $data['sekolah'] = $sekolah;
        // $data = $sekolah;
        // $data['kelas'] = $kelas;
        
        foreach ($kelas as $kelas)
        {
            $siswa = Siswa::where('kelas_id',$kelas['id'])->get();
            
            foreach($siswa as $siswa) {
                $data[] = $siswa;
            }
        }
        

        $massage = "";
        if($siswa){
            $massage = "Berhasil menampilkan data";
            $result = array(
                "massage" => $massage,
                "data" => $data,
            );

            return response()->json($result);
        }else{
            $massage = "Data Kosong.";
        } 

        $result = array([
        "massage" => $massage,
        ]);
        return response()->json($result);
    }
    public function showSortir(Request $request, $id)
    {
        $sekolah = Sekolah::with(['kelas' => function($q){
            $q->with(['siswa']);
        }
        ])->find($id);
        // $kelas = Kelas::whit(['kelas' => function ])where('sekolah_id',$id)->get();
        // $siswa = Siswa::where('kelas_id',$id)->get();

        // $data = [];
        // $data['sekolah'] = $sekolah;
        // $data = $sekolah;
        // $data['kelas'] = $kelas;
        
        // foreach ($kelas as $kelas)
        // {
        //     $siswa = Siswa::where('kelas_id',$kelas['id'])->get();
        //     $data[$kelas['nama']] = $siswa;
        //     foreach($siswa as $siswa){
        //         $data[] = $siswa;
        //     }
        // }
        

        // $massage = "";
        // if($siswa){
            // $massage = "Berhasil menampilkan data";
        //     $result = array(
        //         "massage" => $massage,
        //         "data" => $data,
        //     );

        //     return response()->json($result);
        // }else{
        //     $massage = "Data Kosong.";
        // } 

        // $result = array([
        // "massage" => $massage,
        // ]);
        return response()->json($sekolah);
    }
}
