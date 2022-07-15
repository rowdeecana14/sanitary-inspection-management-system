<?php
    session_start();
    define("APP_BASE_URL", "http://localhost/sanitary-inspection-management-system");
    define("APP_name", "sanitary-inspection-management-system");
    define("APP_API_URL", "/app/route/WebRoute.php");

    function isAuthenticate() {
        if(isset($_SESSION['SIMS_AUTH_USER'])) {
            header('Location: '.base_url().'/views/dashboard/');
        }
    }

    function notAuthenticate() {
        if(!isset($_SESSION['SIMS_AUTH_USER'])) {
            header('Location: '.base_url());
        }
    }
    
    function csrf() {
        $token = "";
        $vowels = 'aeou';
        $consonants = "bdghjmnpqrstvz";
        $number = '1234567890';

        for($i = 0; $i <= 100; $i++) {
            $token .= $consonants[rand() % strlen($consonants)];
            $token .= $vowels[rand() % strlen($vowels)];
            $token .= $number[rand() % strlen($number)];

            $token .= $consonants[rand() % strlen(strtoupper($consonants))];
            $token .= $vowels[rand() % strlen(strtoupper($vowels))];
            $token .= $number[rand() % strlen($number)];
        }

        $_SESSION['SIMS_TOKEN'] = $token;

        return $token;
    }   

    function auth_user() {
        if(!isset($_SESSION['SIMS_AUTH_USER']) && empty($_SESSION['SIMS_AUTH_USER'])) {
            return '';
        }

        return $_SESSION['SIMS_AUTH_USER'];
    }

    function token() {
        if(!isset($_SESSION['SIMS_TOKEN']) && empty($_SESSION['SIMS_TOKEN'])) {
            return '';
        }
		
        return $_SESSION['SIMS_TOKEN'];
	}

    function loginCount() {
        if(isset($_SESSION['SIMS_LOGIN_COUNT']) ) {
            $count = $_SESSION['SIMS_LOGIN_COUNT'];
            $_SESSION['SIMS_LOGIN_DATE'] = date('Y-m-d');
            $_SESSION['SIMS_LOGIN_COUNT'] = 2;

            return $count;
        }

        $_SESSION['SIMS_LOGIN_DATE'] = date('Y-m-d');
        $_SESSION['SIMS_LOGIN_COUNT'] = 2;
		
        return 1;
    }

    function base_url() {
        return constant("APP_BASE_URL"); 
    }

    function api_url() {
        return constant("APP_BASE_URL") . constant("APP_API_URL"); 
    }

    function image_url() {
        return constant("APP_BASE_URL") .'/public/assets/img/config/'; 
    }

    function upload_url() {
        return $_SERVER["DOCUMENT_ROOT"]."/".constant("APP_name")."/public/assets/img/uploaded/"; 
    }

?>