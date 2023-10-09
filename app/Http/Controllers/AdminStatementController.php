<?php

namespace App\Http\Controllers;

use App\Models\Statement;
use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminStatementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, User $branch)
    {

        //TODO after one year table need to be archive 
        $months = Bill::selectRaw('DISTINCT month(created_at) as month')
            ->latest('id')
            ->pluck('month');

        $thisMonth = $request->month ? $request->month : $months[0];

         $statements = Statement::where('branch_id', $branch->id)
            ->whereMonth('created_at', $thisMonth)
            ->select('type', 'size', 'required', DB::raw('COUNT(`id`) as total'))
            ->groupby('type', 'size', 'required')
            ->get();

        return view('admin.statement.index', compact('statements', 'branch','thisMonth','months'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Statement $statement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Statement $statement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Statement $statement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Statement $statement)
    {
        //
    }
}
