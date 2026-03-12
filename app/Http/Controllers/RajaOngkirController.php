<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    private $apiKey;
    private $baseUrl = 'https://api.rajaongkir.com/starter';

    public function __construct()
    {
        $this->apiKey = env('RAJAONGKIR_API_KEY');
    }

    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get($this->baseUrl . '/province');

        return response()->json($response->json());
    }

    public function getCities($province_id)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get($this->baseUrl . '/city', [
            'province' => $province_id
        ]);

        return response()->json($response->json());
    }

    public function checkCost(Request $request)
    {
        $request->validate([
            'destination' => 'required',
            'weight' => 'required|numeric',
            'courier' => 'required'
        ]);

        $origin = env('RAJAONGKIR_ORIGIN_ID', 43); // 43 = Banjarmasin default

        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->post($this->baseUrl . '/cost', [
            'origin' => $origin,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => $request->courier
        ]);

        return response()->json($response->json());
    }
}
