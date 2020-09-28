<?php
ob_start();
session_start();
$_SESSION['username'];
include "classes\connectDB.php ";
require_once "classes/users.php";
///////////////////////////
$msg = '';

if (isset($_SESSION['username'])) {

    if (isset($_POST['post'])) {

        if (!empty($_POST['disc'])) {

            $username = $_SESSION['username'];
            $category = $_POST['category'];
            $disc = $_POST['disc'];
            $imagename = $_FILES['post-image']['name'];
            $imagetmp = $_FILES['post-image']['tmp_name'];
            $postimage = rand(0, 1000) . '_' . $imagename;
            move_uploaded_file($imagetmp, "upload\\" . $postimage);
            $post = new register();
            $row = $post->selectUsers($username);
            if (isset($row['id'])) {

                $userID = $row['id'];
                $post = new register();
                $post->insertPost($category, $disc, $postimage, $userID, $username);
                $name = $username;
                $msg = 'Post Added';
                $nodifi = new register();
                $notifi->insertNotifications($name, $msg);

            }

        } else {
            $msg = "
    <div class='alert alert-primary' role='alert'>
      Your Post Invalid!
    </div>

    ";

        }

    }
}

if (isset($_SESSION['username'])) {

    if (isset($_POST['create'])) {

        if (!empty($_POST['content'])) {

            $username = $_SESSION['username'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $date = $_POST['date'];
            $place = $_POST['place'];

            $imagename = $_FILES['event-image']['name'];
            $imagetmp = $_FILES['event-image']['tmp_name'];
            $eventimage = rand(0, 1000) . '_' . $imagename;
            move_uploaded_file($imagetmp, "upload\\" . $eventimage);
            $event = new register();
            $row = $event->selectUsers($username);
            if (isset($row['id'])) {

                $userID = $row['id'];
                $event = new register();
                $event->insertevent($title, $content, $eventimage, $date, $place, $userID);
                $name = $username;
                $msg = 'Event Added';
                $nodifi = new register();
                $notifi->insertNotifications($name, $msg);

            }

        } else {
            $msg = "
    <div class='alert alert-primary' role='alert'>
      Your event Invalid!
    </div>

    ";

        }

    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <title>Coder Zone</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!---- icon--->
    <link rel="stylesheet icon" href="image\FireShot Capture 025 - Coder Zone - localhost.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!----- jquery--->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <!---- fontAwsome--->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js"
        integrity="sha256-+Q/z/qVOexByW1Wpv81lTLvntnZQVYppIL1lBdhtIq0=" crossorigin="anonymous"></script>
    <!----------------------->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!------ jquery---->






    <script>
    $(function() {
        $("#search").keyup(function() {
            var someData = $("#search").val();
            var ByJson = {
                text: someData,
            };
            $.ajax({
                url: "search.php",
                type: "post",
                data: ByJson,

                erroe: function() {},
                success: function(any) {
                    $("#result").html(any);
                },
            });
            return false;
        });
    });
    </script>



</head>

<body>


    <!------------- start navbbar---->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="nav">
        <a class="navbar-brand" href="home.php">Coder <span class="zone">Zone</span> </a>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">



                <form class="form-inline d-flex justify-content-center md-form form-sm mt-0 search-form" method="POST">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input class="form-control form-control-sm ml-3 w-75 search" type="text"
                        placeholder="PHP,Nodejs,Json,JavaScript" aria-label="Search" id="search">
                </form>



            </ul>
            <ul class="navbar-nav" style="margin-right: 30px;">
                <!------------------------->
                <div class="dropdown" style="margin-top: 10px; margin-right:20px">
                    <a class="btn btn-defalut" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i> <span class="badge badge-danger count">0</span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">

                            <small><i></i></small>
                            </br>
                            <span style="font-weight: bold;color:red">
                            </span>
                            <span style="font-weight: bold;">
                            </span>
                        </a>
                        <div class="dropdown-divider"></div>



                    </div>
                </div>
                <!----------------->
                <li class="nav-item dropdown" style="margin-right: 15px;">

                    <a class='nav-link dropdown' href='#' id='navbarDropdown' role='button' data-toggle='dropdown'
                        aria-haspopup='true' aria-expanded='false'>

                        <?php
$username = $_SESSION['username'];
$header = new register();
$header->selectData($username);
$row = $header->selectData($username);

echo "

                    <h5 class='card-title'> <img src='upload/{$row['image']}' alt='Avatar' class='avatar'>
                         {$_SESSION['username']}
                    </h5>
                    ";?>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="profile.php"> <i class="fas fa-user-alt"></i> My Profile</a>
                        <a class="dropdown-item" href="profile-settings.php"> <i class="fas fa-cog"></i> Profile
                            Settings</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php"> <i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>

                <li>


                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#staticBackdrop" style="border-radius:10px;margin-top:15px">
                        <i class="fas fa-plus fa-sm">
                        </i> Post
                    </button>

                </li>
            </ul>
        </div>
        <h6 style="text-align: center; "><?php echo $msg; ?></h6>
    </nav>

    <!-- Modal: modalPoll -->

    <!-- Modal -->
    <div class="modal fade " id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 50px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"> Post Now</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" enctype="multipart/form-data">

                        <label> Your Section</label>
                        <select class="form-control form-control-sm" style="margin-bottom: 5px;" name="category">
                            <?php
$dashborad = new register();
$rows = $dashborad->selectCategory();
$nom = '';
if (!empty($rows)) {
    foreach ($rows as $row) {

        $nom++;
        ?>


                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>

                            <?php
}

}

?>


                        </select>
                        <div class="form-group">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"
                                placeholder="Write your discussion" name="disc"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Upload Image</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse… <input type="file" id="imgInp" name="post-image">
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <img id='img-upload' />
                        </div>
                        <div class="modal-footer">
                            <button style="margin-left: 100px;" type="button" class="btn btn-dark btn-sm"
                                data-toggle="modal" data-target="#loginModal" data-dismiss="modal">
                                Create Event
                            </button>
                            <button type='submit' class='btn btn-primary' name='post'> Publish</button></a>

                        </div>
                    </form>



                </div>


            </div>
        </div>
    </div>

    <!-- Modal: modalPoll -->


    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Post Event Now</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" enctype="multipart/form-data">

                        <section>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-8 col-lg-8 col-xl-6">

                                        <div class="row align-items-center">
                                            <div class="col mt-4">
                                                <input type="text" class="form-control" placeholder="title"
                                                    name="title">
                                            </div>
                                        </div>
                                        <div class="row align-items-center mt-4">
                                            <div class="col">
                                                <textarea type="text" class="form-control" placeholder="content"
                                                    name="content"></textarea>
                                            </div>
                                        </div>

                                        <div class="row align-items-center mt-4">
                                            <div class="col">
                                                <input type="date" class="form-control" name="date">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="place"
                                                    name="place">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Image</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-default btn-file">
                                                        Browse… <input type="file" id="imgInp" name="event-image">
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control" readonly>
                                            </div>
                                            <img id='img-upload' />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="create" class="btn btn-primary">Create</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <!----- end navbar-->