<?php

namespace App\Http\Controllers;

use App\Models\RFQModel;
use Illuminate\Http\Request;
use App\Models\SupplierModel;
use App\Models\SupplierQuotationModel;
use App\Models\AbstractModel;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class SupplierController extends Controller
{
    public function fetch_supplier()
    {
        return response()->json(
            SupplierModel::select(SupplierModel::raw('supplier.id,supplier.supplier_title'))
                ->get()
        );
    }
    public function fetch_app_item(Request $req)
    {
        $id = $req->input('id');
        $query = RFQModel::select('a.item_title', 'a.app_price', 'pi.qty', 'pi.pr_item_id')
            ->leftJoin('pr as p', 'p.id', '=', 'tbl_rfq.pr_id')
            ->leftJoin('pr_items as pi', 'pi.pr_id', '=', 'p.id')
            ->leftJoin('tbl_app as a', 'a.id', '=', 'pi.pr_item_id')
            ->where('tbl_rfq.id', '=', $id)
            ->get();
        // dd($query->toSql());

        return response()->json($query);
    }
    public function fetch_app_item_details(Request $req)
    {
        $id = $req->input('id');
        $query = RFQModel::select(RFQModel::raw(
            '
            MAX(p.id) as `id`,
            MAX(p.pr_no) as `pr_no`,
            MAX(p.pr_date) as `pr_date`,
            MAX(p.purpose) as `particulars`,
            MAX(tbl_rfq.rfq_date) as `rfq_date`,
            MAX(pmo.pmo_title) as `pmo_title`,
            MAX(a.item_title) as `item_title`,
            MAX(a.app_price) as `app_price`,
            MAX(pi.qty) as `qty`,
            MAX(pi.pr_item_id) as `pr_item_id`,
            SUM(a.app_price * pi.qty) as `total_abc`'
        ))
            ->leftJoin('pr as p', 'p.id', '=', 'tbl_rfq.pr_id')
            ->leftJoin('pr_items as pi', 'pi.pr_id', '=', 'p.id')
            ->leftJoin('tbl_app as a', 'a.id', '=', 'pi.pr_item_id')
            ->leftJoin('pmo', 'pmo.id', '=', 'p.pmo')
            ->where('tbl_rfq.id', '=', $id)
            ->get();

        // dd($query->toSql());

        return response()->json($query);
    }
    public function fetch_supplier_title(Request $req)
    {
        $id = $req->input('id');
        $query = SupplierQuotationModel::select('s.supplier_title')
            ->leftJoin('supplier as s', 's.id', '=', 'tbl_supplier_quotation.supplier_id')
            ->leftJoin('tbl_rfq as r', 'r.id', '=', 'tbl_supplier_quotation.rfq_id')
            ->leftJoin('tbl_app as a', 'a.id', '=', 'tbl_supplier_quotation.item_id')
            ->where('r.id', '=', $id)
            ->groupBy('tbl_supplier_quotation.supplier_id', 's.supplier_title')
            ->get();
        // dd($query->toSql());

        return response()->json($query);
    }
    public function fetch_supplier_quotation(Request $req)
    {
        $id = $req->input('id');
        $query = SupplierQuotationModel::select('s.supplier_title', 'a.item_title', 'a.app_price', 'tbl_supplier_quotation.quotation')
            ->leftJoin('supplier as s', 's.id', '=', 'tbl_supplier_quotation.supplier_id')
            ->leftJoin('tbl_rfq as r', 'r.id', '=', 'tbl_supplier_quotation.rfq_id')
            ->leftJoin('tbl_app as a', 'a.id', '=', 'tbl_supplier_quotation.item_id')
            ->where('r.id', '=', $id)

            ->get();
        // dd($query->toSql());

        return response()->json($query);
    }
    public function post_supplier_quote(Request $req)
    {
        $dataToSave = $req->all();

        // Process and save the data
        foreach ($dataToSave as $item) {
            // Create a new instance of SupplierQuotation model
            $supplierQuotation = new SupplierQuotationModel();

            // Assign values to model properties
            $supplierQuotation->supplier_id = $item['supplier_id'];
            $supplierQuotation->rfq_id      = $item['rfq_id'];
            $supplierQuotation->item_id     = $item['item_id'];
            $supplierQuotation->quotation   = $item['quotation'];

            // Save the model to the database
            $supplierQuotation->save();
        }

        // Respond with success message or other response
        return response()->json(['message' => 'Data saved successfully']);
    }
  
}
