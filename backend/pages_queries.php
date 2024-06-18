<?php
require_once fullPath('/database/connection.php');

function getPageIdByName($page_name)
{
    global $connection;
    $statement = $connection->prepare(
        "SELECT 
            page_id
        FROM pages
        WHERE page_name = :page_name"
    );

    $statement->bindValue(':page_name', $page_name);
    $statement->execute();

    $result = $statement->fetch();
    return $result['page_id'];
}