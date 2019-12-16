<?php
function sendgridMail($a_params,$a_settings=array(),$b_returnResponseOnSuccess=false){

	$config['sendgrid_api']	= array(
    'api_user' => 'everdev0923',
    'api_key' => 'P-*w$N#3yXez5wZ'
  );

  $a_curlParams = array_merge($a_params,count($a_settings) > 0 ? $a_settings : $config['sendgrid_api']);
  
  if(is_array($a_curlParams['to'])){
      if(count($a_curlParams['to']) == 1){
          $a_curlParams['to'] = $a_curlParams['to'][0];
      } else {
          $i_toHere = 0;
          foreach($a_curlParams['to'] as $s_toHere){
              $a_curlParams['to['.$i_toHere.']'] = $s_toHere;
              $i_toHere++;
          }
          unset($a_curlParams['to']);
      }
  }

  foreach($a_curlParams as $s_paramName => $s_paramValue){
      if(substr($s_paramName,0,6) == "files["){
          if(substr($s_paramValue,0,1) == "@"){
              $s_paramValue = substr($s_paramValue,1);
              if(file_exists($s_paramValue)){
                  $s_fileContent = file_get_contents($s_paramValue);
                  $a_curlParams[$s_paramName] = $s_fileContent;
              }
          }
      }
  }

  $ch = curl_init("https://api.sendgrid.com/api/mail.send.json");
  curl_setopt ($ch, CURLOPT_POST, true);
  // Tell curl that this is the body of the POST
  curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($a_curlParams));
  // Tell curl not to return headers, but do return the response
  curl_setopt($ch, CURLOPT_HEADER, false);
  // Tell PHP not to use SSLv3 (instead opting for TLS)
  curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$s_response = curl_exec ($ch);
  curl_close ($ch);
  
    $a_response = json_decode($s_response,true);
	if($a_response['message'] == "success"){
		return($b_returnResponseOnSuccess ? $a_response : true);
	} else {
		return($a_response);
	}
}