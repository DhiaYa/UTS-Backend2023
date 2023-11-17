<?php

namespace App\Http\Controllers;
use App\Models\Employees;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index() {
        // mendapatkan semua data pegawais
        $pegawais = Employees::all();

        $data = [
            "message" => "Get all resources",
            "data" => $pegawais
        ];

        // kirim data (json) dan  response code
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
       // memvalidasi data request 
       $validateData = $request->validate([
        'name' => 'required',
        'gender' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'email' => 'required',
        'status' => 'required',
        'hired_on' => 'required'
    ]);


    // membuat data
    $employees = Employees::create($validateData);
    
    $data = [
        'message' =>'Pegawai is Created Succesfully',
        'data'=> $employees,
    ];

    // mengembalikan data (json) dan kode 201
    return response()->json($data,201);
    }

    // mendapatkan detail resource pegawai
    // membuat method show
    public function show($id)
    {
        // cari id pegawai yang ingin didapatkan
        $pegawai = Employees::find($id);
        if ($pegawai) {
            $data = [
                'message' => 'Get detail pegawai',
                'data' => $pegawai,
            ];

            // mengambilkan data (json) dan kode 200
            return response()->json($data, 200);
        }else{
            $data = [
                'message' => 'pegawai not found',
            ];

            // mengembalikan data (json) dan ode 404
            return response()->json($data, 404);
        }
    }

    public function update($id, Request $request)
    {
        // menangkap id dari parameter
        $pegawai = Employees::find($id);
        // cek apakah ada pegawai dengan id tersebut
        // dan jika yang di cari tidak ada, kirim kode 404
        if (!$pegawai) {
            $data = [
                'message' => 'Data tidak ditemukan',
            ];
            return response()->json($data, 404);
        }

        

        //Menyimpan data yang telah diubah
        $pegawai->save();

        $data = [
            'message' => 'Data Berhasil Diubah',
            'data' => $pegawai
        ];
        return response()->json($data, 200);
    }

    public function destroy($id)

    {
        // mencari data pegawai berdasarkan id
        $pegawai = Employees::find($id);

        // mengecek apakah data tersebut ada atau tidak
        if (!$pegawai) {
            $data = [
                'message' => 'Data tidak berhasil ditemukan',
            ];

            return response()->json($data, 404);
        }

        // menghapus data pegawai 
        $pegawai->delete();

        $data = [
            'message' => 'Data berhasil dihapus',
        ];
        return response()->json($data,203);
}
}