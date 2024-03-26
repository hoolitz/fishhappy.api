<?php

use App\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $response = Http::withHeaders([
                'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
            ])->get(env('NAPA_BASE_URL') . 'frontend_api/api/pub/regions');

            if ($response->successful()) {
                $regions = $response->json()['data'];
                foreach ($regions as $region) {
                    Region::create([
                        'name' => $region['name'],
                        'napa_region_id' => $region['id'],
                        'postcode' => $region['postcode']
                    ]);
                }
            }

        } catch (Exception $e) {
            $this->command->error('Failed to fetch regions data from the API.');
        }
    }
}
