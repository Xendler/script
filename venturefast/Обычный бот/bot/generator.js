var SteamTotp = require('steam-totp');

generatekey('BLQJuMz/ojlbQo3xnm1UHHjyU9A=');

function generatekey(secret)
{
    code = SteamTotp.generateAuthCode(secret);

    console.log('Generated Code : ' + code);
    
    return code;
}
