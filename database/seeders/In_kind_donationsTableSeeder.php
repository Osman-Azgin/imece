<?php

namespace Database\Seeders;

use App\Models\InKindDonation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class In_kind_donationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$in_kinde_donationsArray = ['Gıda', 'Giysi', 'Hijyen', 'Isıtıcı', 'Barınma', 'Kırtasiye', 'Kitap', 'Mobilya', 'Oyuncak', 'Sağlık',  'Temizlik', 'Bebek', 'Ayakkabı', 'Elektronik'];

        $in_kinde_donationsArray = [ 'Yiyecek',
            'Kuru gıdalar: bisküvi, kraker, bar gibi dayanıklı yiyecekler',
            'Konserveler: konserve ton balığı, salça, fasulye, sebze vs.',
            'Su: temiz içme suyu',
            'Sebzeler: patates, soğan, havuç vb.',
            'Kuru baklagiller: nohut, fasulye, mercimek vb.',
            'Meyveler: elma, portakal, muz vb',
            'Süt, peynir ve yoğurt vb.',
            'Çay, Meyve suyu, Kahve vb.',
            'Bebek maması',
            'Biberon, emzik vb.',
            'İlaçlar',
            'Tıbbi malzemeler',
            'Sağlık Personeli',
            'Barınma: Çadır, Konteynır vb.',
            'Battaniye, yatak, uyku tulumu ve yastık vb.',
            'Isıtıcılar',
            'Temizlik malzemeleri',
            'Kadın hijyen malzemeleri',
            'Sabun, dezenfektan, çamaşır deterjanı, vb.',
            'Tuvalet kağıdı, peçete, vs.',
            'Temizlik gereçleri: süpürge, paspas, deterjan vb.',
            'Giyim ve Ayakkabı',
            'Mont, ceket, kazak, vb.',
            'Tişört, pantolon, etek, vb.',
            'Ayakkabı, çorap vb.',
            'Çocuk giyim ve ayakkabı',
            'Çocuk montu, ceket, kazak, vb.',
            'Çocuk pantolonu, etek, elbise vb.',
            'Bebek bezleri, bebek bezi kremi, ıslak mendil vb.',
            'Oyuncak',
            'Eğitim Malzemeleri',
            'Defter, kalem, boya kalemleri vb.',
            'Kitap, ders materyalleri vb.',
            'Tablet, dizüstü bilgisayar vb.',
            'Kadın Giyim',
            'Kadın montu, ceket, kazak, vb.',
            'Kadın pantolonu, etek, bluz vb.',
            'Kadın iç çamaşırı',
            'Elektornik Eşyalar',
            'Şarj cihazı, powerbank vb.',
            'El feneri, piller, vs.',
            'Cep telefonu, telefon şarj cihazı, vs.',
            'Radyo, tv, vs.',
            'Ulaşım ve Lojistik',
            'Kargo araçları',
            'Ambulans',
            'İtfaiye araçları',
            'İş makinaları: ekskavatör, vinç, vb.',
            'Malzemeleri taşımak için kamyon, forklift vb.',
            'İnsan gücü: gönüllüler',
            'Psikolojik destek: konuşma terapisi, oyun terapisi, vb',
            'Kadın doğum uzmanı hizmeti',
            'Doktor',];

        foreach ($in_kinde_donationsArray as $in_kinde_donation) {
            InKindDonation::create([
                'name' => $in_kinde_donation,
            ]);
        }

    }
}
