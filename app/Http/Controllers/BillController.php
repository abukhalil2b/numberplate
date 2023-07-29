<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('bill.create');
    }


    public function store(Request $request)
    {
        $loggedUser = auth()->user();

        // return $request->all();

        Bill::create([
            'num_plate' => $request->num_plate,
            'zone_plate' => $request->zone_plate,
            'size_plate' => $request->size_plate,
            'price_printing' => $this->getPrintingPrice($request->size_plate),
            'quantity' => $request->quantity,
            'ref_num' => $request->ref_num,
            'success_printing' => $request->success_printing,
            'branch_id' => $loggedUser->id
        ]);

        return back();
    }


    public function getPrintingPrice($size_plate)
    {
        $price = 0;
        switch ($size_plate) {
            case 'خصوصي كبير':
                $price = 10;

            case 'خصوصي متوسط':
                $price = 9;

            case 'خصوصي صغير':
                $price = 8;

            case 'تجاري كبير':
                $price = 0;

            case 'تجاري متوسط':
                $price = 0;

            case 'حكومي كبير':
                $price = 0;

            case 'حكومي صغير':
                $price = 0;

            case 'حكومي دراجات':
                $price = 0;

            case 'دبلوماسي كبير':
                $price = 0;

            case 'دبلوماسي متوسط':
                $price = 0;

            case 'دبلوماسي دراجات':
                $price = 0;

            case 'تصدير':
                $price = 0;

            case 'تعليم سياقة متوسط':
                $price = 2;

            case 'تعليم سياقة دراجات':
                $price = 1;
            default:
                $price = 0;
        }

        return $price;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
