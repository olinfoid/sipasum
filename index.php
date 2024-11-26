<?php 

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

if($uri == "/index.php"){
    require_once __DIR__.'/public/index.php';
}else if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}else{
    require_once __DIR__.'/public/index.php';
}

// phpinfo();


