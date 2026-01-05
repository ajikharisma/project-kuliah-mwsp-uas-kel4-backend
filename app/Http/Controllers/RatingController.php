<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    // ================= GET Ratings untuk produk tertentu =================
    public function index($produk_id)
    {
        // Ambil rating untuk produk, urut dari terbaru
        $ratings = Rating::with('user')
            ->where('produk_id', $produk_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $ratings
        ]);
    }

    // ================= POST Rating Baru =================
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'produk_id' => 'required|exists:produk,id_produk', // <-- pastikan tabel produk sesuai di database
            'stars' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Buat rating baru
        $rating = Rating::create([
            'user_id' => $user->id,
            'produk_id' => $validated['produk_id'],
            'stars' => $validated['stars'],
            'comment' => $validated['comment'],
        ]);

        // Load relasi user agar nama user bisa tampil di API
        $rating->load('user');

        return response()->json($rating, 201);
    }
}
