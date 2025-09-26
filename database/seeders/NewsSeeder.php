<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'super_admin')->first();

        $publicNews = [
            [
                'title' => 'HIMTI Meraih Juara 1 Lomba Programming Nasional',
                'excerpt' => 'Tim HIMTI berhasil meraih juara 1 dalam lomba programming tingkat nasional dengan proyek inovatif.',
                'content' => "# Prestasi Membanggakan HIMTI\n\nTim Himpunan Mahasiswa Teknik Informatika (HIMTI) kembali mengukir prestasi membanggakan dengan meraih juara 1 dalam Lomba Programming Nasional 2024.\n\n## Detail Kompetisi\n\nKompetisi yang diselenggarakan di Jakarta ini diikuti oleh lebih dari 100 tim dari seluruh Indonesia. Tim HIMTI yang terdiri dari 3 mahasiswa terbaik berhasil mengalahkan pesaing dengan solusi inovatif mereka.\n\n## Proyek Pemenang\n\nProyek yang dibuat adalah aplikasi manajemen kampus berbasis AI yang dapat membantu mahasiswa dalam:\n- Penjadwalan kuliah otomatis\n- Rekomendasi mata kuliah\n- Analisis performa akademik\n\nTim berhasil mengimplementasikan algoritma machine learning yang canggih untuk memberikan rekomendasi yang akurat.",
                'type' => 'public',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Workshop Android Development untuk Mahasiswa Baru',
                'excerpt' => 'HIMTI menyelenggarakan workshop pengembangan aplikasi Android untuk mahasiswa semester awal.',
                'content' => "# Workshop Android Development\n\nHIMTI akan menyelenggarakan workshop pengembangan aplikasi Android yang ditujukan khusus untuk mahasiswa semester awal.\n\n## Materi Workshop\n\nWorkshop ini akan membahas:\n\n1. **Dasar-dasar Android Development**\n   - Pengenalan Android Studio\n   - Layout dan UI Design\n   - Activity dan Fragment\n\n2. **Database dan Storage**\n   - SQLite Database\n   - SharedPreferences\n   - File Storage\n\n3. **Networking**\n   - REST API Integration\n   - JSON Parsing\n   - HTTP Requests\n\n## Pendaftaran\n\nPendaftaran dapat dilakukan melalui link yang akan dibagikan di grup WhatsApp angkatan.",
                'type' => 'public',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
        ];

        $internalNews = [
            [
                'title' => 'Rapat Koordinasi Pengurus HIMTI Periode 2024',
                'excerpt' => 'Rapat koordinasi membahas program kerja dan evaluasi kegiatan semester ini.',
                'content' => "# Rapat Koordinasi Pengurus HIMTI\n\nRapat koordinasi pengurus HIMTI periode 2024 telah dilaksanakan pada hari Senin, 15 Januari 2024.\n\n## Agenda Rapat\n\n1. **Evaluasi Program Kerja**\n   - Review kegiatan semester ganjil\n   - Analisis pencapaian target\n   - Identifikasi kendala dan solusi\n\n2. **Perencanaan Semester Genap**\n   - Workshop teknis\n   - Seminar teknologi\n   - Kompetisi internal\n\n3. **Keuangan Organisasi**\n   - Laporan keuangan semester ganjil\n   - Budget planning semester genap\n   - Proposal sponsor",
                'type' => 'internal',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
        ];

        foreach ($publicNews as $news) {
            News::create(array_merge($news, ['author_id' => $admin->id]));
        }

        foreach ($internalNews as $news) {
            News::create(array_merge($news, ['author_id' => $admin->id]));
        }
    }
}
