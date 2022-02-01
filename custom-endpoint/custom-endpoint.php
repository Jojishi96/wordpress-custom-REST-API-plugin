<?php
/**
 * @package Custom REST API Endpoint
 * @version 1.0.0
 */
/*
Plugin Name: Custom REST API Endpoint
Description: 
Author: Jojishi96
Version: 1.0.0
*/

// GET custom endpoint functions based on the assignment
class LocalizeClass {

    public function get_server_time() {
        $D = exec('date /T');
        $T = exec('time /T');
        $DT = strtotime(str_replace("/","-",$D." ".$T));
        echo(date("Y-m-d H:i",$DT));
    }

    public function get_user_ip() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        
        // Check if IP is shared
        $user_ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        
        // Check if user is using proxy
        $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        
        } else {
        $user_ip = $_SERVER['REMOTE_ADDR'];
        
        }
        return apply_filters( 'wpb_get_ip', $user_ip );
    }

    public function get_user_location() {
        $userIP = $_SERVER['REMOTE_ADDR'];
         
        // Uncomment the next line for a different IP address result
        // $userIP = ''; 

        // API end URL 
        $apiURL = 'https://freegeoip.app/json/'.$userIP; 

        // Create a new cURL resource with URL 
        $ch = curl_init($apiURL); 

        // Return response instead of outputting 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

        // Execute API request 
        $apiResponse = curl_exec($ch); 

        // Close cURL resource 
        curl_close($ch); 

        // Retrieve IP data from API response 
        $ipData = json_decode($apiResponse, true); 

        if(!empty($ipData)){ 
            $latitude = $ipData['latitude']; 
            $longitude = $ipData['longitude']; 
        
            echo 'Latitude: '.$latitude.' '; 
            echo 'Longitude: '.$longitude; 
            
            } else { 
            
            echo 'IP data is not found!'; 
            } 
        }

}

function get_localize() {
        $result = new LocalizeClass;
        echo($result->get_server_time());
        echo " ";
        echo($result->get_user_ip());
        echo " ";
        echo($result->get_user_location());
}

// Initialize custom endpoints
add_action('rest_api_init', function() {
    register_rest_route('v1', 'localize', [
        'methods' => 'GET',
        'callback' => 'get_localize',
    ]);
});

?>
