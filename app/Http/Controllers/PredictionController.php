<?php

namespace App\Http\Controllers;

use App\Models\Examinations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PredictionController extends Controller
{
    public function showForm()
    {
        return view('predict.predict');
    }

    public function predict(Request $request)
    {
        $validated = $this->validatePrediction($request);

        try {
            $response = Http::post('http://127.0.0.1:5001/predict', $validated);

            if ($response->successful()) {
                $data = $response->json();
                $predictionResult = $data['prediction'];
                $expertReasons = [];

                if ($validated['age'] > 50) {
                    $expertReasons[] = "Usia lebih dari 50 tahun.";
                } elseif ($validated['age'] >= 40 && $validated['age'] <= 50) {
                    $expertReasons[] = "Usia antara 40-50 tahun.";
                }

                if ($validated['trestbps'] > 140) {
                    $expertReasons[] = "Tekanan darah lebih dari 140 mmHg.";
                } elseif ($validated['trestbps'] >= 120 && $validated['trestbps'] <= 140) {
                    $expertReasons[] = "Tekanan darah antara 120-140 mmHg.";
                }

                if ($validated['chol'] > 240) {
                    $expertReasons[] = "Kolesterol lebih dari 240 mg/dL.";
                } elseif ($validated['chol'] >= 200 && $validated['chol'] <= 240) {
                    $expertReasons[] = "Kolesterol antara 200-240 mg/dL.";
                }

                if ($validated['cp'] == 1) {
                    $expertReasons[] = "Jenis nyeri dada tipikal.";
                } elseif ($validated['cp'] == 2) {
                    $expertReasons[] = "Jenis nyeri dada atipikal.";
                } elseif ($validated['cp'] == 3) {
                    $expertReasons[] = "Jenis nyeri dada non-anginal.";
                }


                if ($validated['fbs'] > 200) {
                    $expertReasons[] = "Gula darah sewaktu lebih dari 200 mg/dL.";
                }

                if ($validated['restecg'] == 2) {
                    $expertReasons[] = "Hasil elektrokardiografi menunjukkan hipertrofi ventrikel kiri.";
                } elseif ($validated['restecg'] == 1) {
                    $expertReasons[] = "Hasil elektrokardiografi menunjukkan kelainan ST-T.";
                } elseif ($validated['restecg'] == 0) {
                    $expertReasons[] = "Hasil elektrokardiografi normal.";
                }


                if ($validated['thalach'] < 100) {
                    $expertReasons[] = "Denyut jantung maksimum kurang dari 100 bpm.";
                } elseif ($validated['thalach'] >= 100 && $validated['thalach'] <= 150) {
                    $expertReasons[] = "Denyut jantung maksimum antara 100-150 bpm.";
                } elseif ($validated['thalach'] > 150) {
                    $expertReasons[] = "Denyut jantung maksimum lebih dari 150 bpm.";
                }


                if ($validated['exang'] == 1) {
                    $expertReasons[] = "Nyeri dada saat olahraga.";
                } elseif ($validated['exang'] == 0) {
                    $expertReasons[] = "Tidak ada nyeri dada saat olahraga.";
                }

                $combinedExplanation = $data['explanation'];
                if ($predictionResult == 1 && !empty($expertReasons)) {
                    $combinedExplanation .= " Alasan lain yang mengindikasikan risiko (berdasarkan analisis pakar): " . implode(", ", $expertReasons) . ".";
                }  elseif ($predictionResult == 0 && !empty($expertReasons)) {
                    $combinedExplanation .= " Alasan lain yang mengindikasikan tidak ada risiko (berdasarkan analisis pakar): " . implode(", ", $expertReasons) . ".";
                }

                $examination = Examinations::create([
                    'user_id' => auth()->id(),
                    'patient_name' => $validated['patient_name'],
                    'age' => $validated['age'],
                    'sex' => $validated['sex'],
                    'cp' => $validated['cp'],
                    'trestbps' => $validated['trestbps'],
                    'chol' => $validated['chol'],
                    'fbs' => $validated['fbs'],
                    'restecg' => $validated['restecg'],
                    'thalach' => $validated['thalach'],
                    'exang' => $validated['exang'],
                    'shap_values' => json_encode($data['shap_values']),
                    'explanation' => $combinedExplanation,
                    'prediction' => $predictionResult ?? null,
                ]);

                return redirect()->route('predict.form')
                ->with('prediction', $data)
                ->with('expert_reasons', $expertReasons)
                ->with('examination', $examination);
            }

            return redirect()->route('predict.form')->with('error', 'Gagal mendapatkan prediksi dari API.');
        } catch (\Exception $e) {
            return redirect()->route('predict.form')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function create(Request $request)
    {
        // Validasi input
        $validated = $this->validatePrediction($request);

        try {

            $examination = Examinations::create($validated);

            return redirect()->route('predict.form')->with('success', 'Examination record created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('predict.form')->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    // Fungsi untuk menghapus data examination berdasarkan ID
    public function delete($id)
    {
        try {
            $examination = Examinations::findOrFail($id);
            $examination->delete();

            return redirect()->route('predict.form')->with('success', 'Examination record deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('predict.form')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Fungsi untuk validasi input prediksi
    private function validatePrediction($request)
    {
        return $request->validate([
            'patient_name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'sex' => 'required|in:0,1',
            'cp' => 'required|numeric',
            'trestbps' => 'required|numeric',
            'chol' => 'required|numeric',
            'fbs' => 'required|in:0,1',
            'restecg' => 'required|numeric',
            'thalach' => 'required|numeric',
            'exang' => 'required|in:0,1',
        ]);
    }
}
