<?php

namespace App;

use Illuminate\Support\Facades\DB;

class DataTableHelper {
    
    public static function dataTableGenerate($request, $options) {
        ## Read value
        $draw       = $request -> get('draw');
        $start      = $request -> get("start");
        $rowperpage = $request -> get("length"); // Rows display per page

        $columnIndex_arr = $request -> get('order');
        $columnName_arr  = $request -> get('columns');
        $order_arr       = $request -> get('order');
        $search_arr      = $request -> get('search');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue     = $search_arr['value']; // Search value

        // Total records
        $totalRecords = DB::table($options['table'])
            -> select('count(*) as allcount')
            -> count();

        $totalRecordswithFilter = DB::table($options['table'])
            -> select('count(*) as allcount')
            -> where($options['filterLike'], 'like', '%' .$searchValue . '%')
            -> count();

        // Fetch records
        $records = DB::table($options['table'])
            -> orderBy($columnName, $columnSortOrder)
            -> where($options['filterLike'], 'like', '%' .$searchValue . '%')
            -> skip($start)
            -> take($rowperpage);
            

        // $data_arr = $records -> toArray();

        
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            // "aaData" => $data_arr,
            "records" => $records
        );

        return $response;
    }
}
