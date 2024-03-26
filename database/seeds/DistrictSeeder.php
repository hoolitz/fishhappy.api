<?php

use App\Region;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $regionsId = Region::select(['id','napa_region_id'])->get();
            foreach ($regionsId as $key => $regionId) {

                echo($regionsId);

//                $response = Http::withHeaders([
//                    'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
//                ])->get(env('NAPA_BASE_URL') .'frontend_api/api/pub/districts/'.$regionsId);
//
//                if ($response->successful()) {
//                    $regions = $response->json()['data'];
//                    foreach ($regions as $region) {
//                        Region::create([
//                            'name' => $region['name'],
//                            'napa_region_id' => $region['id'],
//                            'postcode' => $region['postcode']
//                        ]);
//                    }
//                }
            }

        } catch (Exception $e) {
            $this->command->error('Failed to fetch district data from the API '.$e->getMessage());
        }
    }
}
