<?php
$loader = require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Models\MessageModel;
 
$app = new Silex\Application();

$app['debug'] = true;

$app->get('/', function() {
    ob_start();
    include "../views/index.html";
    return ob_get_clean();
});

$app->post('/get_messages', function() {
    return MessageModel::getLastMessagesJSON();
});

$app->post('/add', function(Request $request) use ($app) {
    $message = $request->get('message');
    $user = $request->get('user');
    if (!$message) {
        return '{"status" : "error"}';
    }
    MessageModel::addMessage($user, $message);
    return '{"status" : "ok"}';
});

$app->run();
?>