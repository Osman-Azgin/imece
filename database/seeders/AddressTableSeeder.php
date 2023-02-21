<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Neighborhood;
use App\Models\Street;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country = Country::create([
            'name' => 'Türkiye',
            'code' => 'TR',
        ]);

        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 0);
        $path = storage_path('app/public/file/pk_20220810.xlsx');
        $sheet = Excel::toArray([], $path);
        $count = 0;
        foreach ($sheet as $data) {
            foreach ($data as $row) {
                if ($count == 0) {
                    $count++;
                    continue;
                }

                //if row[0] exists in database get id else create new record and get id
                $city = City::firstOrCreate(['name' => $row[0], 'country_id' => $country->idç]);
                $city_id = $city->id;
                //if row[1] exists in database get id else create new record and get id
                $district = District::firstOrCreate(['name' => $row[1], 'city_id' => $city_id]);
                $district_id = $district->id;
                //if row[2] exists in database get id else create new record and get id
                $neighborhood = Neighborhood::firstOrCreate(['name' => $row[2], 'district_id' => $district_id]);
                $neighborhood_id = $neighborhood->id;

                $street = Street::firstOrCreate(['name' => $row[3], 'neighborhood_id' => $neighborhood_id]);
                $street_id = $street->id;

            }
        }


    }
}
