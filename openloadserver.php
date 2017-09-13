<?php
error_reporting (0) ;
$video_id = $_POST['link'];
$apikey = $_POST['apikey'];
$passkey = $_POST['passkey'];
$video_idd = $_POST['videoid'];
$dticket = $_POST['ticketvalue'];
$capres = $_POST['captchavalue'];

if($dticket != null)
{
$datastep2 = file_get_contents("https://api.openload.co/1/file/dl?file=".$video_idd."&ticket=".$dticket."&captcha_response=".$capres);
$obj2 = json_decode($datastep2);	
//print_r ($obj1);
$stats1 =$obj2->status;
$resmsg1 =$obj2->msg;
$fname =$obj2->result->name;
$furl =$obj2->result->url;
$value3 =<<<EOT
<!DOCTYPE html> 
<link rel='stylesheet' href='style.css' type='text/css' media='all' /> 
<body bgcolor="cyan"> 
<center> 
<p>$fname</p>
<a href="$furl">Download </a>
</center>
</body>
<script> 
EOT;
	
echo $value3;	
	
}	
else if ($video_id != null) {

$datastep1 = file_get_contents("https://api.openload.co/1/file/dlticket?file=".$video_id."&login=".$apikey."&key=".$passkey);
$obj = json_decode($datastep1);
//print_r ($obj);
$stats =$obj->status;
$resmsg =$obj->msg;
$ticket =$obj->result->ticket;
$capurl =$obj->result->captcha_url;
$capw =$obj->result->captcha_w;
$caph =$obj->result->captcha_h;
if ($capurl != null)
{
	$iscaptcha = "block";
}
else {
    $iscaptcha = "none";
}
$value2 =<<<EOT
<!DOCTYPE html> 
<link rel='stylesheet' href='style.css' type='text/css' media='all' /> 
<body bgcolor="cyan"> 
<center> 
<img id="option2" style="display: $iscaptcha;"  width="$capw" height="$caph" src="$capurl">
<form action="openloadserver.php" method="POST"> 
  <input type="text" name="captchavalue"> 
  <input id="tktld" type="hidden" name="ticketvalue" value="$ticket">
  <input id="fid" type="hidden" name="videoid" value="$video_id">
 <br><br> 
  <input type="submit" value="Submit"> 
  <br><br> 
</form>
</center>
</body>  
</html>
EOT;

echo $value2;
}

else {
$value1 = <<<EOT

<!DOCTYPE html>

<link rel='stylesheet' href='style.css' type='text/css' media='all' />
<body bgcolor="cyan"><p style="text-align: right;">Server Version®</p>
<center>
<form action="openloadserver.php" name="transload" method="post" id="FORM_1">
	<table id="TABLE_2"> 
		<tbody id="TBODY_3"> 
			<tr id="TR_4"> 
				<td id="TD_5"> 
					 <b id="B_6">Openload File ID:</b><br id="BR_7" /> 
					<input type="text" name="link" id="INPUT_8" size="50" /><br id="BR_9" /><br id="BR_10" /> 
					<b id="B_11">Login Key:</b><br id="BR_12" /> 
					<input type="text" name="apikey" id="INPUT_13" size="50" /> 
					<b id="B_11">Password Key:</b><br id="BR_12" /> 
					<input type="text" name="passkey" id="INPUT_13" size="50" /> 
				</td> 
				<td id="TD_14"> 
					<input value="Generate" type="submit" id="INPUT_15" /> 
				</td> 
			</tr> 
	</tbody> 
					</table> 
			 
		 
</form>
</center>
</body> 
</html>
EOT;
echo $value1;
}
?>
