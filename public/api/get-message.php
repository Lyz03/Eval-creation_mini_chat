<?php

use App\Manager\MessageManager;

require __DIR__ . '/../../Config.php';
require __DIR__ . '/../../DB.php';
require __DIR__ . '/../../Classe/Message.php';
require __DIR__ . '/../../Classe/User.php';
require __DIR__ . '/../../Classe/UserManager.php';
require __DIR__ . '/../../Classe/MessageManager.php';

session_start();

if (!isset($_SESSION['user'])) {
    http_response_code(403);
    exit;
}

$messageManager = new MessageManager();
$array = [];

foreach($messageManager->getAll() as $value) {
    $sent = false;
    if ($value->getUser()->getId() === $_SESSION['user']->getId()) {
        $sent = true;
    }

    $array[] = [
        'id' => $value->getId(),
        'content' => $value->getContent(),
        'dateTime' => $value->getDateSent()->format('D H:i:s'),
        'username' => $value->getUser()->getUsername(),
        'sent' => $sent,
    ];
}

echo json_encode($array);

http_response_code(200);
exit;

