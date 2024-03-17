<?php

namespace App\Http\Controllers;

use App\Models\Item;

class AdminItemController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function delete(Item $item)
    {

        Item::where([
            'id' => $item->id,
        ])->delete();

        return back();
    }


}
