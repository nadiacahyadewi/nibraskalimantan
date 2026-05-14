<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    /**
     * Menampilkan daftar provinsi dari API Raja Ongkir
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil data provinsi dari API Raja Ongkir
        $response = Http::withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),

        ])->get('https://rajaongkir.komerce.id/api/v1/destination/province');

        // Initialize before checking success to avoid undefined variable error on failure
        $provinces = [];

        // Memeriksa apakah permintaan berhasil
        if ($response->successful()) {
            // Mengambil data provinsi dari respons JSON
            $provinces = $response->json()['data'] ?? [];
        }

        // returning the view with provinces data
        return view('rajaongkir', compact('provinces'));
    }

    /**
     * Mengambil data kota berdasarkan ID provinsi
     *
     * @param int $provinceId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($provinceId)
    {
        // Mengambil data kota berdasarkan ID provinsi dari API Raja Ongkir
        $response = Http::withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),

        ])->get("https://rajaongkir.komerce.id/api/v1/destination/city/{$provinceId}");

        if ($response->successful()) {

            // Mengambil data kota dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            return response()->json($response->json()['data'] ?? []);
        }
    }

    /**
     * Mengambil data kecamatan berdasarkan ID kota
     *
     * @param int $cityId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistricts($cityId)
    {
        // Mengambil data kecamatan berdasarkan ID kota dari API Raja Ongkir
        $response = Http::withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),

        ])->get("https://rajaongkir.komerce.id/api/v1/destination/district/{$cityId}");

        if ($response->successful()) {

            // Mengambil data kecamatan dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            return response()->json($response->json()['data'] ?? []);
        }
    }

    /**
     * Menghitung ongkos kirim berdasarkan data yang diberikan
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkOngkir(Request $request)
    {
        $courier = $request->input('courier');
        
        // Cek jika pengguna memilih 'termurah', maka gabungkan semua kurir populer
        if ($courier === 'termurah') {
            $courier = 'jne:pos:tiki:sicepat:jnt:anteraja:lion:ninja';
        }

        $response = Http::asForm()->withHeaders([
            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key'    => config('rajaongkir.api_key'),
        ])->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
                'origin'      => 299, // ID kecamatan banjarbaru utara
                'destination' => $request->input('district_id'), // ID kecamatan tujuan
                'weight'      => $request->input('weight'), // Berat dalam gram
                'courier'     => $courier, // String kurir
        ]);

        if ($response->successful()) {

            // Mengambil data ongkos kirim dari respons JSON
            $data = $response->json()['data'] ?? [];

            // Memfilter layanan JTR khusus motor (JTR<130, JTR>130, dsb.) yang harganya di atas 1 juta
            $filteredData = array_values(array_filter($data, function($item) {
                $service = strtoupper($item['service'] ?? '');
                // Jika mengandung karakter '<', '>', atau '250', abaikan (ini layanan pengiriman motor/barang sangat besar)
                if (strpos($service, '<') !== false || strpos($service, '>') !== false || strpos($service, '250') !== false) {
                    return false;
                }
                return true;
            }));

            // Mengurutkan dari harga termurah ke termahal (Sorting by cost ASC)
            usort($filteredData, function($a, $b) {
                return $a['cost'] <=> $b['cost'];
            });

            return $filteredData;
        }
    }
}
