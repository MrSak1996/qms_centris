<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RFQModel;
use App\Models\PurchaseRequestModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

const SUBMITTED_TO_GSS = 4;
const RECEIVED_BY_GSS = 5;
const WITH_RFQ = 6;
const AWARDED = 7;
const WITH_PO = 8;
class RFQController extends Controller
{
    public function generateRFQNo($cur_year = 2024)
    {
        return response()->json(
            RFQModel::select(RFQModel::raw('COUNT(*)+1 as "rfq_count" '))
                ->whereYear('rfq_date', $cur_year)
                ->get()
        );
    }
    public function fetchSubmittedPurchaseRequest()
    {
        return response()->json(
            PurchaseRequestModel::select(PurchaseRequestModel::raw('id,pr_no'))
                ->where('stat', SUBMITTED_TO_GSS)
                ->get()
        );
    }
    public function fetch_rfq()
    {
        return response()->json(
            RFQModel::select(RFQModel::raw('tbl_rfq.id,tbl_rfq.rfq_no'))
                ->leftJoin('pr', 'pr.id', '=', 'tbl_rfq.pr_id')
                ->where('pr.stat',WITH_RFQ)
                ->get()
        );
    }
    public function post_create_rfq(Request $request)
    {
        $rfq = new RFQModel([
            'id'            => null,
            'rfq_no'         => $request->input('rfq_no'),
            'pr_id'          => $request->input('pr_id'),
            'mode_id' => $request->input('mode_id'),
            'rfq_date'  => $request->input('rfq_date'),
            'particulars'    =>  $request->input('particulars'),
            'updated_by'    =>  $request->input('updated_by'),

        ]);



    
    
        // Save the RFQ record
        $rfq->save();
        // dd($rfq);
    
        // Optionally, you can return a response indicating success along with the SQL query
        return response()->json(['message' => 'RFQ created successfully', 'sql_query' => $rfq], 201);
    }
    
}
