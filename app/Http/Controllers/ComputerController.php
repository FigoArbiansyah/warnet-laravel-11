<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ComputerController extends Controller
{
    public function index()
    {
        $q = request()->query('q', null);

        $computers = DB::table('computers')
            ->when(isset($q) && !is_null($q), function ($query) use ($q) {
                $value = '%' . $q . '%';
                $query->where('computers.name', 'like', $value);
            })
            ->paginate(10);

        return view('pages.computer.index', compact(
            'computers',
        ));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|string|min:3",
            "status" => ["required", Rule::in(['available', 'in_use', 'maintenance'])],
        ], [
            "name.required" => "Nama komputer harus diisi!",
            "name.min" => "Minimal 3 karakter!",
            "status.required" => "Status harus diisi!",
        ]);

        DB::beginTransaction();
        try {
            Computer::create($validatedData);

            DB::commit();
            return redirect('/computers')->with('success', 'Berhasil menambahkan data');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect('/computers')->with('errors', 'Gagal menambahkan data');
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "name_update" => "required|string|min:3",
            "status_update" => ["required", Rule::in(['available', 'in_use', 'maintenance'])],
        ], [
            "name_update.required" => "Nama komputer harus diisi!",
            "name_update.min" => "Minimal 3 karakter!",
            "status_update.required" => "Status harus diisi!",
        ]);

        $validatedData = [
            "name" => $request->input('name_update'),
            "status" => $request->input('status_update'),
        ];

        DB::beginTransaction();
        try {
            Computer::findOrFail($id)->update($validatedData);

            DB::commit();
            return redirect('/computers')->with('success', 'Berhasil mengubah data');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect('/computers')->with('errors', 'Gagal mengubah data');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            "status" => ["required", Rule::in(['available', 'in_use', 'maintenance'])],
        ], [
            "status.required" => "Status harus diisi!",
        ]);

        DB::beginTransaction();
        try {
            Computer::findOrFail($id)->update($validatedData);

            DB::commit();
            return redirect('/computers')->with('success', 'Berhasil mengubah status');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect('/computers')->with('errors', 'Gagal mengubah status');
        }
    }
}
