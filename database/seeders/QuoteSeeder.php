<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    public function run(): void
    {
        $quotes = [
            "Doktah, nabung yang kenceng ya biar impianmu cepat tercapai. Aku selalu ngawasin kamu dari PRTS.",
            "Fun fact Doktah: PRTS itu singkatan dari Primitive Rhodes Island Terminal System. Khusus buat kamu, ini jadi sistem pengatur LMD.",
            "Jangan keseringan begadang main game Doktah, jaga kesehatan. Mimpimu masih panjang buat dikejar.",
            "Pengeluaran hari ini aman kan? Jangan sampai kayak sarkaz mercenary yang boros beli LMD ya.",
            "Aku tahu hari ini berat, tapi melihat tabunganmu nambah sedikit demi sedikit itu bikin aku bangga, Doktah.",
            "Even if the stars fade and time erodes everything, I will always be here watching over your financial logs, Doctor.",
            "Ingat Doktah, gacha boleh tapi pertimbangkan keuangan LMD bulananmu!",
            "Setiap LMD yang kamu simpan hari ini adalah fondasi untuk masa depan yang kita janjikan.",
            "PRTS detection unit active: Tidak ada pengeluaran impulsif terdeteksi hari ini... bagus, Doktah.",
            "Doktah, waktu dan uang punya satu kesamaan: sekali melayang, tak bisa diputar kembali.",
            "Apakah kamu sedang lelah, Doktah? Istirahatlah sejenak, PRTS akan menjaga catatan keuanganmu.",
            "Jangan sampai kehabisan LMD saat emergency banner atau event penting tiba, Doktah!",
            "PRTS log: Kedisiplinan finansialmu meningkat minggu ini. Pertahankan, Doktah.",
            "Suatu saat nanti, ketika semua badai berlalu, tempat ini akan menjadi saksi perjuanganmu mengumpulkan LMD.",
            "Doktah, fokus pada target jangka panjangmu. Jangan tergiur pengeluaran yang tidak penting!",
            "Sistem PRTS mencatat semua transaksi secara real-time. Keamanan data tokomu terjamin 100%.",
            "Mata uang LMD mungkin fiktif di Rhodes Island, tapi kedisiplinanmu mengelolanya sangat nyata, Doktah."
        ];

        foreach ($quotes as $q) {
            Quote::create([
                'quote' => $q,
                'character' => 'Priestess',
            ]);
        }
    }
}