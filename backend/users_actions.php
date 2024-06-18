<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/volta-ao-mundo-australia/helpers/full-path.php';
require_once fullPath('backend/users_queries.php');

define('DEFAULT_USER_TYPE_ID', '2');

if (!isset($_SESSION)) {
    session_start();
}
switch ($_POST['action']) {
    case 'sign_up':
        $user = [
            'user_email'    => $_POST['email'],
            'user_type_id'  => DEFAULT_USER_TYPE_ID,
            'user_password' => hash('sha256', $_POST['password']),
            'first_name'    => $_POST['first_name'],
            'last_name'     => $_POST['last_name'],
        ];

        $user_id = createUser($user);

        $_SESSION['user_id']         = $user_id;
        $_SESSION['user_type']       = 'user';
        $_SESSION['user_first_name'] = $user['first_name'];
        $_SESSION['user_last_name']  = $user['last_name'];

        header("Location: /volta-ao-mundo-australia/views/pages/home.php");
        exit();

        break;

    default:
        $error_message = 'Invalid action informed: action = ' . $_POST['action'];
        return $error_message;
}
