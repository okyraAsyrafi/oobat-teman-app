<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PatientAuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    // Inject Service tadi ke sini
    public function __construct(PatientAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        // 1. Validasi Input Dasar
        $request->validate([
            'nik' => 'required|numeric',
            'date_of_birth' => 'required|date_format:Y-m-d', // Format harus YYYY-MM-DD
        ]);

        // 2. Panggil Service untuk Logic Login
        try {
            $data = $this->authService->login(
                $request->nik,
                $request->date_of_birth
            );

            // 3. Return JSON Sukses
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Login berhasil'
                ],
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            // 4. Return JSON Error
            return response()->json([
                'meta' => [
                    'code' => 401,
                    'status' => 'error',
                    'message' => $e->getMessage()
                ],
                'data' => null
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        // Hapus token saat ini
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Token berhasil dihapus'
            ],
            'data' => null
        ]);
    }
}
