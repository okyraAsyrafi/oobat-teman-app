<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;

class PatientController extends Controller
{
    public function me(Request $request)
    {
        // $request->user() otomatis mengambil data pasien dari Token yang dikirim Flutter
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data pasien berhasil diambil'
            ],
            'data' => new PatientResource($request->user())
        ]);
    }
}
