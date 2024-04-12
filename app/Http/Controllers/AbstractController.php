<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbstractModel;
use App\Models\PurchaseRequestModel;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AbstractController extends Controller
{
    const STATUS_DRAFT      = 1;
    const STATUS_RECEIVED   = 2;
    const STATUS_COMPLETED  = 3;
    const STATUS_RETURNED   = 4;

    public function generateAbstractNo($cur_year = 2024)
    {
        return response()->json(
            AbstractModel::select(AbstractModel::raw('COUNT(*)+1 as "abstract" '))
                ->whereYear('date_created', $cur_year)
                ->get()
        );
    }

    public function fetch_created_abstract(Request $req)
    {

        $id = $req->input('id');
        return response()->json(
            AbstractModel::select(
                AbstractModel::raw('
            tbl_abstract.abstract_no,
            p.pr_no,
            pmo.pmo_title as `office`,
            r.rfq_no as rfq_no
        ')
            )
                ->leftJoin('tbl_rfq as r', 'r.id', '=', 'tbl_abstract.rfq_id')
                ->leftJoin('pr as p', 'p.id', '=', 'tbl_abstract.pr_id')
                ->leftJoin('tbl_status as ss', 'ss.id', '=', 'p.stat')
                ->leftJoin('supplier as s', 's.id', '=', 'tbl_abstract.supplier_id')
                ->leftJoin('pmo', 'pmo.id', '=', 'p.pmo')
                ->leftJoin('pr_items', 'pr_items.pr_id', '=', 'p.id')
                ->leftJoin('tbl_app as app', 'app.id', '=', 'pr_items.pr_item_id')
                ->where('tbl_abstract.id', $id)
                ->groupBy('tbl_abstract.abstract_no', 'p.pr_no', 'pmo.pmo_title', 'r.rfq_no')
                ->get()
        );
    }

    public function load_abstract_data(Request $request)
    {
        $page = $request->query('page');
        $itemsPerPage = $request->query('itemsPerPage', 500);
        $query = AbstractModel::select(AbstractModel::raw('
        tbl_abstract.id AS `id`,
        MAX(r.id) AS `rfq_id`,
        MAX(r.rfq_no) AS `rfq_no`,
        MAX(p.pr_no) AS `pr_no`,
        MAX(po.po_no) AS `po_no`,
        MAX(s.supplier_title) AS `supplier_title`,
        MAX(tbl_abstract.abstract_no) AS `abstract_no`,
        MAX(tbl_abstract.date_created) AS `abstract_date`,
        MAX(ss.title) AS `status`,
        MAX(po.po_amount) AS `po_amount`,
        MAX(pmo.pmo_title) as `office`

       
        '))
            ->leftJoin('tbl_rfq as r', 'r.id', '=', 'tbl_abstract.rfq_id')
            ->leftJoin('pr as p', 'p.id', '=', 'r.pr_id')
            ->leftJoin('tbl_status as ss', 'ss.id', '=', 'p.stat')
            ->leftJoin('supplier as s', 's.id', '=', 'tbl_abstract.supplier_id')
            ->leftJoin('pmo', 'pmo.id', '=', 'p.pmo')
            ->leftJoin('pr_items', 'pr_items.pr_id', '=', 'p.id')
            ->leftJoin('tbl_app as app', 'app.id', '=', 'pr_items.pr_item_id')
            ->leftJoin('tbl_purchase_order as po', 'po.rfq_id', '=', 'r.id')
            ->orderBy('tbl_abstract.id', 'desc')
            ->groupBy('tbl_abstract.id');


        $prData = $query->paginate($itemsPerPage, ['*'], 'page', $page);

        // Dump and die to output the SQL for debugging
        // dd($prData);
        return response()->json($prData);
    }

    public function post_create_abstract(Request $req)
    {
        $abstract = new AbstractModel([
            'abstract_no' => $req->input('abstract_no'),
            'pr_id'       => $req->input('pr_id'),
            'rfq_id'      => $req->input('rfq_id'),
            'date_created'  => $req->input('date_created'),

        ]);

        $abstract->save();
        return response()->json(['message' => 'Data saved successfully']);
    }
}
