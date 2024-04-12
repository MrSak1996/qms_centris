<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RFQModel;
use App\Models\AppItemModel;
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

    public function viewRFQItems($id, Request $request)
    {

        $query = AppItemModel::select(AppItemModel::raw('
        tbl_app.id as `app_id`,
        tbl_app.sn as `serial_no`,
        tbl_app.item_title as `procurement`,
        tbl_app.app_price as `app_price`,
        unit.item_unit_title as `unit`,
        pr_items.description as `description`,
        pr_items.qty as `quantity`,
        pr_items.qty * tbl_app.app_price as `total`,
        pr.pr_no as `pr_no`,
        pmo.pmo_title as `office`,
        pmo.pmo_contact_person as  `signatory`,
        pmo.designation as  `designation`,
        pr.type as `type`,
        pr.pr_date as `pr_date`,
        pr.target_date as `target_date`,
        pr.purpose as `particulars`,
        pr.current_step as `step`,
        tbl_status.title as `status`
        '))
            ->leftJoin('pr_items', 'pr_items.pr_item_id', '=', 'tbl_app.id')
            ->leftJoin('item_unit as unit', 'unit.id', '=', 'tbl_app.unit_id')
            ->leftJoin('pr', 'pr.id', '=', 'pr_items.pr_id')
            ->leftJoin('pmo', 'pmo.id', '=', 'pr.pmo')
            ->leftJoin('tbl_status', 'pr.stat', '=', 'tbl_status.id')
            ->leftJoin('tbl_rfq','tbl_rfq.pr_id', '=','pr.id')
            ->where('tbl_rfq.id', $id);

        // Print the SQL query to check
        // dd($query->toSql());

        // Execute the query and return the result
        $app_item = $query->get();

        if ($request->has('export')) {
            // Export the data to Excel
            return $this->exportToExcel($app_item);
        }

        return response()->json($app_item);
    }

    
}
