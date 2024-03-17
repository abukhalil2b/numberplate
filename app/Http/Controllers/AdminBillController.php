<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Item;
use App\Models\Statement;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBillController extends Controller
{

    public function show(Bill $bill)
    {
        $loggedUser = auth()->user();


        $plateItems = Item::where(['bill_id' => $bill->id, 'cate' => 'plate'])
            ->get();

        $extraItems = Item::where(['bill_id' => $bill->id, 'cate' => 'extra'])
            ->get();

        return view('admin.bill.show', compact('plateItems', 'extraItems', 'bill'));
    }

    public function plateIndex(Request $request, User $branch)
    {

        //show result based on this conditions
        $conditions = [];
        $condition = $request->condition ? $request->condition : 'sold';
        if ($request->condition == 'sold') {
            array_push($conditions, 'sold');
        }

        if ($request->condition == 'failed') {
            array_push($conditions, 'failed');
        }

        if ($request->condition == 'both') {
            array_push($conditions, ['sold', 'failed']);
        }

        //init message
        $search_range = '';
        $message = '';

        // return $request->all();

        $type = $request->type ? $request->type : 'private';

        $required = $request->required ? $request->required : 'single';

        $date_from = $request->date_from ? $request->date_from : date('Y-m-d');

        $date_to = $request->date_to ? $request->date_to : date('Y-m-d');

        if (in_array('sold', $conditions)) {
            //check range date is equal
            if ($date_from == $date_to) {

                $search_range = 'DATE:' . $date_from;

                if ($required == 'both') {

                    $bills = self::getSingleAndPair($branch->id, $date_from, $type);
                } else {
                    $bills = self::getAsRequired($branch->id, $date_from, $type, $required);
                }
            } else {

                $search_range = 'DATE FROM: ' . $date_from . ' TO:' . $date_to;
                if ($required == 'both') {
                    $bills = self::getSingleAndPairWithRangedDate($branch->id, $date_from, $date_to, $type);
                } else {
                    $bills = self::getAsRequiredWithRangedDate($branch->id, $date_from, $date_to, $type, $required);
                }
            }
        } else {
            $bills = [];
        }

        if (in_array('failed', $conditions)) {
            //failed print
            if ($date_from == $date_to) {
                $failedPrints = self::getFailedPrint($date_from);
            } else {
                $failedPrints = self::getFailedPrintWithRangedDate($date_from, $date_to);
            }
        } else {
            $failedPrints = [];
        }

        // return $failedPrints;
        // return $bills;

        $message = 'Plate Sold Count:' . count($bills) . '. ' . $search_range;

        $failedPrintCounts = 'Failed Print Counts:' . count($failedPrints) . '. ' . $search_range;

        return view('admin.bill.plate.index', compact('branch', 'bills', 'type', 'required', 'condition', 'date_from', 'date_to', 'message', 'failedPrints', 'failedPrintCounts'));
    }

    public function extraIndex(Request $request, User $branch)
    {

        //init message
        $message = '';

        $date_from = $request->date_from ? $request->date_from : date('Y-m-d');

        $date_to = $request->date_to ? $request->date_to : date('Y-m-d');

        if ($date_from == $date_to) {
            $search_range = 'DATE:' . $date_from;

            // grouped
            $groupedItems = Item::where('branch_id', $branch->id)
                ->where('cate', 'extra')
                ->whereDate('created_at', $date_from)
                ->select('description', DB::raw('SUM(price) as totalPrice'), DB::raw('COUNT(id) as quantity'))
                ->groupby('description')
                ->get();

            $items = Item::join('bills', 'items.bill_id', '=', 'bills.id')
                ->where('items.branch_id', $branch->id)
                ->where('items.cate', 'extra')
                ->whereDate('items.created_at', $date_from)
                ->select('items.issue_date', 'items.description', 'items.type', 'bills.plate_num','bills.plate_code', 'items.price', 'items.bill_id')
                ->get();
        } else {
            $search_range = 'DATE FROM: ' . $date_from . ' TO:' . $date_to;

            // grouped
            $groupedItems = Item::where('branch_id', $branch->id)
                ->where('cate', 'extra')
                ->whereBetween('created_at', [$date_from, $date_to])
                ->select('description', DB::raw('SUM(price) as totalPrice'), DB::raw('COUNT(id) as quantity'))
                ->groupby('description')
                ->get();

            $items = Item::join('bills', 'items.bill_id', '=', 'bills.id')
                ->where('items.branch_id', $branch->id)
                ->where('items.cate', 'extra')
                ->whereBetween('items.created_at', [$date_from, $date_to])
                ->select('items.issue_date', 'items.description', 'items.type', 'bills.plate_num','bills.plate_code', 'items.price', 'items.bill_id')
                ->get();
        }


        $message = 'Record Count:' . count($items) . '. ' . $search_range;

        return view('admin.bill.extra.index', compact('branch', 'items', 'groupedItems', 'date_from', 'date_to', 'message'));
    }


    public function delete(Bill $bill)
    {

        Stock::where('bill_id', $bill->id)->delete();

        Statement::where('bill_id', $bill->id)->delete();

        Item::where('bill_id', $bill->id)->delete();

        $bill->delete();

        return redirect()->route('admin.dashboard');
    }

    private static function getSingleAndPair($branch_id, $date_from, $type)
    {
        if ($type == 'all') {
            // single,pair and all types
            return Bill::where('branch_id', $branch_id)
                ->with('extraItems')
                ->whereDate('created_at', $date_from)
                ->latest('id')
                ->get();
        } else {
            // single,pair and specific type
            return Bill::where('branch_id', $branch_id)
                ->with('extraItems')
                ->where('type', $type)
                ->whereDate('created_at', $date_from)
                ->latest('id')
                ->get();
        }
    }

    private static function getSingleAndPairWithRangedDate($branch_id, $date_from, $date_to, $type)
    {
        if ($type == 'all') {
            // single,pair and all types
            return Bill::where('branch_id', $branch_id)
                ->with('extraItems')
                ->whereBetween('created_at', [$date_from, $date_to])
                ->latest('id')
                ->get();
        } else {
            // single,pair and specific type
            return Bill::where('branch_id', $branch_id)
                ->with('extraItems')
                ->where('type', $type)
                ->whereBetween('created_at', [$date_from, $date_to])
                ->latest('id')
                ->get();
        }
    }

    private static function getAsRequired($branch_id, $date_from, $type, $required)
    {
        //all types and specific required
        if ($type == 'all') {
            return Bill::where('branch_id', $branch_id)
                ->with('extraItems')
                ->whereRequired($required)
                ->whereDate('created_at', $date_from)
                ->latest('id')
                ->get();
        } else {
            //specific type and specific required
            return Bill::where('branch_id', $branch_id)
                ->with('extraItems')
                ->where('type', $type)
                ->whereRequired($required)
                ->whereDate('created_at', $date_from)
                ->latest('id')
                ->get();
        }
    }

    private static function getAsRequiredWithRangedDate($branch_id, $date_from, $date_to, $type, $required)
    {
        //all types and specific required
        if ($type == 'all') {
            return Bill::where('branch_id', $branch_id)
                ->with('extraItems')
                ->whereRequired($required)
                ->whereBetween('created_at', [$date_from, $date_to])
                ->latest('id')
                ->get();
        } else {
            //specific type and specific required
            return Bill::where('branch_id', $branch_id)
                ->with('extraItems')
                ->where('type', $type)
                ->whereRequired($required)
                ->whereBetween('created_at', [$date_from, $date_to])
                ->latest('id')
                ->get();
        }
    }

    private static function getFailedPrint($date_from)
    {
        return Item::select(
            'bills.id as bill_id',
            'bills.plate_num',
            'bills.plate_code',
            'bills.required',
            'bills.payment_method',
            'items.issue_date',
            'items.type',
            'items.quantity',
        )
            ->join('bills', 'items.bill_id', '=', 'bills.id')
            ->where([
                'items.cate' => 'plate',
                'items.status' => 'failed'
            ])
            ->whereDate('items.created_at', $date_from)
            ->get();
    }

    private static function getFailedPrintWithRangedDate($date_from, $date_to)
    {
        return Item::select(
            'bills.id as bill_id',
            'bills.plate_num',
            'bills.plate_code',
            'bills.required',
            'bills.payment_method',
            'items.issue_date',
            'items.type',
            'items.quantity',
        )
            ->join('bills', 'items.bill_id', '=', 'bills.id')
            ->where([
                'items.cate' => 'plate',
                'items.status' => 'failed'
            ])
            ->whereBetween('items.created_at', [$date_from, $date_to])
            ->get();
    }
}
