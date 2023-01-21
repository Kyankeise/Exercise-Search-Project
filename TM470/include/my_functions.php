<?php

// clean user input before updating
// --------------------------------

	function clean_input($input) {
		$input = trim($input);
		$input = htmlspecialchars( $input, ENT_QUOTES );
	    return $input = "'" . ($input) . "'";
	}


// clean database value before displaying
// --------------------------------------

	function clean_output($input) {
		$input = htmlspecialchars_decode( $input, ENT_QUOTES);
		$input = html_entity_decode( $input, ENT_QUOTES );
		return $input ;
	}


// generate random characters
// --------------------------
    function randomkeys($length)  {
    
        $chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $clen   = strlen( $chars )-1;
        $id  = '';

        for ($i = 0; $i < $length; $i++) {
            $id .= $chars[mt_rand(0,$clen)];
        }
        return ($id);
    }
  

// validate user
// -------------

    function is_valid_user() {

    global $db;

        if ( !empty($_COOKIE[ COOKIE_NAME ]) ) {

            $hash_key = $_COOKIE[ COOKIE_NAME  ];
            $query = sprintf("SELECT user_id, user_name, user_access_key, user_access_group FROM user WHERE user_hash_key=%s",clean_input( $hash_key ) );
            $result = $db->query($query);
            if (count($result) > 0 ) {
            $vuser['id']    = $result[0]->user_id;
            $vuser['user']  = $result[0]->user_name;
            $vuser['group'] = $result[0]->user_access_group;
            $vuser['access']= $result[0]->user_access_key;
            return $vuser;
            exit;
            }

            $site = SITE_URL;
            header( "Location: $site" );
            exit;
        }

    }

// Load template file, put errors into file and display
// ----------------------------------------------------

function displayError ( $error ) {
	
    $file = file_get_contents( TMPL_ERROR );
    $file = str_replace( '@@errors@@', $error, $file);
    echo $file;
}

// Encrypt data - GDPR shite
// -------------------------

function secured_encrypt($data) {
	
    $first_key = base64_decode(KEY1);
    $second_key = base64_decode(KEY2);   
    
    $method = "aes-256-cbc";   
    $iv_length = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($iv_length);
        
    $first_encrypted = openssl_encrypt($data,$method,$first_key, OPENSSL_RAW_DATA ,$iv);   
    $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
            
    $output = base64_encode($iv.$second_encrypted.$first_encrypted);   
    return $output;       
}

// decrypt data - GDPR shite
// -------------------------

function secured_decrypt($input) {
    $first_key = base64_decode(FIRSTKEY);
    $second_key = base64_decode(SECONDKEY);           
    $mix = base64_decode($input);
        
    $method = "aes-256-cbc";   
    $iv_length = openssl_cipher_iv_length($method);
          
    $iv = substr($mix,0,$iv_length);
    $second_encrypted = substr($mix,$iv_length,64);
    $first_encrypted = substr($mix,$iv_length+64);
          
    $data = openssl_decrypt($first_encrypted,$method,$first_key,OPENSSL_RAW_DATA,$iv);
    $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
      
    if (hash_equals($second_encrypted,$second_encrypted_new))
      return $data;
      
    return false;
}
?>
