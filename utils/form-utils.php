<?php

require __DIR__ . '/../Config.php';
require __DIR__ . '/../DB.php';

require __DIR__ . '/../Classe/User.php';
require __DIR__ . '/../Classe/UserManager.php';

use App\Classe\UserManager;

if (!isset($_GET['a'])) {
    header('Location: /index.php');
}

switch ($_GET['a']) {
    case 'connect':
        connect();
        break;
    case 'register':
        register();
        break;
    case 'disconnect';
        disconnect();
        break;
    default:
        header('Location: /index.php');
}

/**
 * sanitize POST content to create a new user
 */
function register() {
    if (!isset($_POST['submitRegister'])) {
        header('Location: /index.php');
        exit();
    }

    if (!isset($_POST['email'], $_POST['username'], $_POST['password'])) {
        header('Location: /index.php');
        exit();
    }

    $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $error = [];

    if (strlen($mail) < 8 || strlen($mail) >= 150) {
        $error[] = "l'adresse email doit faire entre 8 et 150 caractères";
    }

    if (strlen($_POST['username']) < 5 || strlen($_POST['username']) >= 100) {
        $error[] = "le pseudo doit faire entre 5 et 100 caractères";
    }

    if (strlen($password) < 8 || strlen($password) >= 255) {
        $error[] = "le mot de passe doit faire au moins 8 caractères";
    }

    if (count($error) > 0) {
        $_SESSION['error'] = $error;
        header('Location: /index.php');
        exit();
    }

    $userManager = new UserManager();

    if ($userManager->userExist($mail) !== null) {
        $_SESSION['error'] = ['adresse mail déjà enregistré'];
        header('Location: /index.php');
        exit();
    }

    if(!preg_match('/^(?=.*[!@#$%^&*-\])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
        $_SESSION['error'] = ["Le mot de passe n'est pas assez sécurisé"];
        header('Location: /index.php');
        exit();
    }

    if ($password === $_POST['passwordRepeat']) {

        $mail = filter_var($mail, FILTER_VALIDATE_EMAIL);

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $userManager->registerUser($mail, $username, $password);

        $user = $userManager->userExist($mail);
        $user->setPassword('');
        $_SESSION['user'] = $user;

        header('Location: /index.php?p=chat');

    } else {
        $_SESSION['error'] = ["Les mot de passe ne corespondent pas"];
        header('Location: /index.php');
        exit();
    }
}

function connect() {
    if (!isset($_POST['submitConnection'])) {
        header('Location: /index.php');
        exit();
    }

    if (!isset($_POST['email'], $_POST['password'])) {
        header('Location: /index.php');
        exit();
    }

    $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $error = [];
    if (strlen($mail) < 8 || strlen($mail) >= 150) {
        $error[] = "l'adresse email doit faire entre 8 et 150 caractères";
    }

    if (strlen($_POST['password']) < 8 || strlen($_POST['password']) >= 255) {
        $error[] = "le mot de passe doit faire entre 8 caractères";
    }

    $userManager  = new UserManager();
    $user = $userManager->userExist($mail);

    if ($user === null) {
        $error[] = "L'utilisateur demandé n'est pas enregistré";
    }

    if (count($error) > 0) {
        $_SESSION['error'] = $error;
        header('Location: /index.php');
        exit();
    }

    if (password_verify($_POST['password'], $user->getPassword())) {

        $user->setPassword('');
        $_SESSION['user'] = $user;

        header('Location: /index.php?p=chat');

    } else {

        $_SESSION['error'] = ['Adresse mail ou mot de passe incorrect'];
        header('Location: /index.php');
        exit();
    }
}

function disconnect() {
    $_SESSION = [];
    session_destroy();
    header('Location: /index.php');
}