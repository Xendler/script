<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Services\RandomOrgClient;
class GiveawayController extends Controller
{
    public function addusers(Request $request)
{
	
	
	
	$giveaway = \DB::table('giveaway')->where('giveaway.userid', '=', $this->user->id)->orderBy('id', 'desc')->get();

	if(!strstr($this->user->username, 'VENTUREFAST.RU')){
	$result =	response()->json([ 'success' => 'false', 'reason' => 'nickname']);	
	
	}else if($giveaway > NULL) {
		
$result =	response()->json([ 'success' => 'false', 'reason' => 'already_plays']);	
		
	}else {
	
	
$userid = htmlspecialchars_decode($this->user->id);
$givegame = \DB::table('givegame')->where('givegame.winner', '=', NULL)->orderBy('id', 'desc')->count();


	
\DB::table('giveaway')->insertGetId(
  ['userid' => $userid , 'giveawayid' => $givegame  ]
);

$result = $result =	response()->json([ 'success' => 'false', 'reason' => 'ok']);	

}
	
	return $result;





	
	
	
} 
   
   
   public function  get_giveaway_count(Request $request){
	   
	   
	  $giveaway = \DB::table('givegame')->join('giveaway', 'givegame.id', '=', 'giveaway.giveawayid')->orderBy('id', 'desc')
				->select('giveaway.id','giveaway.userid')->get();
	   
	   return 	count($giveaway);	
	   
   }
   
    public function get_giveaway_users(Request $request)
{
	
	
	
	
				$giveaway = \DB::table('givegame')->join('giveaway', 'givegame.id', '=', 'giveaway.giveawayid')->orderBy('id', 'desc')
				->select('giveaway.id','giveaway.userid')->take(13)->get();
	 
foreach($giveaway as $i){
		$user = User::find($i->userid);
	      $i->username = $user->username;
		$i->avatar = $user->avatar;
	}


	return 	 $giveaway ;
	
	
}
   

}
