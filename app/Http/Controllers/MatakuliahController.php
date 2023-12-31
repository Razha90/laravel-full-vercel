<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected function Database() {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function show(string $id) {
        if (!$this->Database()) {
            return response()->json(['message' => 'Failed to connect to the database'], 500);
        }

        $matakuliah = Matakuliah::find($id);

        if ($matakuliah == null) {
            $response = [
                'message' => "Not Data Found"
            ];
            return response()->json($response, 404);
        }
        
        $matakuliah->mahasiswa = 
            $matakuliah->dosen()->get()
        ;
        $response = [
            'message' => 'Successfully Show Data',
            'data' => $matakuliah
        ];

        return response()->json($response, 200);
    }

    public function index()
    {
        if (!$this->Database()) {
            return response()->json(['message' => 'Failed to connect to the database'], 500);
        }
        
        $matakuliah = Matakuliah::with('dosen')->paginate(10);
        
        $response = [
            'message' => 'Database Successfully Retrieved',
            'data' => $matakuliah
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        if (!$this->Database()) {
            return response()->json(['message' => 'Failed to connect to the database'], 500);
        }
        $validator = Validator::make($request->all(),[
            'kode' => "required|unique:matakuliah,kode",
            'nama_matakuliah' => 'required|max:100',
            "daya_tampung" => 'required|numeric',
            'jadwal'=> 'required',
            "id_dosen" => "required|exists:dosen,nim"
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }
        $matakuliah = new Matakuliah;
        $kode = $request->input('kode');
        $nama_matakuliah = $request->input('nama_matakuliah');
        $daya_tampung = $request->input('daya_tampung');
        $jadwal = $request->input('jadwal');
        $id_dosen = $request->input('id_dosen');

        $matakuliah->kode = $request->input('kode');
        $matakuliah->nama_matakuliah = $request->input('nama_matakuliah');
        $matakuliah->daya_tampung = $request->input('daya_tampung');
        $matakuliah->jadwal = $request->input('jadwal');
        $matakuliah->id_dosen = $request->input('id_dosen');

        if (!$matakuliah->save()) {
            return response()->json(['error' => 'Failed to save Dosen, Database Server Problem'], 500);
        }

        $response = [
            'message' => 'Data Dosen Successfully Created',
            'data' => [
                "kode" => $kode,
                "nama_matakuliah" => $nama_matakuliah,
                "daya_tampung" => $daya_tampung,
                "jadwal" => $jadwal,
                "id_dosen" => $id_dosen
            ]
        ];
        return response()->json($response, 201);
    }

    public function update(Request $request, string $id)
    {
        if (!$this->Database()) {
            return response()->json(['message' => 'Failed to connect to the database'], 500);
        }
        
        $validator = Validator::make($request->all(),[
            'kode' => "required|unique:matakuliah,kode",
            'nama_matakuliah' => 'required|max:100',
            "daya_tampung" => 'required|numeric',
            'jadwal'=> 'required',
            "id_dosen" => "required|exists:dosen,nim"
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }        

        $matakuliah = Matakuliah::find($id);

        $kode = $request->input('kode');
        $nama_matakuliah = $request->input('nama_matakuliah');
        $daya_tampung = $request->input('daya_tampung');
        $jadwal = $request->input('jadwal');
        $id_dosen = $request->input('id_dosen');

        if (!$matakuliah->update($request->all())) {
            return response()->json(['error' => 'Failed to save Dosen, Database Server Problem'], 500);
        }

        $response = [
            'message' => 'Data Dosen Successfully Created',
            'data' => [
                "kode" => $kode,
                "nama_matakuliah" => $nama_matakuliah,
                "daya_tampung" => $daya_tampung,
                "jadwal" => $jadwal,
                "id_dosen" => $id_dosen
            ]
        ];
        
        return response()->json(['message'=>$response], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->Database()) {
            return response()->json(['message' => 'Failed to connect to the database'], 500);
        }

        $matakuliah = Matakuliah::find($id);
        if ($matakuliah == null) {
            $response = [
                'message' => "Not Data Found"
            ];
            return response()->json($response, 404);
        }
        
        if (!$matakuliah->delete()) {
            $response = [
                'message' => "Successfully Delete",
                'data' => $matakuliah
            ];
            return response()->json($response, 404);
        }

        return response()->json(['message'=>'Successfully Delete'],204);
    }
}
