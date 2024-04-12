<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\AbstractModel;
use App\Models\RFQModel;
use App\Models\PurchaseOrderModel;
use App\Models\SupplierQuotationModel;
use App\Models\PurchaseRequestModel;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;


const SUBMITTED_TO_GSS = 4;
const RECEIVED_BY_GSS = 5;
const WITH_RFQ = 6;
const AWARDED = 7;
const WITH_PO = 8;

class PurchaseOrderController extends Controller
{
    public function generatePurchaseOrderNo($cur_year = null)
    {
        if ($cur_year === null) {
            $cur_year = date('Y');
        }

        return response()->json(
            PurchaseOrderModel::select(DB::raw('COUNT(*)+1 as po_number'))
                ->whereYear('created_at', $cur_year)
                ->get()
        );
    }

    public function fetchPurchaseRequestData(Request $req)
    {
        $id = $req->input('id');


        $result = SupplierQuotationModel::select(
            DB::raw('MAX(r.rfq_no) as rfq_no'),
            DB::raw('MAX(r.id) as rfq_id'),
            DB::raw('MAX(p.id) as pr_id'),
            DB::raw('MAX(a.abstract_no) as abstract_no'),
            DB::raw('MAX(s.id) as supplier_id'),
            DB::raw('MAX(s.supplier_title) as supplier_title'),
            DB::raw('MAX(pmo.pmo_title) as pmo_title'),
            DB::raw('SUM(tbl_supplier_quotation.quotation) as total_quotation')
        )
            ->leftJoin('tbl_abstract as a', 'a.rfq_id', '=', 'tbl_supplier_quotation.rfq_id')
            ->leftJoin('tbl_rfq as r', 'r.id', '=', 'a.rfq_id')
            ->leftJoin('supplier as s', 's.id', '=', 'tbl_supplier_quotation.supplier_id')
            ->leftJoin('pr as p', 'p.id', '=', 'r.pr_id')
            ->leftJoin('pmo', 'pmo.id', '=', 'p.pmo')
            ->where('tbl_supplier_quotation.winner', 1)
            ->where('tbl_supplier_quotation.rfq_id', $id)
            ->groupBy('tbl_supplier_quotation.supplier_id')
            ->get();

        return response()->json($result);
    }

    public function post_create_po(Request $req)
    {
        $po_opts = new PurchaseOrderModel([
            'po_no' => $req->input('po_no'),
            'supplier_id' => $req->input('supplier_id'),
            'rfq_id' => $req->input('rfq_id'),
            'pr_id' => $req->input('pr_id'),
            'rfq_no' => $req->input('rfq_no'),
            'po_date' => $req->input('po_date'),
            'noa_date' => $req->input('noa_date'),
            'ntp_date' => $req->input('ntp_date'),
            'po_amount' => $req->input('purchase_amount'),
        ]);



        PurchaseRequestModel::where('id', $req->input('pr_id'))
            ->update([
                'stat' => WITH_PO,
                'id' => $req->input('pr_id'),
            ]);

        $po_opts->save();

        return response()->json(['message' => 'Data saved successfully']);
    }

    public function fetch_winner_supplier(Request $req)
    {
        $id = $req->input('id');

        $result = SupplierQuotationModel::select('s.supplier_title')
        ->leftJoin('supplier as s', 's.id', '=', 'tbl_supplier_quotation.supplier_id')
        ->where('tbl_supplier_quotation.winner', 1)
        ->where('tbl_supplier_quotation.rfq_id', $id)
        ->get();

        return response()->json($result);
    }
}
