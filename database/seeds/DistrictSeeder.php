<?php

use App\District;
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

                //echo($regionsId);
                $response = Http::withHeaders([
                    'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
                ])->get(env('NAPA_BASE_URL') .'frontend_api/api/pub/districts/'.$regionsId->napa_region_id);

                if ($response->successful()) {
                    $districts = $response->json()['data'];
                    foreach ($districts as $district) {
                        District::create([
                            'region_id' => $regionsId->id,
                            'name' => $district['name'],
                            'napa_district_id' => $district['id'],
                            'napa_region_id' => $regionsId->napa_region_id,
                            'postcode' => $district['postcode']
                        ]);
                    }
                }
            }

        } catch (Exception $e) {
            $this->command->error('Failed to fetch district data from the API '.$e->getMessage());
        }
    }
}
