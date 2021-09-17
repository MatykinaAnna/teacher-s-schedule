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

	<link rel="stylesheet" href="../css/studentProfile/style2.css">
    <link rel="stylesheet" href="../css/main2.css">
    <link rel="stylesheet" href="../css/studentProfile/addLessons.css">
    <link rel="stylesheet" href="../css/studentProfile/calendar.css">
    <link rel="stylesheet" href="../css/studentProfile/messenger.css">
    <title>tutor_Phone</title>
</head>

<body>

	<div id="shedule" class="container">

		<div class="date">{{date}}</div>

		<div class="tableShedule" v-bind:style="{display: tableShedule_display}">

            <div>
				<div class="time">09:00</div>
                <div class="lesson" v-if="arrayLessons[0] == true">
                    <div>
                        {{arrayNameLessons[0]}}
                    </div>
                    <button v-on:click="deleteLesson"><img src="../img/del.svg"></button>
                </div>
			</div>
			<div>
				<div class="time">10:00</div>
                <div class="lesson" v-if="arrayLessons[1] == true">
                    <div>
                        {{arrayNameLessons[1]}}
                    </div>
                    <button v-on:click="deleteLesson"><img src="../img/del.svg"></button>
                </div>
			</div>
			<div>
				<div class="time">11:00</div>
                <div class="lesson" v-if="arrayLessons[2] == true">
                    <div>
                        {{arrayNameLessons[2]}}
                    </div>
                    <button v-on:click="deleteLesson"><img src="../img/del.svg"></button>
                </div>
			</div>
			<div>
				<div class="time">12:00</div>
                <div class="lesson" v-if="arrayLessons[3] == true">
                    <div>
                        {{arrayNameLessons[3]}}
                    </div>
                    <button v-on:click="deleteLesson"><img src="../img/del.svg"></button>
                </div>
			</div>
			<div>
				<div class="time">13:00</div>
                <div class="lesson" v-if="arrayLessons[4] == true">
                    <div>
                        {{arrayNameLessons[4]}}
                    </div>
                    <button v-on:click="deleteLesson"><img src="../img/del.svg"></button>
                </div>
			</div>
			<div>
				<div class="time">14:00</div>
                <div class="lesson" v-if="arrayLessons[5] == true">
                    <div>
                        {{arrayNameLessons[5]}}
                    </div>
                    <button v-on:click="deleteLesson"><img src="../img/del.svg"></button>
                </div>
			</div>
			<div>
				<div class="time">15:00</div>
                <div class="lesson" v-if="arrayLessons[6] == true">
                    <div>
                        {{arrayNameLessons[6]}}
                    </div>
                    <button v-on:click="deleteLesson"><img src="../img/del.svg"></button>
                </div>
			</div>
			<div>
				<div class="time">16:00</div>
                <div class="lesson" v-if="arrayLessons[7] == true">
                    <div>
                        {{arrayNameLessons[7]}}
                    </div>
                    <button v-on:click="deleteLesson"><img src="../img/del.svg"></button>
                </div>
			</div>
			<div>
				<div class="time">17:00</div>
                <div class="lesson" v-if="arrayLessons[8] == true">
                    <div>
                        {{arrayNameLessons[8]}}
                    </div>
                    <button v-on:click="deleteLesson"><img src="../img/del.svg"></button>
                </div>
			</div>
			<div>
				<div class="time">18:00</div>
                <div class="lesson" v-if="arrayLessons[9] == true">
                    <div>
                        {{arrayNameLessons[9]}}
                    </div>
                    <button v-on:click="deleteLesson"><img src="../img/del.svg"></button>
                </div>
			</div>
			<div>
				<div class="time">19:00</div>
                <div class="lesson" v-if="arrayLessons[10] == true">
                    <div>
                        {{arrayNameLessons[10]}}
                    </div>
                    <button v-on:click="deleteLesson"><img src="../img/del.svg"></button>
                </div>
			</div>
			<div>
				<div class="time">20:00</div>
                <div class="lesson" v-if="arrayLessons[11] == true">
                    <div>
                        {{arrayNameLessons[11]}}
                    </div>
                    <button v-on:click="deleteLesson"><img src="../img/del.svg"></button>
                </div>
			</div>

		</div>

        <component-a v-if="scrin == 2" v-on:choice="funcChoiceLesson"></component-a>

        <div class="timeOfLessons" v-if="scrin == 2">
            <div v-for = "time in freeTimes">
                <div v-for = "oneTime in time" v-on:click="funcChoiceTime">{{oneTime}}</div>
            </div>
        </div>

        <dialogue v-if="scrin == 3"></dialogue>

        <calendar v-if="scrin == 4"  v-on:choice="functionChoiceDate"></calendar>

        <div class="buttons">
            <button v-on:click="logout">
                <img src="../img/back.svg" style="margin-top: 7px">
            </button>

            <button v-on:click="addLessons">
                <img src="../img/add.svg">
            </button>

            <button v-on:click="dialogue">
                <img src="../img/dialogue.svg">
            </button>

            <button v-on:click="calendar">
                <img src="../img/calendar.svg">
            </button>
        </div>

	</div>



</body>

	<script src="../libs/vue.js"></script>
    <script src="../libs/axios.min.js"></script>
	<script type="module" src="../js/studentProfile/kode.js"></script>

</html>