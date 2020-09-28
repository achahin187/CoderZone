<?php 
session_start();
$_SESSION['username'];
ob_start();
require_once "classes\dashboard.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <title>Admin</title>
    <!---fonts---->
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Noto+Serif:ital@0;1&display=swap"
        rel="stylesheet">
    <!-------->
    <link rel="stylesheet icon" href="image\cz (1).jpg">

    <!---css---->
    <link rel="stylesheet" href="css/dashboard.css" type="text/css">
    <!---------->
    <!----- icon--->

    <link rel="shortcut icon" href="img/icon.jpg">
    <!---bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!----->


    <!--- font awsome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!------------->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>




</head>


<body>

    <!---start navbar--->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home.php">Coder <span class="zone">Zone</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav  ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo$_SESSION['username'] ?></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i></a>
                </li>
            </ul>
        </div>
    </nav>
    <!---end navbar--->

    <!---start content-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2" id="side-area">
                    <h4>Dashboard</h4>
                    <ul class="side">
                        <li><a href="add-category.php">
                                <span><i class="fas fa-tags"></i></span>
                                <span>Categories</span>
                            </a>
                        </li>
                        <!----articles---->
                        <li data-toggle="collapse" data-target="#menu">
                            <a href="#">
                                <span><i class="fas fa-users"></i>

                                </span>
                                <span>Users</span>
                            </a>
                        </li>
                        <ul class="collapse" id="menu" class="menu">
                            <li>
                                <a href="posts.php">
                                    <span><i class="far fa-edit"></i>

                                    </span>
                                    <span>Posts</span>

                                </a>
                            </li>
                            <li>
                                <a href="dashboard-users.php">
                                    <span><i class="fas fa-users"></i>

                                    </span>
                                    <span>users</span>

                                </a>
                            </li>
                        </ul>
                        <!--------------------------------->

                        <li><a href="home.php">
                                <span> <i class="fas fa-home "></i></span>
                                <span>Home</span>
                            </a>
                        </li>
                        <li><a href="logout.php">
                                <span><i class="fas fa-sign-out-alt"></i>

                                </span>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>