<?php
ob_start();

include "include/header.php";
//////////////////////////
$msg = '';

/////////////////////////////
if (isset($_GET['id'])) {
    $username = $_SESSION['username'];
    $user = new register();
    $rows = $user->selectUsers($username);
    $userid = $rows['id'];
    $post = new register();
    $r = $post->fetchPost();
    if (isset($r['id'])) {
        $postid = $_GET['id'];
        $favorit = new register();
        $favorit->addFavorites($postid, $userid);
        $name = $username;
        $msg = 'Added your post in Favorite';
        $nodifi = new register();
        $notifi->insertNotifications($name, $msg);

    }

}

include "include\sidebar.php";

?>



<!------------ event card ---->





<div class="col-lg-9  side1 " style="margin-top: 40px;" id="result">

    <?php
$post = new register();
$post->selectEvent();
$rows = $post->selectEvent();
if (!empty($rows)) {
    foreach ($rows as $row) {
        ?>
    <div class="card" style="margin-bottom: 15px;" id="result">

        <img class="card-img" src="upload/<?php echo $row['event_image'] ?>" alt="Card image cap"
            style="height:400px ;">
        <div class="card-img-overlay ">
            <div class="auth">
                <img src="upload/<?php echo $row['image'] ?>" alt="Avatar" class="avatar">
                <span><?php echo $row['username'] ?> </span>
                <small>20 Mins</small>
            </div>
        </div>
        <li class="list-group-item">
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
<a id='comment' href='#'  data-toggle='modal' data-target='.bd-example-modal-xl' >
<i class='far fa-comments' style='margin-left:40px'></i> <span>{$r['nom']}</span> Comments

       </a>

";
        ?>
            <i class="fas fa-heart" style="margin-left: 55px;"></i> <span>25</span>
            <p id="attend">Attend</p> <span style="display: inline;">12</span>

            <a href="singel-event.php?id=<?php echo $row['id'] ?>" style="text-decoration: none;"
                title="About of Event">
                <p class="event">Event</p>
            </a>
        </li>
        <div class="card-body">
            <div class="book"><span class="date"><?php echo $row['start_date'] ?></span> <span class="title">
                    <?php echo $row['title'] ?>
                </span> <span class="place">
                    <?php echo $row['place'] ?> <i class="fas fa-map-marker-alt" style="margin-left: 5px;"></i> </span>
            </div>
            <p class="card-text"><?php echo $row['content'] ?></p>


        </div>

    </div>

    <?php

    }

}

?>


    <?php
$post = new register();
$post->selectPost();
$rows = $post->selectPost();
if (!empty($rows)) {
    foreach ($rows as $row) {
        ?>
    <div class="card mb-3 ">
        <h5 class="card-title" style="margin: 5px;" id="result">

            <a href="profile-user.php?userid=<?php echo $row['user_id'] ?>" id="name">

                <img src="upload/<?php echo $row['image'] ?>" alt="Avatar" class="avatar">
                <span><?php echo $row['username'] ?> </span> </a> | <a href="#"
                style="color:blue;text-decoration: none;"><span><?php echo $row['category'] ?></span>
            </a>

        </h5>
        <img class="card-img-top" src="upload/<?php echo $row['post_image'] ?>" alt="Card image cap"
            style="height: 400px; ">
        <div class="card-body">

            <?php

        $postid = $row['id'];
        $countComments = new register();
        $r = $countComments->countComments($postid);
        echo "
<a id='comment' href='#'  data-toggle='modal' data-target='.bd-example-modal-xl' >
<i class='far fa-comments'></i> <span style='margin-left:3px'>{$r['nom']}</span> Comments

       </a>

";
        ?>
            <!----------------- add favouit ------>

            <?php

        $postid = $row['id'];
        $countComments = new register();
        $r = $countComments->countFavorites($postid);
        echo "

            <a href='home.php?id={$row['id']}' style='text-decoration: none;'>
            <button type='submit' name='add' class='btn btn-default btn-sm' id='heart'>
                <i class='fas fa-heart'></i></i> <span style='margin-left:3px'>{$r['nom']}</span>
            </button> </a> "?>
            <!-------------------------->

            <p style="display: inline; margin-left:10px"><i class="far fa-clock"></i>
                <span><?php echo $row['time'] ?></span></p>

            <p class="card-text"><?php echo $row['discussion'] ?>... <a
                    href="singel-post.php?id=<?php echo $row['id'] ?>" style="color:blue">See More</a>
            </p>
            <!------------------------------------------------->



            <!----------------------------------------------->
        </div>
    </div>

    <!---------------------------------------->


    <?php

    }

} else {

    $msg = "
                <div class='alert alert-danger ' role='alert' id='alert'  >
                  No Posts IN Home!
                </div>
                ";
}
?>
    <h5 style="text-align:center;"><?php echo $msg; ?></h5>










</div>
</div>
</div>









<?php include "include/footer.php"?>