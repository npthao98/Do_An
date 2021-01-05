<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getDistrictByCity($city)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://localhost:5000/districts', [
            'query' => ['province' => $city]
        ]);
        $response = $request->getBody();
        $districts = json_decode($response)->data;
        return $districts;
    }
}
