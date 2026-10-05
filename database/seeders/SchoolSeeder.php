<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;
use App\Models\News;
use App\Models\Gallery;
use App\Models\SocialMedia;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Dummy Slider
        Slider::create([
            'title' => 'Selamat Datang di MA Hasanuddin',
            'caption' => 'Mewujudkan Generasi Unggul, Berilmu, dan Berakhlaqul Karimah',
            'image' => 'https://picsum.photos/1200/500?random=1',
            'is_active' => true,
        ]);
        Slider::create([
            'title' => 'Penerimaan Peserta Didik Baru (PPDB)',
            'caption' => 'Pendaftaran Tahun Ajaran Baru Telah Dibuka!',
            'image' => 'https://picsum.photos/1200/500?random=2',
            'is_active' => true,
        ]);

        // 2. Dummy Berita
        News::create([
            'title' => 'Siswa MA Hasanuddin Raih Juara Olimpiade Sains',
            'slug' => 'siswa-ma-hasanuddin-raih-juara-olimpiade-sains',
            'content' => 'Selamat kepada para siswa yang telah mengharumkan nama sekolah dalam ajang kompetisi sains nasional tingkat kabupaten.',
            'image' => 'https://picsum.photos/600/400?random=3',
            'published_at' => now(),
        ]);
        News::create([
            'title' => 'Kegiatan Pondok Ramadan dan Bakti Sosial',
            'slug' => 'kegiatan-pondok-ramadan-dan-bakti-sosial',
            'content' => 'Seluruh siswa dan dewan guru antusias mengikuti agenda tahunan Pondok Ramadan dan penyaluran zakat ke warga sekitar.',
            'image' => 'https://picsum.photos/600/400?random=4',
            'published_at' => now(),
        ]);

        // 3. Dummy Galeri
        Gallery::create([
            'title' => 'Upacara Bendera Hari Senin',
            'category' => 'Kegiatan',
            'image' => 'https://picsum.photos/400/300?random=5',
        ]);
        Gallery::create([
            'title' => 'Laboratorium Komputer Modern',
            'category' => 'Fasilitas',
            'image' => 'https://picsum.photos/400/300?random=6',
        ]);

        // 4. Dummy Social Media
        SocialMedia::create([
            'platform' => 'Instagram',
            'url' => 'https://instagram.com',
            'icon' => 'bi-instagram',
        ]);
        SocialMedia::create([
            'platform' => 'YouTube',
            'url' => 'https://youtube.com',
            'icon' => 'bi-youtube',
        ]);

        // Buat Akun Admin Sekolah
        \App\Models\User::create([
            'name' => 'Admin MA Hasanuddin',
            'email' => 'admin@mahasanuddin.sch.id',
            'password' => bcrypt('admin123'), // Password login admin
        ]);
    }
}