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

    <link rel="stylesheet" href="../css/tutorProfile/style2.css">
    <link rel="stylesheet" href="../css/main2.css">
<!--    <link rel="stylesheet" href="../css/studentProfile/addLessons.css">-->
    <link rel="stylesheet" href="../css/tutorProfile/calendar.css">
    <link rel="stylesheet" href="../css/tutorProfile/students1.css">
    <link rel="stylesheet" href="../css/tutorProfile/messenger.css">
    <title>tutor_Phone</title>
</head>
<body>

    <div id="mainScreen" class="container">

        <div class="date">{{date}}</div>

        <div class="tableShedule" v-bind:style="{display: tableShedule_display}">

            <div>
                <div class="time">09:00</div>
                <div class="lesson" v-if="arrayLessons[0] == true">
                    <div>
                        {{arrayNameLessons[0][0]}}
                        <br>
                        {{arrayNameLessons[0][1]}}
                    </div>
                </div>
            </div>
            <div>
                <div class="time">10:00</div>
                <div class="lesson" v-if="arrayLessons[1] == true">
                    <div>
                        {{arrayNameLessons[1][0]}}
                        <br>
                        {{arrayNameLessons[1][1]}}
                    </div>
                </div>
            </div>
            <div>
                <div class="time">11:00</div>
                <div class="lesson" v-if="arrayLessons[2] == true">
                    <div>
                        {{arrayNameLessons[2][0]}}
                        <br>
                        {{arrayNameLessons[2][1]}}
                    </div>
                </div>
            </div>
            <div>
                <div class="time">12:00</div>
                <div class="lesson" v-if="arrayLessons[3] == true">
                    <div>
                        {{arrayNameLessons[3][0]}}
                        <br>
                        {{arrayNameLessons[3][1]}}
                    </div>
                </div>
            </div>
            <div>
                <div class="time">13:00</div>
                <div class="lesson" v-if="arrayLessons[4] == true">
                    <div>
                        {{arrayNameLessons[4][0]}}
                        <br>
                        {{arrayNameLessons[4][1]}}
                    </div>
                </div>
            </div>
            <div>
                <div class="time">14:00</div>
                <div class="lesson" v-if="arrayLessons[5] == true">
                    <div>
                        {{arrayNameLessons[5][0]}}
                        <br>
                        {{arrayNameLessons[5][1]}}
                    </div>
                </div>
            </div>
            <div>
                <div class="time">15:00</div>
                <div class="lesson" v-if="arrayLessons[6] == true">
                    <div>
                        {{arrayNameLessons[6][0]}}
                        <br>
                        {{arrayNameLessons[6][1]}}
                    </div>
                </div>
            </div>
            <div>
                <div class="time">16:00</div>
                <div class="lesson" v-if="arrayLessons[7] == true">
                    <div>
                        {{arrayNameLessons[7][0]}}
                        <br>
                        {{arrayNameLessons[7][1]}}
                    </div>
                </div>
            </div>
            <div>
                <div class="time">17:00</div>
                <div class="lesson" v-if="arrayLessons[8] == true">
                    <div>
                        {{arrayNameLessons[8][0]}}
                        <br>
                        {{arrayNameLessons[8][1]}}
                    </div>
                </div>
            </div>
            <div>
                <div class="time">18:00</div>
                <div class="lesson" v-if="arrayLessons[9] == true">
                    <div>
                        {{arrayNameLessons[9][0]}}
                        <br>
                        {{arrayNameLessons[9][1]}}
                    </div>
                </div>
            </div>
            <div>
                <div class="time">19:00</div>
                <div class="lesson" v-if="arrayLessons[10] == true">
                    <div>
                        {{arrayNameLessons[10][0]}}
                        <br>
                        {{arrayNameLessons[10][1]}}
                    </div>
                </div>
            </div>
            <div>
                <div class="time">20:00</div>
                <div class="lesson" v-if="arrayLessons[11] == true">
                    <div>
                        {{arrayNameLessons[11][0]}}
                        <br>
                        {{arrayNameLessons[11][1]}}
                    </div>
                    <button v-on:click="deleteLesson"><img src="../img/del.svg"></button>
                </div>
            </div>

        </div>

        <students v-if="scrin == 2" v-on:goToMsg="gotomsg"></students>

        <interested v-if="scrin == 3" v-on:add_students="add_students"></interested>

        <calendar v-if="scrin == 4"  v-on:choice="functionChoiceDate"></calendar>

        <dialogue v-if="scrin == 5" v-bind:id_student="collocutor"></dialogue>

        <div class="buttons">
            <button v-on:click="logout">
                <img src="../img/tutor/icon1.svg" style="margin-top: 7px">
            </button>

            <button v-on:click="studentScrin">
                <img src="../img/tutor/icon2.svg">
            </button>

            <button v-on:click="interestedScrin">
                <img src="../img/tutor/icon3.svg">
            </button>

            <button v-on:click="calendar">
                <img src="../img/tutor/icon4.svg">
            </button>
        </div>

    </div>

    <script src="../libs/vue.js"></script>
    <script src="../libs/axios.min.js"></script>
    <script type="module" src="../js/tutorProfile/kode2.js"></script>

</body>