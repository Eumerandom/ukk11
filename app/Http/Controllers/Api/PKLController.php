<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PKLRequest;
use App\Http\Resources\PKLResource;
use App\Models\PKL;
use Illuminate\Http\Request;

class PKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pkl = PKL::with(['siswa', 'industri', 'guru'])->get();
        return PKLResource::collection($pkl);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PKLRequest $request)
    {
        $pkl = PKL::create($request->all());
        return PKLResource::make($pkl);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pkl = PKL::with(['siswa', 'industri', 'guru'])->find($id);
        return PKLResource::make($pkl);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PKLRequest $request, string $id)
    {
        $pkl = PKL::find($id);
        $pkl->update($request->all());
        return PKLResource::make($pkl);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PKL::destroy($id);
        return response()->json(['message'=>'Deleted'], 200);
    }
}
