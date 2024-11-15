<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Validator;


class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = Karyawan::latest()->get();
        return response()->json([
            "success" => true,
            "message" => "data karyawan berhasil ditampilkan",
            "data" => $karyawan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|min:6',
            'jeniskelamin' => 'required',
            'jabatan'=> 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = auth()->user();
        $karyawan = $user->karyawans()->create([
            'nama' => $request->nama,
            'jeniskelamin' => $request->jeniskelamin,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
        ]);
        return response()->json([
            "success" => true,
            "message" => "data karyawan berhasil ditambahkan",
            "data" => $karyawan
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $karyawan = Karyawan::find($id);
        return response()->json([
            "success" => true,
            "message" => "data karyawan berhasil ditampilkan",
            "data" => $karyawan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|min:6',
            'jeniskelamin' => 'required',
            'jabatan'=> 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = auth()->user();
        $karyawan = $user->karyawans::where('id',$id)->update([
            'nama' => $request->nama,
            'jeniskelamin' => $request->jeniskelamin,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
        ]);
        return response()->json([
            "success" => true,
            "message" => "data karyawan berhasil di ubah",
            "data" => $karyawan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
