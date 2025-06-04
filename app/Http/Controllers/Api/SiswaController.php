<?php

namespace App\Http\Controllers\Api;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas = Siswa::all();
        return response()->json($siswas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:siswas',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'gagal',
                'error' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        $siswa = Siswa::create([
            // yang kiri yang harus disamain sama yang di database
            // yang kanan yang diambil dari validasi
            'nama' => $validated['name'],
            'nis' => $request['nis'],
            'gender' => $request['gender'],
            'alamat' => $request['alamat'],
            'kontak' => $request['kontak'],
            'email' => $validated['email'],
        ]);
        return response()->json([
            'status' => 'Berhasil menambahkan siswa',
            'siswa' => $siswa,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::where('id', $id)->first();
        return response()->json($siswa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::where('id', $id)->first();
        if(!Siswa::where('id', $id)->exists()){
            return response()->json([
                'status' => 'Siswa tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'string|max:255',
            'nis' => 'integer|unique:siswas,nis,',
            'gender' => 'enum|in:laki-laki,perempuan',
            'alamat' => 'string|max:65535',
            'kontak' => 'string|max:255',
            'email' => 'string|email|max:255|unique:siswas,email,',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'gagal',
                'error' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        $siswa->update($validated);
        return response()->json([
            'status' => 'Berhasil mengupdate siswa',
            'siswa' => $siswa,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::where('id', $id)->first();
        if(!Siswa::where('id', $id)->exists()){
            return response()->json([
                'status' => 'Siswa tidak ditemukan'
            ], 404);
        }
        $siswa->delete();
        return response()->json([
            'status' => 'Berhasil menghapus siswa',
        ], 200);
    }
}
