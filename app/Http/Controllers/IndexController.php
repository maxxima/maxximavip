<?php


namespace App\Http\Controllers;


use App\Constants\EnvironmentKeys;
use App\Constants\HttpStatusCodes;
use App\Constants\ReferralLocationIdentifiers;
use App\Services\MaxxApiServiceInterface;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private $maxxApiService;
    public function __construct(MaxxApiServiceInterface $maxxApiService){
        $this->maxxApiService = $maxxApiService;
    }

    public function referralRedirect(Request $request, int $locationId,string $memberId)
    {
        $response = $this->maxxApiService->createReferralSession($memberId,$locationId,$request->ip());
        $responseData = json_decode($response);
        $referralSessionKey = null;
        switch($response->status()){
            case HttpStatusCodes::OK:
                $location = $responseData->location;
                return Redirect($location,HttpStatusCodes::TEMPORARY_REDIRECT);
            case HttpStatusCodes::NOT_ACCEPTABLE:
                return response()->json([
                    "msg"=>"location id is invalid"
                ],HttpStatusCodes::NOT_ACCEPTABLE);
            default:
                return Redirect("https://www.elixxi.com?referral_session_key_error=".$response->status(),HttpStatusCodes::TEMPORARY_REDIRECT);
        }
    }
}
