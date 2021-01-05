<?php


namespace App\Services;


use App\Constants\EnvironmentKeys;
use Illuminate\Support\Facades\Http;

class MaxxApiService implements MaxxApiServiceInterface
{

     public function createReferralSession(string $affiliateId){
         $origin = env(EnvironmentKeys::MAXX_API_ORIGIN);
         $apiKey = env(EnvironmentKeys::MAXX_API_API_KEY);
         $response = Http::withHeaders([
             'x-api-key'=> $apiKey
         ])->get($origin.'/api/v1/affiliates/'.$affiliateId.'/referral-sessions');
         return $response;
     }
}
