<?php
/*
Plugin Name: Rus-to-Eng
Plugin URI: http://wordpress.org/extend/plugins/rus-to-eng/
Description: TRANSLATE russian words from post and term slugs to english, or, if Google service is anavaible convert cyrillic in latin. Useful for creating human-readable URLs. Work finely with Cyr-To-Lat
Author: FolkIdea: NeverLex http://neverlex.comRegexp: Sergey M. http://iskariot.ru && Kama http://wp-kama.ruFirst plugin: Pensioner http://1-sites.info
Version: 1.3
*/ 
function rte_sanitize_title($title){    $url = 'http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q='. urlencode($title) .'&langpair=ru%7Cen';    $translate = file_get_contents($url);    $json = json_decode($translate, true);    if ($json['responseStatus'] != 200)        return $title;    $result = $json['responseData']['translatedText'];     $result = htmlspecialchars_decode($result);    $result = stripslashes($result);    $result = preg_replace("~\W~", '-', $result);    $result = preg_replace('~-+~', '-', $result);    $result = trim($result, '-');	$result = strtolower($result);	    return $result;} if ( !empty($_POST) || !empty($_GET['action']) && $_GET['action'] == 'edit' || defined('XMLRPC_REQUEST') && XMLRPC_REQUEST ) {	add_action('sanitize_title', 'rte_sanitize_title', 0);	}
?>