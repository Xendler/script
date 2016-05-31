/**
* Version 1.0.0
* Date: 17.10.2015 17:22
* Description: installer for twoFactor made by vk.com/ClockRide
*/

///////////////
//QUICK GUIDE//
///////////////
/*
First step:
1. Attach phone number to your account here: store.steampowered.com/account/. It needs to be unique
2. Put your login detailes and change installOn to false
3. Start bot
4. Bot will crash, you will get email from Steam and saved guardValue

Second step:
1. Get your auth code from email
2. Put it in authCode var
3. Change install to true
4. Start bot
5. Bot will stop working with saved security data for using Two-Factor system.
It will be in "saved_response.txt" file. Also you will receive SMS with confirmation code.

Third step:
1. Change smsVeri var to true
2. Change guardValue to contents of file "guard_value.txt"
3. Change smsCode to SMS verification code you just recieved. Dont left in INT, put code in
quotes to make sure its STRING.
4. Put your sharedKey from "saved_response.txt" file into sharedKey var. It also should be STRING.
5. Start your bot.
6. Bot will stop working in about 5 seconds.

END:
You just enabled Two-Factor system and received API data to use it!
*/
 
///////////
//CONFIGS//
///////////
var smsVeri                = true;//after second step change this to true
var installOn              = true;//if test mode false, if install true
var guardValue             = '76561198210895663||CA9D7F4CE808131A66BA781A2FF9E28F8EFF2A0A';//steam guard value from guard_value.txt after first step
var authCode               = 'DRF78';//authCode from email after first step
var smsCode                = '97559';//confirmation code after second step
var sharedKey              = 'CdqG8MdeQ3Msngvj0vPhIhtPls4=';// your shared key from saved_response.txt after second step
var logOnOptions           = {                                    
	"accountName" : "544t4t",
  	"password"    : "BABAY-03"
}
//////////////////
//END OF CONFIGS//
//////////////////



if(guardValue){
    logOnOptions['steamguard'] = guardValue;
} else logOnOptions['authCode'] = authCode;

//fs setup
var fs = require('fs');

//steam setup
var SteamCommunity = require('steamcommunity');
var community = new SteamCommunity();
community.constructor();

//login and enabling twoFactor
community.login(logOnOptions, function(err, sessionID, cookies, steamguard){
    //first step
    if(err) {console.log(err);return;}
    
    console.log("Steam Guard value is " + steamguard);
    fs.writeFile('guard_value.txt', steamguard, 'utf8');
    
    console.log("Setting cookies...");
    community.setCookies(cookies);
    //second step
    if(!smsVeri && installOn){
        community.enableTwoFactor(function(err, response){
            if(err){
                console.log(err);
                return;
            }
            fs.writeFile('saved_response.txt', JSON.stringify(response), 'utf8');
        });
    } else {
        //third step
        if(installOn){
            community.finalizeTwoFactor(sharedKey, smsCode, function(err, response2){
                if(err){
                    console.log(err);
                    return;
                }
                console.log("Successfully enabled Mobile auth! Response: " + response2);
            });
        }
    }
});

