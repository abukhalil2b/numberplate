<?php

namespace App\Http\Controllers;

use App\Models\Mainstock;
use Illuminate\Http\Request;

class AdminMainstockController extends Controller
{
    /**
     * admin/mainstock/index
     */
    public function index()
    {
        $mainstocks = Mainstock::all();

        return view('admin.mainstock.index', compact('mainstocks'));
    }

    public function store(Request $request)
    {

        // $data = $request->validate(['name' => 'required']);

        // Mainstock::create($data);

        return back();
    }

    public function edit(Mainstock $mainstock)
    {
        return view('admin.mainstock.edit', compact('mainstock'));
    }


    public function update(Request $request, Mainstock $mainstock)
    {
        $data = $request->validate(['name' => 'required']);

        $mainstock->update($data);

        return redirect()->route('admin.mainstock.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mainstock $mainstock)
    {
        //
    }
}
