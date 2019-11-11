<?php

namespace App\Http\Repositories;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class IndexRepository
{
    /**
     * @param Collection $collection
     * @param int $page
     * @param int $perPage
     * @return Collection
     */
    public function paginate(Collection $collection, $page = 1, $perPage = 25): Collection
    {
        return $collection->forPage($page, $perPage);
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public function parseTimestamp(Collection $collection): Collection
    {
        return $collection->map(function ($item) {
            $item['properties']['time'] = Carbon::createFromTimestampMs($item['properties']['time'], 'Asia/Manila')
                ->format('F j Y h:i A');
            return $item;
        });
    }
}
