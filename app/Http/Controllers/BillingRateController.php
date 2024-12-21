<?php

namespace App\Http\Controllers;

use App\Models\BillingRate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BillingRateController extends Controller
{
    public function index()
    {
        $price = BillingRate::orderBy('id', 'desc')->limit(1)->first();

        return view('pages.billing-rate.index', compact('price'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "rate" => "numeric|required",
        ], [
            "rate.numeric" => "Harga tidak valid!",
            "rate.required" => "Harga harus diisi!",
        ]);

        DB::beginTransaction();
        try {
            BillingRate::findOrFail($id)->update($validatedData);

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mengubah harga sewa per jam');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->back()->with('errors', 'Gagal mengubah harga');
        }
    }
}
