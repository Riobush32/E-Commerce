<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class RajaOngkirService
{
    // Ganti dengan API Key RajaOngkir Anda
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('RAJAONGKIR_API_KEY'); // Mendapatkan API Key dari .env
        $this->baseUrl = 'https://api.rajaongkir.com/starter'; // Base URL API RajaOngkir
    }

    // Mendapatkan daftar provinsi
    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get("{$this->baseUrl}/province");

        return $response->json()['rajaongkir']['results'];
    }

    // Mendapatkan daftar kota berdasarkan ID provinsi
    public function getCities()
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get("{$this->baseUrl}/city");

        return $response->json()['rajaongkir']['results'];
    }

    // Menghitung ongkir berdasarkan parameter yang diberikan
    public function calculateShipping($origin, $destination, $weight, $courier)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->post("{$this->baseUrl}/cost", [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier
        ]);

        return $response->json()['rajaongkir']['results'][0]['costs'];
    }
}
