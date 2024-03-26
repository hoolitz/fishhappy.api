<?php

use App\Street;
use App\Ward;
use Illuminate\Database\Seeder;

class StreetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wardIds = Ward::select(['id','region_id','district_id','napa_ward_id'])->get();
        try {
            foreach ($wardIds as $wardId) {

                $response = Http::withHeaders([
                    'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
                ])->get(env('NAPA_BASE_URL') . 'frontend_api/api/pub/streets/'.$wardId->napa_ward_id);
                if ($response->successful()) {
                    $streets = $response->json()['data'];

                    foreach ($streets as $street) {
                        Street::create([
                            'name' => $street['name'],
                            'postcode' => $street['postcode'],
                            'napa_street_id' => $street['id'],
                            'ward_id' => $wardId->id,
                            'district_id' => $wardId->id,
                            'region_id' => $wardId->region_id,
                        ]);
                    }
                }
            }

        } catch (Exception $e) {
            $this->command->error('Failed to fetch Streets data from the API '.$e->getMessage());
        }
    }
}
