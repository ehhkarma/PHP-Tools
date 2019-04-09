<?php

//have not vagina 

ini_set("memory_limit", -1);

$get=file_get_contents($argv[1]) 
or die("
\n\tError !
\n\tusage => php thisscriptname.php yourlist.txt\n\n");

$j=explode("\r\n",$get);
foreach($j as $text){

$x = preg_match_all('#[A-Z0-9a-z._%+-]+@[A-Za-z0-9.+-]+#',$text,$matches);
foreach (array_unique($matches[0]) as $a){
$vagina = $a."\n";
echo $vagina;
$fp = fopen("vagina.txt", 'a+');
	fwrite($fp,"$vagina");
	fclose($fp);
	}
}

?>
