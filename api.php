<?php
header('Content-Type: application/json');
date_default_timezone_set('GMT');

include "httprequester.php";
include "function.php";
include "time_z.php";

$servername = "localhost";
$username = "USERNAME";
$password = "PASSWORD";
$dbname = "DB_NAME";

// connect to the mysql database
$link = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$link)die("Connection failed: " . mysqli_connect_error());
//mysqli_set_charset
mysqli_set_charset($link,'utf8');

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$data_uri=read_uri_data($_SERVER['REQUEST_URI']);
$input=json_decode(file_get_contents("php://input"),true);
if (!$input) $input = array();
$data = array('Methode' => $method,'Input'=>$input,'Get'=>$_GET,'Post'=>$_POST);

//echo json_encode($data);
//die();

$StringData=json_encode($data);

if($data_uri['conter']>1)$Command = $data_uri['Data'][1];
else error("001");

if($data_uri['conter']>2)$name=$data_uri['Data'][2];
else error("013");

if($Command=="save")
{
    $offset=0;
    if($data_uri['conter']>3)
    {
        $Czone=intval($data_uri['Data'][3]);
        if($Czone<0||$Czone>583)error("014");
        $offset = get_timezone_offset($time_zones[$Czone]);
    }
    $offset_time = time() - $offset;
    $t_value=date('20y-m-d H:i:s', $offset_time);

	$sql = "INSERT INTO log (name ,data ,dateTime) VALUES ('".$name."','".$StringData."','".$t_value."')";
	$result = mysqli_query($link,$sql);
	if (!$result) error("004");
	echo json_encode(array('Result'=>'Success','Msg'=>'OK'));
}
else if($Command=="read")
{
    $flen=0;
    if($data_uri['conter']>3)$flen=$data_uri['Data'][3];
    else $flen=100;

	$print=array();
	$sql = "SELECT * FROM log WHERE name='".$name."' ORDER BY ID DESC";
    $result = mysqli_query($link,$sql);
    if (!$result) error("004");
    $nRows=mysqli_num_rows($result);
    if(!$nRows)error("008");
    for($i=0;$i<$nRows;$i++)
    {
        if($i>=$flen)break;
    	$rows=mysqli_fetch_assoc($result);
    	$SData=json_decode($rows['data']);
    	$print[$rows['dateTime']]=$SData;
    }
    echo json_encode($print);
}
else error("002");
?>