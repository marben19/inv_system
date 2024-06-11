<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

require_once('controller/User.php');

include __DIR__ . '/../vendor/autoload.php';

DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'inv_db';
DB::$encoding = 'utf8';


//http://159.223.58.80/phpmyadmin/

use Controller\User\User;


use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\RouteCollector;


$router = new RouteCollector();
$user = new User();


date_default_timezone_set('Asia/Manila');


#User.php
$router->post('mysystem/api/insert-image', fn() => $user->insert_image());
$router->get('mysystem/api/analytics', fn() => $user->analytics());
$router->get('mysystem/api/lists-locations', fn() => $user->lists_locations());
$router->post('mysystem/api/delete-product-location', fn() => $user->delete_product_location());
$router->post('mysystem/api/update-product-location', fn() => $user->update_product_location());
$router->post('mysystem/api/insert-to-location', fn() => $user->insert_to_location());
$router->post('mysystem/api/insert-product', fn() => $user->insert_product());
$router->get('mysystem/api/lists-products', fn() => $user->lists_products());
$router->post('mysystem/api/update-product', fn() => $user->update_product());
$router->get('mysystem/api/lists-transfered-products', fn() => $user->lists_transfered_products());



$router->get('mysystem/api/lists-of-logs', fn() => $user->lists_of_logs());
$router->post('mysystem/api/return-product', fn() => $user->return_product());
$router->get('mysystem/api/lists-of-transactions', fn() => $user->lists_of_transactions());
$router->post('mysystem/api/add-product-qty', fn() => $user->add_product_qty());
$router->post('mysystem/api/add-trans', fn() => $user->add_trans());
$router->post('mysystem/api/get-product', fn() => $user->get_product());
$router->get('mysystem/api/lists-trans', fn() => $user->lists_trans());
$router->post('mysystem/api/delete-product', fn() => $user->delete_product());



$router->post('mysystem/api/delete-student', fn() => $user->delete_student());
$router->post('mysystem/api/update-student', fn() => $user->update_student());
$router->post('mysystem/api/get-student', fn() => $user->get_student());
$router->get('mysystem/api/lists-student', fn() => $user->lists_student());
$router->post('mysystem/api/insert-student', fn() => $user->insert_student());
$router->post('mysystem/api/user-login', fn() => $user->login_user());
$router->post('mysystem/api/update-user', fn() => $user->update_user());
$router->post('mysystem/api/update-password', fn() => $user->update_password());
$router->post('mysystem/api/user-logout', fn() => $user->logout());

$router->post('mysysten/api/get-single-message', fn() => $user->get_single_message());
$router->post('mysysten/api/send-message', fn() => $user->send_message());
$router->post('mysysten/api/get-convo', fn() => $user->get_convo());
$router->post('mysysten/api/upload-profile-files', fn() => $user->upload_profile_files());


$router->post('mysysten/api/leave-class', fn() => $user->leave_class());
$router->post('mysysten/api/save-student-ass', fn() => $user->save_student_ass());
$router->post('mysysten/api/upload-ass-files/{id}', fn($id) => $user->upload_ass_files($id));
$router->post('mysysten/api/open-assignment', fn() => $user->open_assignment());
$router->post('mysysten/api/save-student-quiz', fn() => $user->save_student_quiz());
$router->post('mysysten/api/upload-quiz-files/{id}', fn($id) => $user->upload_quiz_files($id));
$router->post('mysysten/api/open-quiz', fn() => $user->open_quiz());
$router->post('mysysten/api/set-reading', fn() => $user->set_reading());
$router->post('mysysten/api/join-class', fn() => $user->join_class());
$router->post('mysysten/api/user-register', fn() => $user->register_user());

$router->get('mysysten/api/user-verify/{userid}', fn($userid) => $user->verify_user($userid));
$router->post('mysysten/api/user-logout', fn() => $user->logout());

$dispatcher = new Dispatcher($router->getData());
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
echo $dispatcher->dispatch($httpMethod, $uri), "\n";

    

?>