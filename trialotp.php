<?php
// $url = 'http://49.50.67.32/smsapi/jsonapi.jsp';


// $data_array = array(
//     'username' => 'ratnagir',
//     "password" => "123123",
//     "from" => "MAHPOL",
//     "pe_id"=> "1601100000000004090",
//     "template_id" => "1607100000000120635",
//     "to" => '7715992305',
//     "text" => "This is testing for json data",
   
// );
// $data = http_build_query($data_array);
// $ch = curl_init();

// // set URL and other appropriate options
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// // grab URL and pass it to the browser
// $resp = curl_exec($ch);
// if($e = curl_error($ch)){
//     echo $e;
// }
// else{
//     $decoded = json_decode($resp);
//     // foreach($decoded as $key => $val){
//     //     echo $key . ':'.$val.'<br>';
//     // }
// }

// // close cURL resource, and free up system resources
// curl_close($ch);


 
// $url = "http://49.50.67.32/smsapi/jsonapi.jsp";   
// $contact = 7715992305;
// $username = 'tejas';
// $password = 12345;

// $passwordhash = password_hash($password, PASSWORD_DEFAULT);

// // $url = 'http://49.50.67.32/smsapi/httpapi.jsp?username=ratnagir&password=123123&from=MAHPOL&to=7715992305&text=username-'.$username.'.MAHPOL&pe_id=1601100000000004090&template_id=1607100000000120635';   
// $url = 'http://49.50.67.32/smsapi/httpapi.jsp?username=ratnagir&password=123123&from=MAHPOL&to='. $contact.'&text=username:-'.$username.',password:-'.$password.'.MAHPOL&pe_id=1601100000000004090&template_id=1607100000000120635';
// // $url = 'http://49.50.67.32/smsapi/httpapi.jsp?username=ratnagir&password=123123&from=MAHPOL&to='.$contact.'&text=OTP-'.$password.'.MAHPOL&pe_id=1601100000000004090&template_id=1607100000000120635';


// $ch = curl_init();   
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
// curl_setopt($ch, CURLOPT_URL, $url);   
// $res = curl_exec($ch);   
// echo $res;   

// function url(){
//     return sprintf(
//       "%s://%s%s",
//       isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
//       $_SERVER['SERVER_NAME'],
//       $_SERVER['REQUEST_URI']
//     );
//   }
  
//   $url = url();
//   echo $url;


// base directory
// $base_dir = __DIR__;

// // server protocol
// $protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';

// // domain name
// $domain = $_SERVER['SERVER_NAME'];

// // base url
// $base_url = preg_replace("!^${doc_root}!", '', $base_dir);

// // server port
// $port = $_SERVER['SERVER_PORT'];
// $disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";

// // put em all together to get the complete base URL
// $url = "${protocol}://${domain}${disp_port}${base_url}";

// echo $url;


//  echo "http://" . $_SERVER['SERVER_NAME'] ; 

// function url(){
//     if(isset($_SERVER['HTTPS'])){
//         $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
//     }
//     else{
//         $protocol = 'http';
//     }
//     return $protocol . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER["REQUEST_URI"].'?').'/';
// }

// $baseUrl = url()
// $nextYear =  date('Y', strtotime('+1 year'));
// echo $nextYear;
$operatorContact = 7715992305;
function maskPhoneNumber($number){
    
    $mask_number =  str_repeat("*", strlen($number)-4) . substr($number, -4);
    
    return $mask_number;
}


$contact = maskPhoneNumber($operatorContact)



?>
<!-- <input type="number" value="<?php echo $contact; ?>" name="" id=""> -->

<label for="" value=""><?php echo $contact; ?></label>
