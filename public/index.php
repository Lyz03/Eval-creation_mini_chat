<?php
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Eval mini chat</title>
</head>
<body>

<?php

$param = $_GET['p'] ?? null;

switch ($param) {
    case 'chat':
        require __DIR__ . '/../pages/chat.php';
        break;
    case 'form':
        require  __DIR__ . '/../utils/form-utils.php';
        break;
    default :
        require __DIR__ . '/../pages/connection.php';
        break;
}
?>

<script src="assets/js/app.js"></script>
<script src="assets/js/message.js"></script>
</body>
</html>
