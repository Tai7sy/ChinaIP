<?php

include_once('class.chinaip.php');
$chinaip = new chinaip();

if(!isset($_POST['ip']))
{
	echo "Your Local IP address:";
	$ip = $chinaip->getIP();
}else{
    $ip = $_POST['ip'];
}

if($chinaip->inChina($ip))
{
	echo "<font color='blue'> $ip in China</font>";
}
else
{
	echo "<font color='red'> $ip not in China</font>";
}
?>
<form method="post">
Please input a ip address:
<input type="text" value="<?php echo $ip;?>" name="ip"> 
<Input type="submit" value="submit">
</form>
