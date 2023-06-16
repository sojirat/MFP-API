<?php

use Carbon\Carbon;

/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('convertDmyToYmd')) {
    function convertDmyToYmd($date)
    {
        return Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
    }
}

/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('convertYdmToMdy')) {
    function convertYdmToMdy($date)
    {
        return Carbon::createFromFormat('Y-d-m', $date)->format('m-d-Y');
    }
}

/**
 * Calculate pagination manually for a database query.
 *
 * @param int $page Current page number
 * @param int $perpage Number of items per page
 * @param \Illuminate\Database\Query\Builder $query Query builder instance
 *
 * @return \Illuminate\Database\Query\Builder $query Updated query builder instance
 */
if (!function_exists('perpage')) {
    function perpage($page, $perpage, $query)
    {
        $skip = ($page * $perpage) - $perpage;
        if (!empty($page) && !empty($perpage)) {
            return $query->offset($skip)->limit($perpage);
        }
    }
}

if (!function_exists('res')) {
    function res($msg = 'Successfully', $status = true, $http_status = 200)
    {
        return response()->json([
            'status'    => $status,
            'message'   => $msg,
        ], $http_status);
    }
}

if (!function_exists('res_data')) {
    function res_data($data = [], $msg = 'Successfully', $status = true, $http_status = 200)
    {
        return response()->json([
            'status'    => $status,
            'message'   => $msg,
            'data'      => $data
        ], $http_status);
    }
}
