<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Examinations;

class DashboardController extends Controller
{
    public function index()
    {
        $positives = Examinations::where('prediction', 1)->get();
        $negatives = Examinations::where('prediction', 0)->get();

        $positiveByGender = $positives->groupBy('sex')->map->count(); 
        $negativeByGender = $negatives->groupBy('sex')->map->count();

        $positiveByAgeGroup = $positives->groupBy(fn($d) => floor($d->age / 10) * 10)->map->count(); 
        $negativeByAgeGroup = $negatives->groupBy(fn($d) => floor($d->age / 10) * 10)->map->count();

        $positiveByTensi = $positives->groupBy(fn($d) => $d->trestbps >= 140 ? 'Tinggi' : 'Normal')->map->count();
        $negativeByTensi = $negatives->groupBy(fn($d) => $d->trestbps >= 140 ? 'Tinggi' : 'Normal')->map->count();

        $positiveByChol = $positives->groupBy(fn($d) => $d->chol >= 240 ? 'Tinggi' : 'Normal')->map->count();
        $negativeByChol = $negatives->groupBy(fn($d) => $d->chol >= 240 ? 'Tinggi' : 'Normal')->map->count();

        $chartData = [
            'gender' => [
                'labels' => ['Laki-laki', 'Perempuan'],
                'positiveValues' => [$positiveByGender->get(1, 0), $positiveByGender->get(0, 0)],
                'negativeValues' => [$negativeByGender->get(1, 0), $negativeByGender->get(0, 0)]
            ],
            'ageGroup' => [
                'labels' => array_map(fn($age) => $age . 's', array_keys($positiveByAgeGroup->toArray())),
                'positiveValues' => array_values($positiveByAgeGroup->toArray()),
                'negativeValues' => array_values($negativeByAgeGroup->toArray())
            ],
            'tensi' => [
                'labels' => ['Tinggi', 'Normal'],
                'positiveValues' => [$positiveByTensi->get('Tinggi', 0), $positiveByTensi->get('Normal', 0)],
                'negativeValues' => [$negativeByTensi->get('Tinggi', 0), $negativeByTensi->get('Normal', 0)]
            ],
            'chol' => [
                'labels' => ['Tinggi', 'Normal'],
                'positiveValues' => [$positiveByChol->get('Tinggi', 0), $positiveByChol->get('Normal', 0)],
                'negativeValues' => [$negativeByChol->get('Tinggi', 0), $negativeByChol->get('Normal', 0)]
            ]
        ];

        $patients = Examinations::with('user')->latest()->paginate(10);

        return view('dashboard.index', compact('chartData' , 'patients'));
    }
}
