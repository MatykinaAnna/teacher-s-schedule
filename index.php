<?php
    session_start();

    if ($_SESSION['user']) {
        header('Location: http://tutorphon/studentProfile/index.php');
    }
?>



<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/main2.css">
	<link rel="stylesheet" href="css/style1.css">

    <title>tutor_Phone</title>
</head>

<body>

	<div id="formLog" class="container">

		<input v-model="log" class="input log" type="text" name="login" placeholder="Логин">

		<input v-model="pass" class="input pass" type="password" name="password" placeholder="Пароль">

		<span>{{error}}</span>

		<button v-on:click="send" type="submit" class="btn log">войти</button>

	</div>

</body>

	<script src="libs/vue.js"></script>
    <script src="libs/axios.min.js"></script>
	<script src="js/main1.js"></script>

</html>