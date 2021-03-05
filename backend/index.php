<?php

include_once './packages/router/Request.php';
include_once './packages/router/Router.php';
$router = new Router(new Request);


$router->get('/', function() {
  include "./midlewares/checkAuth.php";
  include "./controllers/home.controller.php";
});
$router->post('/add_contact',function ($request){
    include "./controllers/addContact.controller.php";
});
$router->post('/edit_contact',function ($request){
    include "./controllers/editContact.controller.php";
});
$router->post('/delete_contact',function ($request){
    include "./controllers/deleteContact.controller.php";
});
$router->get('/login', function($request) {
  include "./controllers/login.controller.php";
});
$router->get('/logout', function($request) {
  include "./controllers/logout.controller.php";  
});
$router->post('/auth', function($request) {
  include "./controllers/auth.controller.php";
  // auth($request);
});

$router->post('/data', function($request) {
  return json_encode($request->getBody());
});
?>