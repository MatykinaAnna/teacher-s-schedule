<?php

    session_start();
    $connect = mysqli_connect('localhost', 'root', 'root', 'tutor');
    if (!$connect) {
        die('Error connect to DataBase');
    }

    $input_data = json_decode(file_get_contents('php://input'),true);
    $login = $input_data["login"];
    $password = md5($input_data["password"]);

    $sql = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");

    if (mysqli_num_rows($sql) > 0) {

        $user = mysqli_fetch_assoc($sql);

        if ($user['status']=='student'){
            $_SESSION['user'] = [
                "id" => $user['id'],
                "status" => 'student'
            ];

            $response = [
                "status" => true,
                "student" => true,
            ];
            echo json_encode($response);
        }
        else{
            $_SESSION['user'] = [
                "id" => $user['id'],
                "status" => 'tutor'
            ];

            $response = [
                "status" => true,
                "tutor" => true,
            ];
            echo json_encode($response);
        }

    } else {
        $response = [
            "status" => false,
            "message" => 'Не верный логин или пароль'
        ];
        echo json_encode($response);
    }

?>