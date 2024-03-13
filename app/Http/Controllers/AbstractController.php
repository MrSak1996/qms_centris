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
    public function load_abstract_data(Request $request)
    {
        $page = $request->query('page');
        $itemsPerPage = $request->query('itemsPerPage', 500);
        $query = AbstractModel::select(AbstractModel::raw('
        tbl_abstract.id AS `id`,
        MAX(r.rfq_no) AS `rfq_no`,
        MAX(p.pr_no) AS `pr_no`,
        MAX(ss.title) AS `status`,
        SUM(app.app_price * pr_items.qty) AS `app_price`,
        MAX(pmo.pmo_title) as `office`

       
        '))
            ->leftJoin('tbl_rfq as r', 'r.id', '=', 'tbl_abstract.rfq_id')
            ->leftJoin('pr as p', 'p.id', '=', 'tbl_abstract.pr_id')
            ->leftJoin('tbl_status as ss', 'ss.id', '=', 'p.stat')
            ->leftJoin('supplier as s', 's.id', '=', 'tbl_abstract.supplier_id')
            ->leftJoin('pmo', 'pmo.id', '=', 'tbl_abstract.office_id')
            ->leftJoin('pr_items', 'pr_items.pr_id', '=', 'p.id')
            ->leftJoin('tbl_app as app', 'app.id', '=', 'pr_items.pr_item_id')
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
