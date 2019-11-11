<?php

namespace App\Http\Controllers;

use App\Exceptions\UsgsServiceException;
use App\Services\UsgsService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        try {
            $response = (new UsgsService)->fetchData();
            $parsed = json_decode($response, true);
            $result = collect($parsed['features']);
            $paged = $result->forPage(
                $request->input('page', 1),
                $request->input('per_page', 25)
            );
            return $paged;
        } catch (UsgsServiceException $e) {
            return response()->json(trans('errors.usgs'));
        }
    }
}
