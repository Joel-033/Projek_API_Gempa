<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class GempaController extends Controller
{
    private $apiKey;
    private $baseUrl;
    private $headers;

    public function __construct()
    {
        $this->apiKey = env('API_INDONESIA_KEY');
        $this->baseUrl = env('API_INDONESIA_BASE_URL', 'https://use.apiindonesia.id/api/v1/gempa');
        $this->headers = ['x-api-key' => $this->apiKey];
    }

    public function terkini(Request $request)
    {
        $gempa = null;
        $error = null;

        if ($request->has('tarik_data')) {
            $response = Http::withHeaders($this->headers)->get($this->baseUrl . '/terkini');
            if ($response->successful()) {
                $gempa = $response->json()['data'] ?? null;
            } else {
                $error = "Gagal mengambil data. Status: " . $response->status() . " - " . $response->body();
            }
        }
        return view('terkini', compact('gempa', 'error'));
    }

    public function dirasakan(Request $request)
    {
        $gempaList = [];
        $error = null;

        if ($request->has('tarik_data')) {
            $response = Http::withHeaders($this->headers)->get($this->baseUrl . '/dirasakan');
            if ($response->successful()) {
                $gempaList = $response->json()['data'] ?? [];
            } else {
                $error = "Gagal mengambil data. Status: " . $response->status() . " - " . $response->body();
            }
        }
        return view('dirasakan', compact('gempaList', 'error'));
    }

    public function history(Request $request)
    {
        $gempaList = [];
        $error = null;
        
        $startDate = $request->input('start', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end', Carbon::now()->format('Y-m-d'));

        if ($request->has('tarik_data')) {
            $response = Http::withHeaders($this->headers)->get($this->baseUrl . '/history', [
                'start' => $startDate,
                'end'   => $endDate
            ]);
            
            if ($response->successful()) {
                $gempaList = $response->json()['data'] ?? [];
            } else {
                $error = "Gagal mengambil data. Status: " . $response->status() . " - " . $response->body();
            }
        }
        return view('history', compact('gempaList', 'startDate', 'endDate', 'error'));
    }
}