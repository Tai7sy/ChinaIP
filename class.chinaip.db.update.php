<?php 
//$data = file_get_contents('delegated-apnic-latest.txt');
$data = file_get_contents('http://ftp.apnic.net/apnic/stats/apnic/delegated-apnic-latest');
$count = preg_match_all("/apnic\|CN\|ipv4\|([0-9\.]+)\|([0-9]+)\|[0-9]+\|a.*/",$data,$array);
for($m=array(),$i=0;$i<$count;$i++){
    $nowA = explode('.',$array[1][$i]);
    $nowA = reset($nowA)+0;
    if(!array_key_exists($nowA,$m)){
        $m[$nowA]=array();
    }
    $ipLong = ip2long($array[1][$i]);
    $ipCount = $array[2][$i];
    
    for($j=0,$find=false;$j<count($m[$nowA]);$j++){
        if($m[$nowA][$j][1]===$ipLong){
            $m[$nowA][$j][1] = $m[$nowA][$j][1]+$ipCount;
            $find = true; 
        }
    }
    if($find===false){//not found
        array_push($m[$nowA],array((int)$ipLong,(int)($ipLong+$ipCount)));
    }
}
$myfile = fopen("class.chinaip.db", "w");
fwrite($myfile, json_encode($m));
fclose($myfile);
echo 'updated !';
