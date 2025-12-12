<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TelenursingResource;
use App\Models\WhatsappContact; // Pastikan Model sudah ada
use Illuminate\Http\Request;

class TelenursingController extends Controller
{
    public function index()
    {
        // Ambil kontak yang aktif, urutkan berdasarkan order_index
        $contacts = WhatsappContact::where('is_active', 1)
            ->orderBy('order_index', 'asc')
            ->get();

        return response()->json([
            'meta' => ['code' => 200, 'status' => 'success'],
            'data' => TelenursingResource::collection($contacts),
        ]);
    }
}
