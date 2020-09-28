<?php
ob_start();

include "include/header.php";
$vis = new register();
$r = $vis->fetchuser();
$r['id'];
if (isset($_GET['id'])) {
    $userid = $r['id'];
    $eventid = $_GET['id'];
    $vis = new register();
    $vis->visitor($userid, $eventid);

}

$msg = '';
if (isset($_POST['add'])) {

    $comment = $_POST['addComment'];
    $username = $_SESSION['username'];
    $commentse = new register();
    $r = $commentse->fetchEvent();
    $commentse = new register();
    $row = $commentse->selectUsers($username);
    if (isset($row['id'])) {
        if (isset($_GET['id'])) {
            $r['id'] = $_GET['id'];
            $eventid = $r['id'];
            $userid = $row['id'];
            $commentse = new register();
            $commentse->insertCommentEvent($comment, $userid, $eventid);
            $name = $username;
            $msg = 'Commented Your Event ';
            $nodifi = new register();
            $notifi->insertNotifications($name, $msg);

        }

    }

}

include "include\sidebar.php";

?>


<div class='col-md-9 side1' style='margin-top: 40px;' id='data'>



    <?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $singel = new register();
    $singel->singelEvent($id);
    $row = $singel->singelEvent($id);
    echo "


    <div class='card' style='margin-bottom: 15px;'>

        <img class='card-img' src='upload/{$row['event_image']}'
            alt='Card image cap' style='height:400px ;'>
        <div class='card-img-overlay '>
            <div class='auth'>
                <img src='upload/{$row['image']}' alt='Avatar' class='avatar'>
                <span>{$row['username']} </span>
                <small>13 Mins</small>
            </div>
        </div>
        <li class='list-group-item'>"?>
    <?php

    $eventid = $row['id'];
    $count = new register();
    $r = $count->countViewEvent($eventid);
    echo "
                <a class='add'>
                <i class='far fa-eye' style='margin-left: 20px;'></i> <span>{$r['nom']}</span>
                </a>";

    ?>



    <?php
$eventid = $row['id'];
    $countComments = new register();
    $r = $countComments->countCommentsEvent($eventid);
    echo "
            <a class='add'>
            <i class='fas fa-comments' style='margin-left:40px'> </i> <span>{$r['nom']}</span>
            </a>
            ";
    ?>
    <?php echo "
            <i class='fas fa-heart' style='margin-left: 55px;'></i> <span>15</span>
            <p id='attend'>Attend</p> <span style='display: inline;'>80</span>

            <a href='singel-event.php?userid={$row['user_id']}&id={$row['id']}' style='text-decoration: none;' title='About of Event'>
                <p class='event'>Attend</p>
            </a>
        </li>
        <div class='card-body'>
            <div class='book'><span class='date'>{$row['start_date']}</span> <span class='title'> {$row['title']} </span> <span
                    class='place'>
                    {$row['place']} <i class='fas fa-map-marker-alt' style='margin-left: 5px;'></i> </span></div>
            <p class='card-text'> {$row['content']}</p>

        </div>

    </div> ";} ?>



    <div id="map" style="width: 100%;height:400px;margin-bottom:100px"></div>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <script>
    var map;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 30.033333,
                lng: 31.233334
            },
            zoom: 8
        });
    }


    function initMap() {
        var myLatLng = {
            lat: 30.033333,
            lng: 31.233334
        };

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: myLatLng
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Cairo'
        });
    }
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-IwbMkxmGkRAMNNvBze5eL_q1q7GJLiA&callback=initMap">
    </script>





    <form action='#' method='post' class='form-horizontal' id='commentForm' role='form'>





        <div class='form-group'>


            <textarea style='padding-top: 5px;' class='form-control' name='addComment' id='addComment' rows='2'
                placeholder='Write Comment'></textarea>
            <button class='btn btn-success btn-sm' type='submit' name='add' id="submit">Add</button>

        </div>
    </form>



    <?php
$comments = new register();
$comments->selectCommentsEvent();
$rows = $comments->selectCommentsEvent();
if (!empty($rows)) {
    foreach ($rows as $row) {
        ?>


    <div class='show-comment'>
        <div class='form-group'>

            <h6 style='margin-left: 10px;'><?php echo $row['username'] ?></h6>
            <img src='upload/<?php echo $row['image'] ?>' alt='Avatar' class='avatar' style='margin-bottom: 10px;'>
            <span style='font-size:15px'> </span>
            <p class='p'><?php echo $row['content_comment'] ?></p>






        </div>

    </div>

    <?php
}

} else {
    $msg = "
    <div class='alert alert-danger ' role='alert' id='alert' >
      No Commentes In This Post!
    </div>
    ";
}
?>




    <h5 style="text-align:center;"><?php echo $msg; ?></h5>























    <?php include "include/footer.php"?>