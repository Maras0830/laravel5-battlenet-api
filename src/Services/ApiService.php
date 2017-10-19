<?php
namespace Maras0830\BattleNetApi\Services;

use GuzzleHttp\Exception\ClientException;
use Maras0830\BattleNetApi\Core\Authentication;
use Maras0830\BattleNetApi\Core\Base;
use Maras0830\BattleNetApi\Core\Users;

class ApiService extends Base
{

    /*
     * AUTHENTICATION
     */

    /**
     * @return string
     */
    public function authenticationURL()
    {
        $authenticationAPI = new Authentication();

        return $authenticationAPI->authenticationURL();
    }

    /**
     * @param $code
     *
     * @return mixed
     * @throws \Exception
     */
    public function requestToken($code)
    {
        $authenticationAPI = new Authentication();

        return $authenticationAPI->requestToken($code);
    }

    /**
     * @param null $token
     *
     * @return json $user
     */
    public function authenticatedUser($token = null)
    {
        $token = $this->getToken($token);

        $usersAPI = new Users($token);

        return $usersAPI->authenticatedUser();
    }
}
