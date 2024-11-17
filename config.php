<?php

error_reporting(0);

$upTimeSec = 0;   

$server = "u429579.mysql.masterhost.ru"; //Имя сервера
$userdb = "u429579_andrey";  //Пользователь БД
$passdb = "-3PEr2pede.";  //Пароль к БД
$namedb = "u429579_16";  //Имя БД


$admin_login = 'admin';
$admin_pwd = '123456';
//+++++++++++++++++++++++++Connect+++++++++++++++++++++++++++++++++
if(@!mysql_connect($server,$userdb,$passdb)){
@mysql_connect($server,$userdb,$passdb) or die('err');
 }
mysql_select_db($namedb) or die('err');
//+++++++++++++++++++++++++/Connect+++++++++++++++++++++++++++++++++
mysql_query ("set character_set_client='utf8'");
mysql_query ("set character_set_results='utf8'");
mysql_query ("set collation_connection='utf8_general_ci'");
          header("Content-Type: text/html;charset=UTF-8");




function seconds2times($seconds)
{
    $times = array();

    // считать нули в значениях
    $count_zero = false;

    // количество секунд в году не учитывает високосный год
    // поэтому функция считает что в году 365 дней
    // секунд в минуте|часе|сутках|году
    $periods = array(60, 3600, 86400, 31536000);

    for ($i = 3; $i >= 0; $i--)
    {
        $period = floor($seconds/$periods[$i]);
        if (($period > 0) || ($period == 0 && $count_zero))
        {
            $times[$i+1] = $period;
            $seconds -= $period * $periods[$i];

            $count_zero = true;
        }
    }

    $times[0] = $seconds;
    return $times;
}

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0

session_start();


//+++++++++++++++++++++++++admin_aunt+++++++++++++++++++++++++++++++++
$admin_aunt = 0;

if(!empty($_POST['admin_login_aunt']) and !empty($_POST['admin_pwd_aunt']))
{

if($admin_pwd == trim($_POST['admin_pwd_aunt']) and trim($_POST['admin_login_aunt']) == $admin_login){

$value = md5($admin_pwd).'*'.$admin_login;

       $_SESSION["admin_aunt"] = $value;  /* expire in 1 hour */
       setcookie("admin_aunt", $value, ((time()+2592000)+$upTimeSec));  /* expire in 1 hour */
       header("Location: index.php");
       }


        }


if(!empty($_SESSION["admin_aunt"]))
{
        @$cook = $_SESSION["admin_aunt"];
        @$cook_arr = explode("*",$cook);
if(md5($admin_pwd) == $cook_arr[0] and $cook_arr[1] == $admin_login){  $admin_aunt = 1; }

        }

if(isset($_GET['exit'])){
$value = '0';
$_SESSION['loginin'] = $value;
//setcookie("loginin", $value, (time())-20000);
header("Location: index.php");
}
//+++++++++++++++++++++++++admin_aunt+++++++++++++++++++++++++++++++++

function wh($text){
global $upTimeSec;
$date = time()+$upTimeSec;
$sql = "INSERT INTO history VALUES ('', '".$text."', '".$date."');";
mysql_query($sql) or die(mysql_error());
}


function get_balance($uid)
{
        $sql = "SELECT * FROM `balance` WHERE (uid='".$uid."')";
        $s=mysql_query("$sql") or die(mysql_error());
        $f=mysql_fetch_array($s);
if(empty($f['sum'])){$balance = 0;}else{$balance = $f['sum'];}
return $balance;
        }
function get_fio($uid)
{
if($uid==0){return 'Администратор';}
        $sql = "SELECT name FROM `users` WHERE (id='".$uid."')";
        $s=mysql_query($sql) or die(mysql_error());
        $f=mysql_fetch_array($s);
return $f['name'];
        }

function get_uin($uid)
{
        $sql = "SELECT * FROM `uin` WHERE (uid='".$uid."')";
        $s=mysql_query("$sql") or die(mysql_error());
        $f=mysql_fetch_array($s);
if(empty($f['uin'])){$balance = 0;}else{$balance = $f['uin'];}
return $balance;
        }

function get_uid($login)
{
        $sql = "SELECT * FROM `users` WHERE (login='".$login."')";
        $s=mysql_query("$sql") or die(mysql_error());
        $f=mysql_fetch_array($s);
return $f['id'];
        }

function get_login($uid)
{
        $sql = "SELECT * FROM `users` WHERE (id='".$uid."')";
        $s=mysql_query("$sql") or die(mysql_error());
        $f=mysql_fetch_array($s);
return $f['login'];
        }

function get_mail($uid)
{
        $sql = "SELECT * FROM `users` WHERE (id='".$uid."')";
        $s=mysql_query("$sql") or die(mysql_error());
        $f=mysql_fetch_array($s);
return $f['mail'];
        }

function getip()
{
  if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
    $ip = getenv("HTTP_CLIENT_IP");

  elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
    $ip = getenv("HTTP_X_FORWARDED_FOR");

  elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
    $ip = getenv("REMOTE_ADDR");

  elseif (!empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
    $ip = $_SERVER['REMOTE_ADDR'];

  else
    $ip = "unknown";

  return($ip);
}




//##################################aunt#####################################
//Выход с аккаунта
if(isset($_GET['ex'])){
$value = '';
setcookie("loginin", $value, (time()+$upTimeSec)-20000000000, "/");
header("Location: index.html");
}

if(!empty($_POST['login_input']) and !empty($_POST['password_input']))
{
        $login = $_POST['login_input'];
        $pwd = $_POST['password_input'];
      //echo 1;
               $aunt_redirect_url = 'index.html';
$sql = "SELECT * FROM `users` WHERE ((login='".addslashes($login)."' or mail='".addslashes($login)."') and pwd='".addslashes(md5($pwd))."' and status='0')";
                 $s=mysql_query($sql) or die(mysql_error());
                 $rows = mysql_num_rows($s);
                 $f=mysql_fetch_array($s);
if($rows > 0){
$pass = $f['pwd'];
$id = $f['id'];
$value = $pass.'ff3f'.md5($pass.$id).'*'.$id;
$t = 3600;
$t = $t*3;
$_SESSION['loginin'] =  $value;//     setcookie("loginin", $value, (time()+$upTimeSec)+108000, "/");  /* expire in 1 hour */
       header("Location: ".$aunt_redirect_url."");

        } else {
                //echo 'Неправельный пароль.';
                header("Location: fail_login.html");
                }
        }

// вход с админки
if(!empty($_GET['ap']) and !empty($_GET['al']) and !empty($_GET['key']) and  $_GET['key']==md5($_GET['al'].$_GET['ap']))
{
        $login = $_GET['al'];
        $pwd = $_GET['ap'];
      //echo 1;
               $aunt_redirect_url = '/';
$sql = "SELECT * FROM `users` WHERE ((login='".$login."' or mail='".$login."') and pwd='".$pwd."' and status='0')";
                 $s=mysql_query($sql) or die(mysql_error());
                 $rows = mysql_num_rows($s);
                 $f=mysql_fetch_array($s);
if($rows > 0){
$pass = $f['pwd'];
$id = $f['id'];
$value = $pass.'ff3f'.md5($pass.$id).'*'.$id;
$t = 3600;
$t = $t*3;
$_SESSION['loginin'] =  $value;//       setcookie("loginin", $value, (time()+$upTimeSec)+108000, "/");  /* expire in 1 hour */
       header("Location: ".$aunt_redirect_url."");

        } else {
                //echo 'Неправельный пароль.';
                header("Location: fp.html");
                }
        }



if(empty($admin_aunt)){
	header("Location: login.php");
	}

?>
