<?php
/*
Plugin Name: Star Wars Scroll
Plugin URI: 
Description: Put The Star Wars: A New Hope Opening Scroll on your website with the Shortcode [starwarsscroll]. Scroll comes from the Star Wars API http://swapi.co
Version: 0.1
Author: Crawford Vining (with help form Adam Burucs and his instagram plugin tutorial)
Author URI: http://crawpdx.com
*/

    //load font-awesome because it's awesome!
    function front_end_scripts() {
            wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
                }
        add_action( 'wp_enqueue_scripts', 'front_end_scripts' );
 
    // fix SSL request error
    add_action( 'http_request_args', 'no_ssl_http_request_args', 10, 2 );
    function no_ssl_http_request_args( $args, $url ) {
        $args['sslverify'] = false;
        return $args;
    }
 
    // register shortcode
    add_shortcode( 'starwarsscroll', 'starwars_embed_shortcode' );
     
    // define shortcode
    function starwars_embed_shortcode( $atts, $content = null ) {
    
    	$json_feed_url = 'http://swapi.co/api/films/1/?format=json';
    	
    	//https://api.instagram.com/v1/tags/avpbehindthescenes/media/recent?client_id=b2805c91adb443bba7b7fbf464f6a496
    	
    	//https://api.instagram.com/v1/tags/".$query."/media/recent?client_id=".$client;
    	
    	//https://api.instagram.com/v1/users/search?q=avpseniors&access_token=ACCESS-TOKEN
    	
    	//https://api.instagram.com/v1/users/self/feed?access_token=ACCESS-TOKEN
    	
    	//https://api.instagram.com/v1/users/55515556/media/recent/?client_id=b2805c91adb443bba7b7fbf464f6a496
    	
    	//https://api.instagram.com/v1/users/ID-GOES-HERE/media/recent/?access_token=TOKEN-GOES-HERE
        
        // define main output
        $str    = "";
        // get remote data
        $result = wp_remote_get( $json_feed_url, $args );
 
        if ( is_wp_error( $result ) ) {
            // error handling
            $error_message = $result->get_error_message();
            $str           = "Something went wrong: $error_message";
        } else {
            // processing further
            $result    = json_decode( $result['body'] );
            $main_data = array();
            //$n         = 0;
 
 			//$limit = 9;
 	
 			$title = $result->title;
 			$crawl = $result->opening_crawl;
 			
			echo '<h1><i class="fa fa-rebel"></i> '.$title.' </h1>';
			echo '<p> '.$crawl.' </p>';
			
			}
 
        return $str;
    }
    
    ?>
