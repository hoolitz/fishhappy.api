<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Http\Controllers\Controller;
use App\Region;
use App\Street;
use App\StreetRoad;
use App\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class AddressesController extends Controller
{


    public function __construct()
    {
        //$this->middleware('auth:api'); allow after finishing development
//        Http::globalRequestMiddleware(function ($request) {
//            return $request->withHeader([
//                'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
//            ]);
//        });

        $this->middleware('auth:api');

    }

    //THINK ABOUT CACHING THE RESULTS
    public function getRegions(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
            ])->get(env('NAPA_BASE_URL') . 'frontend_api/api/pub/regions');
            if ($response->status() == 200) {
                return $response->json()['data'];
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
            ], $e->getCode())->setStatusCode($e->getCode());
        }
    }


    public function getDistricts(Request $request, $id)
    {

        try {
            $response = Http::withHeaders([
                'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
            ])->get(env('NAPA_BASE_URL') . 'frontend_api/api/pub/districts/' . $id);
            if ($response->status() == 200) {
                return $response->json()['data'];
            }

        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
            ], $e->getCode())->setStatusCode($e->getCode());
        }

        return \response()->json([
            'message' => 'Something went wrong..'
        ]);

    }


    public function getCouncils(Request $request, $id)
    {
        try {
            $response = Http::withHeaders([
                'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
            ])->get(env('NAPA_BASE_URL') . 'frontend_api/api/pub/skip_councils/' . $id);
            if ($response->status() == 200) {
                return $response->json()['data'];
            }

        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
            ], $e->getCode())->setStatusCode($e->getCode());
        }
    }


    public function getStreet(Request $request, $id)
    {
        try {
            $response = Http::withHeaders([
                'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
            ])->get(env('NAPA_BASE_URL') . 'frontend_api/api/pub/streets/' . $id);
            if ($response->status() == 200) {
                return $response->json()['data'];
            }

        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
            ], $e->getCode())->setStatusCode($e->getCode());
        }
    }


    public function getStreetRoad(Request $request, $id)
    {
        try {
            $response = Http::withHeaders([
                'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
            ])->post(env('NAPA_BASE_URL') . 'frontend_api/api/pub/drill_locations', ['location_id' => $id, 'skip' => 0]);
            if ($response->status() == 200) {
                return $response->json()["data"];
            }

        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
            ], $e->getCode())->setStatusCode($e->getCode());
        }
    }


    public function getAddress(Request $request, $id)
    {
        try {
            $response = Http::withHeaders([
                'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
            ])->get(env('NAPA_BASE_URL') . 'frontend_api/api/pub/skip_addresses/' . $id);
            if ($response->status() == 200) {
                return $response->json()['data'];
            }

        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
            ], $e->getCode())->setStatusCode($e->getCode());
        }
    }


    public function createShipping(Request $request)
    {

        try {
            $customer = auth("api")->user();
            $ward = Ward::select(['id', 'region_id', 'district_id'])->where('napa_ward_id', $request->napa_ward_id)->first();

            //Street
            $street = Street::firstOrCreate(
                ['napa_street_id' => $request->napa_street_id],
                [
                    'name' => $request->street_name,
                    'postcode' => $request->street_postcode,
                    'ward_id' => $ward->id,
                    'district_id' => $ward->district_id,
                    'region_id' => $ward->region_id,
                ]
            );

            //Street Road
            $street_road = StreetRoad::firstOrCreate(
                ['napa_street_road_id' => $request->napa_street_road_id],
                [
                    'name' => $request->street_road_name,
                    'postcode' => $request->street_road_postcode,
                    'napa_street_road_id' => $request->napa_street_road_id,
                    'street_id' => $street->id,
                ]
            );

            $address = [
                'contact_name' => $request->contact_name,
                'phone_number' => $request->phone_number,
                'optional_phone_number' => $request->optional_phone_number,
                'number' => $request->number,
                'code' => $request->code,
                'trimedCode' => $request->trimedCode,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'postcode' => $request->postcode,
                'customer_id' => $customer->id,
                'region_id' => $ward->region_id,
                'district_id' => $ward->district_id,
                'ward_id' => $ward->id,
                'street_id' => $street->id,
                'street_road_id' => $street_road->id,
                'isDefault' => $request->isDefault,
            ];

            Address::create($address);

            return response()->json([
                'message' => 'Address created Successful',
                'status' => 200,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
            ], $e->getCode())->setStatusCode($e->getCode());
        }

    }


    public function getCustomerAddresses(Request $id)
    {
        try {
            $customer = auth("api")->user();
            $address = Address::where('customer_id', $customer->id)->get();
            return response()->json($address, 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
            ], $e->getCode())->setStatusCode($e->getCode());
        }
    }


}
