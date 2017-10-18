<?php
namespace Maras0830\BattleNetApi\Core;

use GuzzleHttp\Client;

/**
 * Class Authentication
 * @package Maras0830\BattleNetApi\Core
 */
class Authentication extends Base
{
    /**
     * @return string
     */
    public function authenticationURL()
    {
        $authorize_url = 'https://'.config('battlenet-api.region') . '.battle.net';
        $clientId = config('battlenet-api.client_id');
        $clientSecret = config('battlenet-api.client_secret');
        $scopes = implode('+', config('battlenet-api.scopes'));
        $redirectURL = config('battlenet-api.redirect_url');

        return $authorize_url . "/oauth/authorize?response_type=code&client_id=" . $clientId ."&client_secret=" . $clientSecret . "&redirect_uri=" . $redirectURL ."&scope=".$scopes;
    }

    /**
     * @param $code
     * @return mixed
     * @throws \Exception
     */
    public function requestToken($code)
    {
       $parameters = [
            'client_id' => config('battlenet-api.client_id'),
            'client_secret' => config('battlenet-api.client_secret'),
            'redirect_uri' => config('battlenet-api.redirect_url'),
            'code' => $code,
            'grant_type' => 'authorization_code'
        ];

        $token_url = 'https://'.config('battlenet-api.region') . '.battle.net/oauth/token';

        try {
            $client = new Client();

            $response = $client->request('POST', $token_url, ['form_params' => $parameters]);

            $response = json_decode($response->getBody()->getContents(), true);
            
            if (isset($response['access_token']))
                return $response['access_token'];

        } catch (\Exception $e) {

            throw $e;
        }
    }
}
