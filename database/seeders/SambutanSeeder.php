<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sambutan;

class SambutanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sambutan::create([
            'nama_kepala_sekolah' => 'Drs. Ahmad Fauzi, M.Pd.',
            'jabatan' => 'Kepala Sekolah',
            'pesan' => "Bismillahirrahmanirrahim. Assalamu'alaikum Wr. Wb. Selamat datang di SMK Agri Insani — sekolah kejuruan pertanian yang hadir dengan semangat mempersiapkan generasi muda Indonesia menghadapi tantangan sektor agrikultur dan teknologi modern. Kami percaya bahwa tanah adalah amanah, dan ilmu adalah kunci untuk mengelolanya secara bertanggung jawab.\n\nDi SMK Agri Insani, setiap siswa tidak hanya dibekali kompetensi teknis terkini, tetapi juga dibentuk karakternya menjadi insan yang berakhlak mulia, kreatif, dan berdaya saing global. Kami terus berinovasi dalam metode pembelajaran berbasis praktik, kewirausahaan, serta literasi digital agar lulusan kami siap berkontribusi nyata bagi masyarakat dan bangsa."
        ]);
    }
}
