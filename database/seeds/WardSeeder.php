<?php

use App\District;
use App\Ward;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class WardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districtsId = District::select(['id','region_id','napa_district_id'])->get();
        try {
            foreach ($districtsId as $district) {

                $response = Http::withHeaders([
                    'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
                ])->get(env('NAPA_BASE_URL') . 'frontend_api/api/pub/skip_councils/'.$district->napa_district_id);
                if ($response->successful()) {
                    $wards = $response->json()['data'];

                    foreach ($wards as $ward) {
                        Ward::create([
                            'name' => $ward['name'],
                            'postcode' => $ward['postcode'],
                            'napa_ward_id' => $ward['id'],
                            'region_id' => $district->region_id,
                            'district_id' => $district->id

                        ]);
                    }
                }
            }

        } catch (Exception $e) {
            $this->command->error('Failed to fetch Wards data from the API '.$e->getMessage());
        }
    }
}
