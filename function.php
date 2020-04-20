<?php
function create_token (){

	$uni_code=md5(uniqid(rand(), true));
	$rand_code = bin2hex(random_bytes(8));
	$token=(string)$uni_code.$rand_code;
    return $token;
}

function test_input_sql ($value){
    if ($value==null) return null;
    //$value=preg_replace("([*+<>?()=]+)",'', $value);
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    $value=mysqli_real_escape_string($GLOBALS['link'],(string)$value);
    return $value;
}

function error($code){
    $ans='';
    switch ($code) {
        case '001': $ans="Command not found !";break;
        case '002': $ans="Command not match !";break;
        case '003': $ans="Need more informations!";break;
        case '004': $ans="Mysqli error >>>".mysqli_error($GLOBALS['link']);http_response_code(404);break;
        case '005': $ans="Username or password not correct !";break;
        case '006': $ans="API_key not correct !";break;
        case '007': $ans="Your device added befor!";break;
        case '008': $ans="Your device not found !";break;
        case '009': $ans="Fild error , select A or B.";break;
        case '010': $ans="Your dont have any device!";break;
        case '011': $ans="You dont have API_key! use [getApiKey] to generate API_key.";break;
        case '012': $ans="Your series has expired! it mast set to '9812' as default.";break;
        case '013': $ans="Name not found !";break;
        case '014': $ans="Not found Time Zone namber! it must between 0 to 583.";break;
        default : $ans="unknow error !";break;
    }
    echo json_encode(array('Result'=>'Error','Error' => array('Code' => $code,'Text'=>$ans)));
    die();
}


function read_uri_data($req_uri){
	$data_uri=array();
	$data_uri_temp = array();
	for($i=1,$j=0,$k=0;$i<mb_strlen($req_uri);$i++)
	{
		if($req_uri[$i]=='/')
		{
			$data_uri_temp[$j][$k+1]='';
			if($i<mb_strlen($req_uri)-1)$j++;
			$k=0;
		} 
		else if($req_uri[$i]=='?')
		{
			$data_uri_temp[$j][$k+1]='';
			break;
		}
		else
		{
			$data_uri_temp[$j][$k]=$req_uri[$i];
			$k++;
		}
	}
	$data_uri['conter']=$j+1;
	$j=0;
	while ($j<$data_uri['conter']) {
		$data_uri['Data'][$j]= implode($data_uri_temp[$j]);
		$j++;
	}
	return $data_uri;
}
?>



