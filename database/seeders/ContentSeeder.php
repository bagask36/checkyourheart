<?php

namespace Database\Seeders;

use App\Models\ContentBlock;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $blocks = [
            ['group' => 'landing', 'type' => 'hero', 'key' => 'hero', 'title' => 'Deteksi Dini Risiko Penyakit Jantung', 'body' => 'Platform berbasis machine learning untuk membantu analisis risiko serangan jantung, monitoring statistik pasien, dan edukasi kesehatan jantung.', 'meta' => ['button_text' => 'Mulai Gratis', 'button_url' => '/register', 'secondary_text' => 'Sudah punya akun?', 'secondary_url' => '/login'], 'sort_order' => 0],
            ['group' => 'landing', 'type' => 'stat', 'key' => 'stat_1', 'title' => '#1', 'body' => 'Penyakit jantung adalah penyebab kematian utama di dunia', 'meta' => null, 'sort_order' => 1],
            ['group' => 'landing', 'type' => 'stat', 'key' => 'stat_2', 'title' => '80%', 'body' => 'Serangan jantung dapat dicegah dengan gaya hidup sehat', 'meta' => null, 'sort_order' => 2],
            ['group' => 'landing', 'type' => 'stat', 'key' => 'stat_3', 'title' => 'ML + Pakar', 'body' => 'Kombinasi model machine learning dan aturan medis', 'meta' => null, 'sort_order' => 3],
            ['group' => 'landing', 'type' => 'feature', 'key' => 'feature_1', 'title' => 'Prediksi Risiko', 'body' => 'Analisis risiko penyakit jantung berdasarkan data pemeriksaan medis pasien.', 'meta' => ['icon' => 'fa-brain'], 'sort_order' => 1],
            ['group' => 'landing', 'type' => 'feature', 'key' => 'feature_2', 'title' => 'Dashboard Statistik', 'body' => 'Pantau tren pemeriksaan, distribusi risiko, dan data pasien secara visual.', 'meta' => ['icon' => 'fa-chart-line'], 'sort_order' => 2],
            ['group' => 'landing', 'type' => 'feature', 'key' => 'feature_3', 'title' => 'Edukasi Kesehatan', 'body' => 'Materi pencegahan dan tanda bahaya penyakit jantung yang mudah dipahami.', 'meta' => ['icon' => 'fa-book-medical'], 'sort_order' => 3],
            ['group' => 'landing', 'type' => 'step', 'key' => 'step_1', 'title' => 'Buat Akun', 'body' => 'Daftar gratis dan masuk ke platform Check Your Heart.', 'meta' => ['value' => '1'], 'sort_order' => 1],
            ['group' => 'landing', 'type' => 'step', 'key' => 'step_2', 'title' => 'Input Data Pemeriksaan', 'body' => 'Lengkapi data pasien dan hasil pemeriksaan medis.', 'meta' => ['value' => '2'], 'sort_order' => 2],
            ['group' => 'landing', 'type' => 'step', 'key' => 'step_3', 'title' => 'Dapatkan Prediksi', 'body' => 'Sistem menganalisis risiko dan memberikan rekomendasi lanjutan.', 'meta' => ['value' => '3'], 'sort_order' => 3],
            ['group' => 'landing', 'type' => 'cta', 'key' => 'cta', 'title' => 'Siap Menjaga Kesehatan Jantung?', 'body' => 'Mulai prediksi risiko dan pantau kesehatan jantung Anda hari ini.', 'meta' => ['button_text' => 'Daftar Sekarang', 'button_url' => '/register'], 'sort_order' => 0],

            ['group' => 'education', 'type' => 'hero', 'key' => 'hero', 'title' => 'Edukasi Pencegahan Penyakit Jantung', 'body' => 'Penyakit jantung merupakan salah satu penyebab kematian tertinggi di dunia. Pelajari cara mencegahnya dan jaga kesehatan jantung Anda sejak dini.', 'meta' => null, 'sort_order' => 0],
            ['group' => 'education', 'type' => 'fact', 'key' => 'fact_1', 'title' => '#1', 'body' => 'Penyakit jantung adalah penyebab kematian utama di dunia', 'meta' => null, 'sort_order' => 1],
            ['group' => 'education', 'type' => 'fact', 'key' => 'fact_2', 'title' => '80%', 'body' => 'Serangan jantung dapat dicegah dengan gaya hidup sehat', 'meta' => null, 'sort_order' => 2],
            ['group' => 'education', 'type' => 'fact', 'key' => 'fact_3', 'title' => '30 min', 'body' => 'Olahraga ringan per hari sudah cukup membantu jantung sehat', 'meta' => null, 'sort_order' => 3],
            ['group' => 'education', 'type' => 'intro', 'key' => 'intro', 'title' => 'Lindungi Jantung Anda: Mulai dari Gaya Hidup Sehat', 'body' => 'Risiko penyakit jantung meningkat akibat pola hidup tidak sehat. Mulailah menjaga jantung dengan menerapkan kebiasaan sehat secara konsisten.', 'meta' => null, 'sort_order' => 0],
            ['group' => 'education', 'type' => 'warning', 'key' => 'warning_1', 'title' => null, 'body' => 'Nyeri dada atau sesak napas', 'meta' => ['icon' => 'fa-heart-crack'], 'sort_order' => 1],
            ['group' => 'education', 'type' => 'warning', 'key' => 'warning_2', 'title' => null, 'body' => 'Pusing atau pingsan mendadak', 'meta' => ['icon' => 'fa-circle-exclamation'], 'sort_order' => 2],
            ['group' => 'education', 'type' => 'warning', 'key' => 'warning_3', 'title' => null, 'body' => 'Sesak napas saat beraktivitas', 'meta' => ['icon' => 'fa-lungs'], 'sort_order' => 3],
            ['group' => 'education', 'type' => 'warning', 'key' => 'warning_4', 'title' => null, 'body' => 'Detak jantung tidak teratur', 'meta' => ['icon' => 'fa-heart-pulse'], 'sort_order' => 4],
            ['group' => 'education', 'type' => 'tip', 'key' => 'tip_1', 'title' => 'Konsumsi Makanan Sehat', 'body' => 'Perbanyak buah, sayur, biji-bijian, dan makanan rendah lemak jenuh. Kurangi garam dan gula berlebih.', 'meta' => ['icon' => 'fa-apple-whole', 'accent' => '#2a9d8f', 'value' => '1'], 'sort_order' => 1],
            ['group' => 'education', 'type' => 'tip', 'key' => 'tip_2', 'title' => 'Rutin Berolahraga', 'body' => 'Olahraga ringan seperti jalan kaki, jogging, atau bersepeda selama 30 menit per hari, minimal 5 kali seminggu.', 'meta' => ['icon' => 'fa-person-walking', 'accent' => '#457b9d', 'value' => '2'], 'sort_order' => 2],
            ['group' => 'education', 'type' => 'tip', 'key' => 'tip_3', 'title' => 'Hindari Merokok', 'body' => 'Merokok merusak pembuluh darah dan meningkatkan risiko serangan jantung secara signifikan.', 'meta' => ['icon' => 'fa-ban-smoking', 'accent' => '#e63946', 'value' => '3'], 'sort_order' => 3],
            ['group' => 'education', 'type' => 'tip', 'key' => 'tip_4', 'title' => 'Cek Tekanan Darah & Kolesterol', 'body' => 'Pantau tekanan darah dan kolesterol secara rutin. Tekanan darah ideal dewasa 90/60–120/80 mmHg, kolesterol total ideal di bawah 200 mg/dL.', 'meta' => ['icon' => 'fa-heart-pulse', 'accent' => '#e9c46a', 'value' => '4'], 'sort_order' => 4],
            ['group' => 'education', 'type' => 'tip', 'key' => 'tip_5', 'title' => 'Kelola Stres dengan Baik', 'body' => 'Stres kronis dapat mempengaruhi tekanan darah. Coba relaksasi, meditasi, atau lakukan hobi yang menyenangkan.', 'meta' => ['icon' => 'fa-spa', 'accent' => '#6a4c93', 'value' => '5'], 'sort_order' => 5],
            ['group' => 'education', 'type' => 'cta', 'key' => 'cta', 'title' => 'Ingin Tahu Risiko Penyakit Jantung Anda?', 'body' => 'Gunakan fitur prediksi untuk menganalisis risiko berdasarkan data pemeriksaan medis.', 'meta' => ['button_text' => 'Cek Risiko Sekarang', 'button_url' => '/predict'], 'sort_order' => 0],

            ['group' => 'auth', 'type' => 'brand', 'key' => 'login', 'title' => 'Jaga Kesehatan Jantung Anda', 'body' => 'Platform prediksi risiko penyakit jantung untuk membantu deteksi dini dan edukasi kesehatan yang lebih baik.', 'meta' => null, 'sort_order' => 0],
            ['group' => 'auth', 'type' => 'brand', 'key' => 'register', 'title' => 'Mulai Perjalanan Kesehatan Jantung', 'body' => 'Buat akun gratis untuk mengakses fitur prediksi risiko, dashboard statistik, dan materi edukasi kesehatan jantung.', 'meta' => null, 'sort_order' => 0],
            ['group' => 'auth', 'type' => 'feature', 'key' => 'feature_1', 'title' => null, 'body' => 'Prediksi risiko berbasis machine learning', 'meta' => ['icon' => 'fa-brain'], 'sort_order' => 1],
            ['group' => 'auth', 'type' => 'feature', 'key' => 'feature_2', 'title' => null, 'body' => 'Dashboard statistik pemeriksaan pasien', 'meta' => ['icon' => 'fa-chart-line'], 'sort_order' => 2],
            ['group' => 'auth', 'type' => 'feature', 'key' => 'feature_3', 'title' => null, 'body' => 'Edukasi pencegahan penyakit jantung', 'meta' => ['icon' => 'fa-book-medical'], 'sort_order' => 3],
        ];

        foreach ($blocks as $block) {
            ContentBlock::updateOrCreate(
                ['group' => $block['group'], 'key' => $block['key']],
                $block
            );
        }
    }
}
