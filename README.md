Laravel5-BattleNet-API
=========================== 
The Battle.net API uses OAuth 2.0, a federated access control mechanism, to help secure sections of the APIs that we provide out to the public. By using OAuth, you can let Battle.net handle the authentication process and receive a unique ID representing that user, then use an access token to gain access to allowed resources like their World of Warcraft characters, StarCraft II profile, or other data as appropriate. The usage of OAuth itself is relatively simple, but the flows can seem a little intimidating at first. Hopefully, by following the processes below, you can quickly integrate with Battle.net and worry more about building that cool idea and less about how to get data from players.

BattleNet oAuth just provide simple account information(battlenet account id, battlenet tag), Like this:

```php
{
    "id": XXXXXXXX,
    "battletag": "Maras#3218"
}
```

*Just support oauth and get authenticated user, and I will develop WOW and SC2 Game Data API in the future and welcome evenyone if you also love laravel and Blizzard join.

See official Github [Blizzard Github](https://github.com/Blizzard)
See official API Document [Battle.Net Developer](https://dev.battle.net/)

## Installation
將 package 加入 ```composer.json```  
Require the package in composer.json : 
```bash
"maras0830/laravel5-battlenet-api": "dev-master"
```
在 ``config/app.php``` 加入 providers  
In ```config/app.php``` add ```providers```
```php
Maras0830\BattleNetApi\Providers\ApiServiceProvider::class
```
In ```config/app.php``` add ```aliases```  
```php
'BattleNetApi'             => Maras0830\BattleNetApi\Facades\ApiServiceFacade::class,
```
發行設定  
Publish config.
```php
php artisan vendor:publish --force
```
發行後你在 config 資料夾下會發現 ```config/battlenet-api.php``` ，並且根據 [Battle.Net Developer](https://dev.battle.net/) 進行註冊與開發者配置
you will find config file after published, register abd set up by [Battle.Net Developer](https://dev.battle.net/)

```php
return [
    'region' => env('Battle_net_region', 'sea'),
    'api_url' => "https://". env('Battle_net_region', 'sea') .".api.battle.net",
    'api_url_cn' => "https://api.battle.com.cn/",
    'client_id' => env('Battle_net_client_id', ''),
    'client_secret' => env('Battle_net_client_secret', ''),
    'redirect_url' => env('APP_URL'). '/' .env('Battle_net_redirect_url', '') . '/battleNet/callback',
    'scopes' => [
        'wow.profile',
        'sc2.profile'
    ]
];
```
## USAGE
you can use authenticationURL on routes and controller, like this:

routes:
```php
Route::get('battleNet', 'auth\social\AuthController@redirectToProvider_BattleNet');
Route::get('battleNet/callback', 'auth\social\AuthController@handleProviderCallback_BattleNet');
```

```php
public function redirectToProvider_BattleNet()
{
    return redirect(BattleNetApi::authenticationURL()); // redirect to BattleNet login page
}
```

And callback function:
```php
public function handleProviderCallback_BattleNet()
{
    $social_type = "BattleNet";

    if (isset($_GET['code'])) {
        $code = $_GET['code'];

        $token = BattleNetApi::requestToken($code);

        $account = BattleNetApi::authenticatedUser($token);
    } else
        return redirect('/')->withErrors('failed.');

}
```

## OAuth 2.0
OAuth 2.0 is the next evolution of the OAuth protocol which was originally created in late 2006. OAuth 2.0 focuses on client developer simplicity while providing specific authorization flows for web applications, desktop applications, mobile phones, and living room devices. This specification is being developed within the IETF OAuth WG and is based on the OAuth WRAP proposal.

## HTTPS
One of the major changes to OAuth when releasing version 2.0 was removing transport considerations from the protocol, instead relying on implementors to handle the transport of codes and tokens themselves. What this means in practical terms is that HTTPS is required, and for extra security, checking the cert during the HTTPS handshake is recommended. This will prevent any surprises and will prevent the codes from being captured while in transit.
