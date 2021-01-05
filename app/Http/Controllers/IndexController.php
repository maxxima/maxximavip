<?php


namespace App\Http\Controllers;


use App\Constants\EnvironmentKeys;
use App\Constants\HttpStatusCodes;
use App\Constants\ReferralLocationIdentifiers;
use App\Services\MaxxApiServiceInterface;

class IndexController extends Controller
{
    private $maxxApiService;
    public function __construct(MaxxApiServiceInterface $maxxApiService){
        $this->maxxApiService = $maxxApiService;
    }

    public function referralRedirect(int $locationId,string $memberId)
    {
        $response = $this->maxxApiService->createReferralSession($memberId);
        $responseData = json_decode($response);
        $referralSessionKey = null;
        if($response->status() == HttpStatusCodes::OK){
            $referralSessionKey = $responseData->sessionKey;
        }
        switch($locationId){
            case ReferralLocationIdentifiers::ELIXXI:
                return Redirect('https://elixxi.com?referral_session_key='.$referralSessionKey,HttpStatusCodes::TEMPORARY_REDIRECT);
            default:
                return response()->json([
                    "msg"=>"invalid location identifier"
                ],HttpStatusCodes::BAD_REQUEST);
        }
    }
}
