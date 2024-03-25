<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AddressesController extends Controller
{
    // TODO

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
        //https://napa.mawasiliano.go.tz/frontend_api/api/pub/districts/3

        try {
            $response = Http::withHeaders([
                'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
            ])->get(env('NAPA_BASE_URL') . 'frontend_api/api/pub/districts/'.$id);
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



    public function getCouncils(Request $request, $id) {
        try {
            $response = Http::withHeaders([
                'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
            ])->get(env('NAPA_BASE_URL') . 'frontend_api/api/pub/skip_councils/'.$id);
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



    public function getStreet(Request $request, $id) {
        try {
            $response = Http::withHeaders([
                'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
            ])->get(env('NAPA_BASE_URL') . 'frontend_api/api/pub/streets/'.$id);
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


    public function getStreetRoad(Request $request, $id) {
        try {
            $response = Http::withHeaders([
                'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
            ])->post(env('NAPA_BASE_URL') . 'frontend_api/api/pub/drill_locations',['location_id'=>$id,'skip'=>0]);
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
    
    
    
    public function getAddress(Request $request, $id) {
        try {
            $response = Http::withHeaders([
                'X-Napa-Api-Key' => env('NAPA_API_KEY', 'None'),
            ])->get(env('NAPA_BASE_URL') . 'frontend_api/api/pub/skip_addresses/'.$id);
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
    


    public function createShipping(Request $request){
        // customer authenticated

        $customer = auth("api")->user();




    }


}
