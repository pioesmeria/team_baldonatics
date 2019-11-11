<?php

namespace App\Http\Controllers;

use App\Exceptions\UsgsServiceException;
use App\Http\Repositories\IndexRepository;
use App\Services\UsgsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * @var IndexRepository
     */
    private $indexRepo;

    public function __construct(IndexRepository $indexRepository)
    {
        $this->indexRepo = $indexRepository;
    }

    /**
     * @param Request $request
     * @return Factory|JsonResponse|View
     */
    public function index(Request $request)
    {
        try {
            $response = (new UsgsService)->fetchData();
            $parsed = json_decode($response, true);
            $collection = collect($parsed['features']);

            $paged = $this->indexRepo->paginate(
                $collection,
                $request->input('page', 1),
                $request->input('per_page', 25)
            );

            $result = $this->indexRepo->parseTimestamp($paged);

            return view('welcome', compact('result'));
        } catch (UsgsServiceException $e) {
            return view('errors.500', ['message' => trans('errors.usgs')]);
        } catch (\Exception $e) {
            return view('errors.400', ['code' => '400']);
        }
    }
}
