<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'indicator' => 'Menafikan keberagaman agama di sekitarnya',
                'question' => 'Saya tidak suka bersosialisasi dengan penganut agama lain',
            ],
            [
                'indicator' => 'Memaksakan aturan agama mereka pada kelompok lain',
                'question' => 'Saya tidak segan menyarankan orang lain untuk pindah agama sesuai dengan kepercayaan yang saya anut',
            ],
            [
                'indicator' => 'Cenderung menyematkan istilah kafir pada kelompok yang berbeda dengan mereka',
                'question' => 'Saya tidak menerima penganut lain karena mereka jalan hidup mereka membawa kesesatan',
            ],
            [
                'indicator' => 'Perilaku di luar kelompoknya dianggap hasil konspirasi barat-yahudi-zionisme',
                'question' => 'Saya tidak setuju dengan pemikiran penganut agama lain karena mereka menganut konspirasi radikal',
            ],
            [
                'indicator' => 'Sangat taat dan patuh terhadap pemimpin kelompok keagamaannya sehingga bersedia melakukan tindakan apapun',
                'question' => 'Saya tidak segan mengorbankan banyak harta untuk melaksanaan semua anjuran yang dikemukakan oleh pemuka agama',
            ],
            [
                'indicator' => 'Melakukan tindakan penghormatan berlebih-lebihan terhadap pribadi, kelompok, ataupun simbol-simbol keagamaannya',
                'question' => 'Saya tidak segan menunjukkan identitas keagamaan saya secara terbuka di depan penganut agama lain',
            ],
            [
                'indicator' => 'Membenarkan tindakan kekerasan dengan dalih agama untuk menertibkan masyarakat',
                'question' => 'Saya tidak segan menggunakan kekerasan untuk menegakkan aturan agama',
            ],
            [
                'indicator' => 'Menganggap tindakan kekerasan sebagai perintah Tuhan untuk memerangi segala bentuk tindakan yang berlawanan dengan aturan agama',
                'question' => 'Saya tidak ragu bahwa Tuhan selalu membenarkan kekerasan untuk menegakkan ajaran agama',
            ],
            [
                'indicator' => 'Setuju terhadap tindakan terorisme',
                'question' => 'Saya tidak merasa terganggu dengan adanya aksi-aksi terorisme karena merupakan bagian dari upaya penegakan agama',
            ],
            [
                'indicator' => 'Dukungan terhadap peperangan bersenjata terhadap pihak-pihak yang dianggap musuh Tuhan',
                'question' => 'Saya tidak akan ragu mendukung peperangan karena menurut saya sesuai dengan anjuran Tuhan',
            ],
            [
                'indicator' => 'Pemerintahan dianggap sekuler dan menyimpang dari agama',
                'question' => 'Saya tidak setuju dengan sistem pemerintahan saat ini karena menyimpang dengan ajaran agama ',
            ],
            [
                'indicator' => 'Menentang dan berusaha mengubah dasar negara',
                'question' => 'Saya tidak segan menyuarakan untuk mengubah Pancasila dengan ideology baru yang leboh agamis',
            ],
        ];

        foreach ($data as $item) {
            Question::create($item);
        }
    }
}
