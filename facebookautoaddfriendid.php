<?php
//[Dang Boi c0ding]

if(!file_exists($argv[1])){
  echo "\n\t usage : php $argv[0] list.txt \n";
}
$listid=file_get_contents($argv[1]);
$lid = trim($listid, "\n");
$ex=explode("\n",$lid);
foreach ($ex as $id){

//get token 
$cht = curl_init();
curl_setopt ($cht, CURLOPT_URL, "https://www.facebook.com/");
curl_setopt ($cht, CURLOPT_USERAGENT, "User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:53.0) Gecko/20100101 Firefox/53.0"); 
curl_setopt ($cht, CURLOPT_TIMEOUT, 60);
curl_setopt ($cht, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt ($cht, CURLOPT_AUTOREFERER, 1);
curl_setopt ($cht, CURLOPT_RETURNTRANSFER, 1);
$headers  = array();
$headers[] = 'Accept: */*';
$headers[] = 'Accept-Language: en-US,en;q=0.5';
$headers[] = 'Cookie: datr=your cookie fr=your cookie; sb=your cookie; wd=your cookie; locale=id_ID; c_user=your facebook id; xs=your cookie';
$headers[] = 'Connection: close';
$headers[] = 'Upgrade-Insecure-Requests: 1';
curl_setopt ($cht, CURLOPT_HTTPHEADER, $headers);
curl_setopt ($cht, CURLOPT_HEADER, 1);
$result = curl_exec ($cht);
curl_close($cht);
$getok = preg_match("/,{\"token\":\"(.*?)\"},/", $result, $hagetok);
$pregtok=array($hagetok[1]);
foreach($pregtok as $token){

// post data add friend
$postdata = 'to_friend='.$id.'&action=add_friend&how_found=profile_button&http_referer&floc=profile_button&frefs[0]=none&__a=1&__comet_req=false&fb_dtsg='.$token;
$ch = curl_init(); 
curl_setopt ($ch, CURLOPT_URL, "https://web.facebook.com/ajax/add_friend/action.php"); 
curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); 
curl_setopt ($ch, CURLOPT_TIMEOUT, 60); 
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata); 
curl_setopt ($ch, CURLOPT_POST, 1); 
$headers  = array();
$headers[] = 'Accept: */*';
$headers[] = 'Accept-Language: en-US,en;q=0.5';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Cookie: datr=your cookie; fr=your cookie; sb=your cookie; wd=your cookie; locale=id_ID; c_user=your facebook id; xs=your cookie; spin=your cookie; presence=your cookie';
curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt ($ch, CURLOPT_HEADER, 1);
$result = curl_exec ($ch);
curl_close($ch);

//check output
if(preg_match("/{\"success\":true}/",$result)){
echo "Anda telah berhasil menambahkan teman $id\n";
}
else{
echo "Anda gagal menambahkan teman $id\n";
echo "[1]Kemungkinan anda salah memasukan ProfileID\n";
echo "[2]Membatasi permintaan teman\n";
echo "[3]Teman sudah mencapai maksimal\n";
echo "[4]Sudah mengirimkan permintaan pertemanan\n";
echo "[5]Mungkin sudah berteman\n";
echo "[!5]Jika bukan salah satunya, kemungkinan anda wibu nolife!\n";
}
}
}
