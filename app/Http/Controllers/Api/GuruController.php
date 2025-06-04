<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Validator;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::all();
        return response()->json($guru);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:gurus'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'gagal',
                'error' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        $guru = Guru::create([
            'nama' => $validated['name'],
            'nip' => $request['nip'],
            'gender' => $request['gender'],
            'alamat' => $request['alamat'],
            'kontak' => $request['kontak'],
            'email' => $validated['email'],
        ]);
        
        return response()->json([
            'status' => 'Berhasil menambahkan guru',
            'guru' => $guru,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guru = Guru::where('id', $id)->first();
        return response()->json($guru);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guru = Guru::where('id', $id)->first();
        if(!Guru::where('id', $id)->exists()) {
            return response()->json([
                'status' => 'Guru tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'string|max:255',
            'nip' => 'integer|unique:gurus,nip',
            'gender' => 'enum|in:laki-laki,perempuan',
            'alamat' => 'string|max:65535',
            'kontak' => 'string|max:255',
            'email' => 'string|email|max:255|unique:gurus,email',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'gagal',
                'error' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        $guru->update($validated);
        return response()->json([
            'status' => 'Berhasil mengupdate guru',
            'guru' => $guru,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guru = Guru::where('id', $id)->first();
        if(!Guru::where('id', $id)->exists()) {
            return response()->json([
                'status' => 'Guru tidak ditemukan',
            ], 404);
        }

        $guru->delete();
        return response()->json([
            'status' => 'Berhasil menghapus guru',
        ], 200);
    }
}
