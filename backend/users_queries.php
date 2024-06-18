<?php
require_once fullPath('/database/connection.php');

function getUserByEmail($user_email)
{
    global $connection;
    $statement = $connection->prepare(
        "SELECT 
            user_types.type_name user_type,
            users.user_email,
            users.user_password,
            users.first_name,
            users.last_name
       FROM users
       INNER JOIN user_types ON user_types.user_type_id = users.user_type_id
       WHERE user_email = :user_email"
    );

    $statement->bindValue(':user_email', $user_email);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function createUser($user)
{
    var_dump($user);
    global $connection;
    $statement = $connection->prepare(
        "INSERT INTO users (
            user_type_id,
            user_email, 
            user_password, 
            first_name, 
            last_name
        ) VALUES (
            :user_type_id,
            :user_email, 
            :user_password, 
            :first_name, 
            :last_name
        )"
    );

    $statement->bindValue(':user_type_id', $user['user_type_id']);
    $statement->bindValue(':user_email', $user['user_email']);
    $statement->bindValue(':user_password', $user['user_password']);
    $statement->bindValue(':first_name', $user['first_name']);
    $statement->bindValue(':last_name', $user['last_name']);
    $statement->execute();

    return $connection->lastInsertId();
}