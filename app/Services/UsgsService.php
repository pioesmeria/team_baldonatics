<?php

namespace App\Services;

use App\Exceptions\UsgsServiceException;
use Exception;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class UsgsService
{
    public function __construct()
    {
        $this->http = new Client();
        $this->url  = config('usgs.base_url');
    }

    /**
     * @param string $format
     * @param string $latitude
     * @param string $longitude
     * @param string $maxRadius
     * @return ResponseInterface
     * @throws UsgsServiceException
     */
    public function fetchData(
        $format = 'geojson',
        $latitude = '12',
        $longitude = '122',
        $maxRadius = '1200'
    )
    {
        $params = [ 'query' => ['format' => $format,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'maxradiuskm' => $maxRadius]
        ];
        try {
            $response = $this->http->get($this->url, $params);
            $body = $response->getBody();
            return $body;
        } catch (Exception $e) {
            throw new UsgsServiceException($e);
        }
    }
}
