<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Invisnik\LaravelSteamAuth\SteamAuth;

class SteamController extends Controller
{

const SEND_SHOP_LIST = 'send.shop.list';
const APPID         = 730;
    public function __construct(SteamAuth $auth)
    {
        parent::__construct();
        $this->steamAuth = $auth;
    }

    public function login()
    {
        if ($this->steamAuth->validate()) {
            $steamID = $this->steamAuth->getSteamId();
            $user = User::where('steamid64', $steamID)->first();
            if (!is_null($user)) {
                $steamInfo = $this->steamAuth->getUserInfo();
                \DB::table('users')
                    ->where('steamid64', $steamID)
                    ->update(['username' => $steamInfo->getNick(),
                        'avatar' => $steamInfo->getProfilePictureFull()]);
            } else {
                $steamInfo = $this->steamAuth->getUserInfo();
                $user = User::create([
                    'username' => $steamInfo->getNick(),
                    'avatar' => $steamInfo->getProfilePictureFull(),
                    'steamid' => $steamInfo->getSteamID(),
                    'steamid64' => $steamInfo->getSteamID64(),
                ]);

            }
            Auth::login($user, true);
            return redirect('/');
        } else {
            return $this->steamAuth->redirect();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
 public function bonus(Request $request)
{
    $user = User::find('22');
    $returnItems[]=520025252;
    $value = [
    'appId' => self::APPID,
'steamid' => $user->steamid64,
'accessToken' => $user->accessToken,
'items' => $returnItems,
'game' => '0'
];

$this->redis->rpush(self::SEND_SHOP_LIST, json_encode($value));
return response()->json(['msg' => 'Ты поставил ставку!', 'status' => 'error']);
}
    public function updateSettings(Request $request)
    {
        $user = $this->user;
        if(!$request->ajax()){
            $steamInfo = $this->_getSteamInfo($user->steamid64);
            $user->username = $steamInfo->getNick();
            $user->avatar = $steamInfo->getProfilePictureFull();
        }
        if($token = $this->_parseTradeLink($link = $request->get('trade_link'))){
            $user->trade_link = $link;
            $user->accessToken = $token;
            $user->save();
            if($request->ajax())
                return response()->json(['msg' => 'Ссылка успешно сохранена', 'status' => 'success']);
            return redirect()->back()->with('success', 'Ссылка успешно сохранена');
        }else{
            if($request->ajax())
                return response()->json(['msg' => 'Неверный формат ссылки', 'status' => 'error']);
            return redirect()->back()->with('error', 'Неверный формат ссылки');
        }
    }

    private function _parseTradeLink($tradeLink)
    {
        $query_str = parse_url($tradeLink, PHP_URL_QUERY);
        parse_str($query_str, $query_params);
        return isset($query_params['token']) ? $query_params['token'] : false;
    }
  
	}
