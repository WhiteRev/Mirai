<?php
function cors($option = null)
{

    if ($option == 'json') {
        header('Content-Type: application/json');
    }

    if ($option == 'jsonp') {
        header('Content-Type: application/javascript');
    }

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        $http_origin = $_SERVER['HTTP_ORIGIN'];
    } else {
        $http_origin = '';
    }

    if (isset($_SERVER['HTTP_REFERER'])) {
        $http_referer = $_SERVER['HTTP_REFERER'];
    } else {
        $http_referer = '';
    }

    if (
        strstr($http_origin, "http://localhost:5000")) {

        if ($http_origin != '') {
            header("Access-Control-Allow-Origin: " . $http_origin);
        }

        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 0'); // cache
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0"); // Proxies.

        // Access-Control headers sont reçus au cours de la demande OPTIONS
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                header("Access-Control-Allow-Methods: GET, POST,PUT, DELETE, OPTIONS");
            }

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
            }

            exit(0);
        }
    } else {

        ob_start();
        print_r($_SERVER);
        $result = ob_get_clean();

        @mail("erwan@anime-store.fr", "ERR", $result);

        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 0'); // cache
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0"); // Proxies.

        // Access-Control headers sont reçus au cours de la demande OPTIONS
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                header("Access-Control-Allow-Methods: GET, POST,PUT, DELETE, OPTIONS");
            }

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
            }

            exit(0);
        }

        header("HTTP/1.1 403 Access Forbidden");
        header('Content-Type: application/json');
        $arr = array('success' => false, 'message' => 'Access Forbidden', 'code' => 10);
        echo json_encode($arr);
        exit();
    }
}

cors("json");

include '../includes/package.mysql.php';



$base = new Mysql();
$mysqli= $base->OuvrirBase();

$postdata = file_get_contents("php://input");

$R = json_decode($postdata);
$user = $R->email;
$new_password = $R->password;
$hashed_password = password_hash($new_password , PASSWORD_DEFAULT);

//$hashed_password =  mysql_escape_string($hashed_password);
$sql = "INSERT INTO `u_users` ( `username`, `email`, `password_hash`) VALUES ('$user', 'test@gmail.com', '$hashed_password')";
$mysqli->query($sql);
if (password_verify($password, $hashed_password)) {
    //if the password entered matches the hashed password, we're in
} else {
    // redirect to the homepage
}
$arr = array('success' => true, 'message' => 'ok', 'code' => 1);

echo json_encode($arr);
exit();


?>