<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    /**
     * Simpan data sumbangan dari borang di laman utama
     */
    public function store(Request $request)
    {
        // 1. Semak sama ada pengguna sudah log masuk
        // Kita perlu tahu SIAPA yang menderma untuk database
        $donor = null;

        if (Auth::guard('participant')->check()) {
            $donor = Auth::guard('participant')->user();
        } elseif (Auth::guard('committee')->check()) {
            $donor = Auth::guard('committee')->user();
        } else {
            // Jika belum login, kita tak boleh simpan sebab database perlukan 'donor_id'
            // Anda boleh ubah ini jika nak benarkan 'Guest' menderma (kena ubah database jadi nullable)
            return response()->json([
                'message' => 'Sila log masuk sebagai Ahli Kariah atau AJK untuk merekodkan sumbangan anda.'
            ], 401);
        }

        // 2. Validasi Input dari borang
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'transaction_id' => 'required|string|unique:donations,transaction_id',
            'type' => 'nullable|string',
        ]);

        // 3. Cipta Rekod Derma Baru
        try {
            $donation = new Donation([
                'amount' => $validated['amount'],
                'transaction_id' => $validated['transaction_id'],
                'type' => $validated['type'] ?? 'umum', // Default ke 'umum' jika kosong
                'status' => 'pending', // Default status
                'notes' => 'Sumbangan melalui laman web',
            ]);

            // 4. Simpan guna hubungan Polymorphic
            // Ini automatik isi 'donor_id' dan 'donor_type'
            $donor->donations()->save($donation);

            // 5. Hantar respon kejayaan ke JavaScript
            return response()->json([
                'success' => true,
                'message' => 'Terima kasih! Maklumat sumbangan telah berjaya direkodkan.',
                'data' => $donation
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ralat sistem: ' . $e->getMessage()
            ], 500);
        }
    }
}