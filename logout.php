<?PHP
    require("top.php");
    
    unset($_SESSION["user_id"]);
    unset($_SESSION["email"]);
    unset($_SESSION["first_name"]);
    
    session_destroy();
    
    header( 'Location: ' . LOGIN_PAGE ) ;
    exit;
