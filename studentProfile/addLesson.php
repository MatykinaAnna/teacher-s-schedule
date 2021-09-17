<?php
session_start();

if (!$_SESSION['user']) {
    header('Location: http://tutorphon/index.php');
}
?>


<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../css/studentProfile/addLessons.css">
    <link rel="stylesheet" href="../css/main2.css">

    <title>tutor_Phone</title>
</head>

<body>

<div id="addLessons" class="container">

    <div class="date">{{date}}</div>

    <div class="buttonsLessons">
        <div class="math">математика</div>
        <div class="physics">физика</div>
        <div class="inform">информатика</div>
    </div>

    <div class="timeLessons">
        {{arrayTimeLessons}}
    </div>

    <div class="buttons">
        <a href = "index.php">
            <img src="../img/back.svg" style="margin-top: 7px">
        </a>

        <button><img src="../img/add.svg"></button>


        <img src="../img/dialogue.svg">
        <img src="../img/calendar.svg">
    </div>

</div>

</body>

<script src="../libs/vue.js"></script>
<script src="../libs/axios.min.js"></script>
<script src="../js/studentProfile/kode.js"></script>

</html>
