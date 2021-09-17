<?php
    session_start();
    $connect = mysqli_connect('localhost', 'root', 'root', 'tutor');
    if (!$connect) {
        die('Error connect to DataBase');
    }

    function get_students($connect){
        $students = [];
        $sql = mysqli_query($connect, "SELECT `id`, `full_name`, `phone`, `class1`, `inform`, `mat`, `phisic` FROM `users` where `status`='student' ORDER BY `users`.`full_name` ASC");
        //$sql = mysqli_query($connect, "SELECT `id`, `full_name`, `phone`, `class1`, `purpose`, `inform`, `mat`, `phisic` FROM `request`ORDER BY `request`.`full_name` ASC");

        for ($i=0; $i<mysqli_num_rows($sql); $i++){
            $students[$i] = mysqli_fetch_assoc($sql);
        }
        return ($students);
    }

    $response = [
        "students" => get_students($connect)
    ];

    echo json_encode($response);
?>