<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseRequestModel;
use App\Models\PurchaseRequestItemModel;
use App\Models\AppItemModel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseRequestController extends Controller
{
    public function generatePurchaseRequestNo($cur_year = 2024)
    {

        return response()->json(
            PurchaseRequestModel::select(PurchaseRequestModel::raw('COUNT(*)+1 as "pr_count" '))
                ->whereYear('date_added', $cur_year)
                ->get()
        );
    }
    public function post_insert_purchaseNo(Request $request)
    {
        $pr_opts = new PurchaseRequestModel([
            'id'    => null,
            'pr_no' => $request->input('pr_no'),
            'stat'  => $request->input('status'),
            'updated_at' => null,
            'created_at' => null

        ]);
        $pr_opts->save();
    }
    public function post_update_purchaseRequestDetails(Request $request)
    {
        // Assuming your model is named PurchaseRequestModel
        $purchaseRequest = PurchaseRequestModel::where('pr_no', $request->input('pr_no'))->first();

        // Check if the record with the specified pr_no exists
        if ($purchaseRequest) {
            // Update the fields
            $purchaseRequest->pmo = $request->input('pmo');
            $purchaseRequest->type = $request->input('type');
            $purchaseRequest->pr_date = $request->input('pr_date');
            $purchaseRequest->target_date = $request->input('target_date');
            $purchaseRequest->purpose = $request->input('purpose');

            // Save the changes
            $purchaseRequest->save();

            // You can return a response, if needed
            return response()->json(['message' => 'Purchase request details updated successfully']);
        } else {
            // Handle the case where the record with the specified pr_no doesn't exist
            return response()->json(['error' => 'Purchase request not found'], 404);
        }
    }
    public function getPurchaseRequestDetails(Request $request)
    {
        $pr_no = $request->input('pr_no');

        // Fetch purchase request details based on pr_no
        $purchaseRequest = PurchaseRequestModel::where('pr_no', $pr_no)->first();

        // Check if the purchase request was found
        if ($purchaseRequest) {
            // Return the details as JSON response
            return response()->json([
                'id'        => $purchaseRequest->id,
                'pmo'         => $purchaseRequest->pmo,
                'type'     => $purchaseRequest->type,
                'pr_date'     => $purchaseRequest->pr_date,
                'target_date' => $purchaseRequest->target_date,
                'purpose'     => $purchaseRequest->purpose,
            ]);
        } else {
            // Return an error response if the purchase request was not found
            return response()->json(['error' => 'Purchase request not found'], 404);
        }
    }
    public function post_insert_pritem(Request $request)
    {
        $pr_id = $request->input('id');
        $pr_no = $request->input('pr_no');
        $itemIds = $request->input('itemIds');
        $status = $request->input('status');
        $pr_opts = new PurchaseRequestItemModel([
            'id'    => null,
            'pr_id' => $pr_id,
            'pr_no' => $pr_no,
            'pr_item_id' => $itemIds,
            'description' => null,
            'unit' => null,
            'qty' => null,
            'abc' => null,
            'date_added' => null,
            'flag' => null,

        ]);
        $pr_opts->save();

        // You can return a response if needed
        return response()->json(['message' => 'Items added to the database']);
    }
    public function post_remove_pritem(Request $request)
    {
        $itemIds = $request->input('itemIds');

        // Ensure $itemIds is an array
        if (!is_array($itemIds)) {
            $itemIds = [$itemIds];
        }

        // Assuming PurchaseRequestItemModel is the model for your database table
        // Adjust the model and table name accordingly
        PurchaseRequestItemModel::whereIn('pr_item_id', $itemIds)->delete();

        // You can return a response if needed
        return response()->json(['message' => 'Items removed from the database']);
    }
    public function fetchCart(Request $request)
    {
        $pr_id = $request->input('id');

        // If 'id' is not found in the request input, try to get it from the request body
        if ($pr_id === null) {
            $pr_id = $request->json('id');
        }
        $query = AppItemModel::select(AppItemModel::raw('
        tbl_app.id as `app_id`,
        tbl_app.pr_no as `pr_no`,
        tbl_app.sn as `serial_no`,
        tbl_app.item_title as `procurement`,
        unit.item_unit_title as `unit`,
        pr_items.description as `description`,
        tbl_app.app_price as `app_price`
        '))
            ->leftJoin('pr_items', 'pr_items.pr_item_id', '=', 'tbl_app.id')
            ->leftJoin('item_unit as unit', 'unit.id', '=', 'tbl_app.unit_id')
            ->leftJoin('pr', 'pr.id', '=', 'pr_items.pr_id')
            ->where('pr.id', $pr_id);
        // Print the SQL query to check
        // dd($query->toSql());

        // Execute the query and return the result
        $app_item = $query->get();

        return response()->json($app_item);
    }
    public function fetchPurchaseReqData(Request $request)
    {
        $page = $request->query('page');
        $itemsPerPage = $request->query('itemsPerPage', 500);

        $query = PurchaseRequestModel::select(PurchaseRequestModel::raw('
        pr.id AS `id`,
        MAX(pr.pr_no) AS `pr_no`,
        MAX(pmo.pmo_title) AS `office`,
        MAX(pr.submitted_by) AS `submitted_by`,
        MAX(pr.purpose) AS `particulars`,
        MAX(pr.pr_date) AS `pr_date`,
        MAX(pr.target_date) AS `target_date`,
        MAX(pr.is_urgent) AS `is_urgent`,
        MAX(pr_items.qty) AS `quantity`,
        MAX(pr_items.description) AS `desc`,
        MAX(mode.mode_of_proc_title) AS `type`,
        MAX(app.sn) AS `serial_no`,
        MAX(app.item_title) AS `item_title`,
        MAX(unit.item_unit_title) AS `unit`,
        MAX(status.title) AS `status`,
        SUM(app.app_price) AS `app_price`
        '))
            ->leftJoin('pmo', 'pmo.id', '=', 'pr.pmo')
            ->leftJoin('mode_of_proc as mode', 'mode.id', '=', 'pr.type')
            ->leftJoin('pr_items', 'pr_items.pr_id', '=', 'pr.id')
            ->leftJoin('item_unit as unit', 'unit.id', '=', 'pr_items.unit')
            ->leftJoin('tbl_app as app', 'app.id', '=', 'pr_items.pr_item_id')
            ->leftJoin('tbl_status as status', 'status.id', '=', 'pr.stat')
            ->groupBy('pr.id');

        $prData = $query->paginate($itemsPerPage, ['*'], 'page', $page);

        // Dump and die to output the SQL for debugging
        // dd($prData);
        return response()->json($prData);
    }

    public function viewPurchaseRequest($id)
    {

        $query = AppItemModel::select(AppItemModel::raw('
        tbl_app.id as `app_id`,
        tbl_app.sn as `serial_no`,
        tbl_app.item_title as `procurement`,
        unit.item_unit_title as `unit`,
        pr_items.description as `description`,
        tbl_app.app_price as `app_price`
        '))
            ->leftJoin('pr_items', 'pr_items.pr_item_id', '=', 'tbl_app.id')
            ->leftJoin('item_unit as unit', 'unit.id', '=', 'tbl_app.unit_id')
            ->leftJoin('pr', 'pr.id', '=', 'pr_items.pr_id')
            ->where('pr.id', $id);
        // Print the SQL query to check
        // dd($query->toSql());

        // Execute the query and return the result
        $app_item = $query->get();

        return response()->json($app_item);
    }
}
