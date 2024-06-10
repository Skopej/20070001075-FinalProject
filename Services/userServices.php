<?php

include $_SERVER["DOCUMENT_ROOT"] . "/Database/database.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Database/Models/UserModel.php";



function addUser($userName, $userSurname ,$email, $password, $country, $city): UserModel
{
    global $mysqli;
    $query = "insert into user (userName, userSurname ,email, password, country, city)"
        . "values (?,?,?,?,?,?);";

    $mysqli->execute_query($query, [$userName, $userSurname ,$email, $password, $country, $city]);

    return new UserModel(
        $mysqli->insert_id,
        $userName,
        $userSurname,
        $email,
        $password,
        $country,
        $city
    );
}

function checkUser($email, $password): bool
{
    global $mysqli;
    $query = " select * from user where email = '$email' and password = '$password'";
    $result = $mysqli->execute_query($query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    }else{
        return false;
    }

}