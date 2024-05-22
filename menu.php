<?php
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <script src="js/global.js"></script>
    <style>
        #header {
            position: fixed;
            /* background: rgb(255, 0, 0); */
            width: 100vw;
            height: 8vh;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #container {
            margin: 0 auto;
            width: 100%;
            min-height: 100vh;
            background: #135D66;
            display: flex;
            flex-flow: row;
            align-items: center;
            justify-content: space-evenly;
        }

        #management,
        #billing {
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            font-style: bold;
            text-align: center;
            transition: ease-out 0.5s;
            cursor: pointer;
        }

        #management:hover,
        #billing:hover {
            transform: scale(1.1);
            transition: ease-in 0.5s;
        }

        #icon1,
        #icon2 {
            display: flex;
            background: #ffffff;
            width: 23.0vw;
            height: 37.3vh;
            border-radius: 30px;
            align-items: center;
            justify-content: center;
        }

        img {
            width: 12.5vw;
            height: 25.7vh;
        }

        #title1,
        #title2 {
            color: #ffffff;
            margin-top: 33px;
            font-size: 1rem;
        }

        .timendate {
            color: white;
        }
    </style>
    <title>Menu</title>
</head>

<body>

    <div id="header">
        <div id="userbox">
            <div class="profileimage">
                <img class="userprofile" src="images/User1.png" alt="profile" draggable="false">
                <img class="changeprofile" src="images/changeprofile.png" alt="changeprofile">
            </div>
            <div id="profilename">
                <div id="usernamebox">
                    <p id="username">
                        Username
                    </p>
                    <img class="userdropdown" src="images/downnicon.png" alt="profiledropdown" draggable="false" onclick="">
                </div>
                <p id="userposition">
                    Admin
                </p>
            </div>
        </div>
        <div class="timendate">
            <p class="datime"></p>
            <p class="dadate"></p>
        </div>
    </div>
    <div id="container">
        <div id="management" onclick="managementPage()">
            <div id="icon1">
                <img src="images/Union.png" alt="managementIcon" draggable="false">
            </div>
            <div id="title1">
                <h1> MANAGEMENT </h1>
            </div>
        </div>
        <div id="billing" onclick="billingPage()">
            <div id="icon2">
                <img src="images/Subtract.png" alt="billinIcon" draggable="false">
            </div>
            <div id="title2">
                <h1> POS </h1>
            </div>
        </div>
    </div>
    <script>
        function managementPage() {
            location.href = "dashboard.php";
        }

        function billingPage() {
            location.href = "billing.php";
        }
    </script>
</body>

</html>