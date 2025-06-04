<?php

namespace App\Http\Controllers\Api;

use App\Models\Industri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class IndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $industri = Industri::get();
        return response()->json($industri, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $industri = Industri::create([
            'nama' => $request['nama'],
            'bidang_usaha' => $request['bidang_usaha'],
            'guru_id' => $request['guru_id'],
            'alamat' => $request['alamat'],
            'kontak' => $request['kontak'],
            'email' => $request['email'],
        ]);
        return response()->json([
            'status' => 'Berhasil menambahkan industri',
            'industri' => $industri,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $industri = Industri::find($id);
        return response()->json($industri, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $industri = Industri::where('id', $id)->first();
        if(!Industri::where('id', $id)->exists()) {
            return response()->json([
                'status' => 'Guru tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'string|max:255',
            'bidang_usaha' => 'string|max:255',
            'guru_id' => 'integer|exists:gurus,id',
            'alamat' => 'string|max:65535',
            'kontak' => 'string|max:255',
            'email' => 'string|email|max:255|unique:industris,email',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'gagal',
                'error' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        $industri->update($validated);

        return response()->json([
            'status' => 'Berhasil memperbarui industri',
            'industri' => $industri,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $industri = Industri::find($id);        
        $industri->delete();
        return response()->json(['message' => 'Industri berhasil dihapus'], 200);
    }
}
