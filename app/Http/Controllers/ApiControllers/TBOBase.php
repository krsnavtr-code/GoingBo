<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class TBOBase extends Controller
{
    /** Token storing directory */
    private const TOKEN_DIR = __DIR__ . "/tokens/TBO/";

    /** Log Directory */
    protected const LOG_DIR_General = __DIR__ . "/logs/TBO/";
    protected const LOG_DIR_Flights = __DIR__ . "/logs/TBO/flights/";
    protected const LOG_DIR_Hotels = __DIR__ . "/logs/TBO/hotels/";
    protected $log_id = "log_auth.txt";

    
    
    /** Shared Service URL For Flight */
    protected $username = "DELG738";
    protected $password = "Htl@DEL#38/G";
    // protected $password = "New@password#8";


    // /** Shared Service URL */
    // protected const SSU = "SharedServices/SharedData.svc/rest/";
    // protected const STATIC = "SharedServices/StaticData.svc/rest/";

    // /** TBO API base path */
    // protected const TBO = "http://api.tektravels.com/";
    // /** TBO ClientId */
    // protected const TEST_CLIENT_ID = "tboprod";

    /** Shared Service URL */
    protected const SSU = "SharedAPI/SharedData.svc/rest/";

    /** TBO API base path */
    protected const TBO = "https://api.travelboutiqueonline.com/";
    /** TBO ClientId */
    protected const TEST_CLIENT_ID = "tboprod";
    /** Token to use for tbo api call */
    protected $token = null;

    public function __construct()
    {
        if (!is_dir(self::LOG_DIR_General)) mkdir(self::LOG_DIR_General, 0777, true);
        if (!is_dir(self::TOKEN_DIR)) mkdir(self::TOKEN_DIR, 0777, true);
        $previous = self::restoreToken();
        $this->token = $previous['has_token'] ? $previous['token'] : self::auth();
        
    }

    /** Create Shared Services URL */
    protected function ssu($q)
    {
        return self::TBO . self::SSU . $q;
    }

    /** Create Shared Services URL */
    protected function static_url($q)
    {
        return self::TBO . self::STATIC . $q;
    }

    /** Merge params with default params */
    protected function bind_ip($params)
    {
        return $params + [
            "EndUserIp" => request()->ip(),
        ];
    }

    /** Return Default Shared Services params */
    protected function ssr_attr()
    {
        return self::bind_ip([
            "ClientId" => self::TEST_CLIENT_ID,
            "TokenAgencyId" => $this->token['Member']['AgencyId'],
            "TokenMemberId" => $this->token['Member']['MemberId'],
            "TokenId" => $this->token['TokenId'],
        ]);
    }

    /** Used to aunthicate to panel */
    private function auth()
    {
        $params = self::bind_ip([
            "ClientId" => self::TEST_CLIENT_ID,
            "UserName" => $this->username,
            "Password" => $this->password,
        ]);
        self::note_inlog("Request\n" . json_encode($params));
        $response = Http::post(self::SSU("Authenticate"), $params);
        $token = $response->json();
        self::note_inlog("Response\n" . json_encode($token));
        self::saveToken($token);
        return $token;
    }

    /** Getting balance of panel */
    public function getBalance()
    {
        return Http::post(self::ssu("GetAgencyBalance"), self::ssr_attr())->json();
    }

    /** Logging Out from api */
    private function logout()
    {
        return Http::post(self::ssu("Logout"), self::ssr_attr())->json();
    }

    /** Saving token details for further uses */
    private function saveToken($token)
    {
        $token['date'] = date("d");
        file_put_contents(self::TOKEN_DIR . $this->username, json_encode($token));
    }

    /** Getting Session if session exists */
    private function restoreToken()
    {
        if (is_file(self::TOKEN_DIR . $this->username)) {
            $token = json_decode(file_get_contents(self::TOKEN_DIR . $this->username), true);
            if ($token['date'] == date("d"))
                $res = ["token" => $token, "has_token" => true];
        }
        return $res ?? ["has_token" => false];
    }

    /** Writing in log */
    protected function note_inlog($d, $logType = 'general')
    {
        switch ($logType) {
            case 'flight':
                $logDir = self::LOG_DIR_Flights;
                break;
            case 'hotel':
                $logDir = self::LOG_DIR_Hotels;
                break;
            default:
                $logDir = self::LOG_DIR_General; // Define a general log directory
                break;
        }

        if (!is_file($logDir . $this->log_id)) {
            file_put_contents($logDir . $this->log_id, '');
        }
        $file = fopen($logDir . $this->log_id, 'a');
        fwrite($file, $d . "\n");
        fclose($file);
    }

    protected function note_inlog_flight($d)
    {
        $this->note_inlog($d, 'flight');
    }

    protected function note_inlog_hotel($d)
    {
        $this->note_inlog($d, 'hotel');
    }

}
