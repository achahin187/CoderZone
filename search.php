<?php
include "classes\connectDB.php ";
require_once "classes/users.php";
if (isset($_POST['text'])) {
    $category = $_POST['text'];
    $search = new register();
    $rows = $search->search($category);
    if (!empty($rows)) {
        foreach ($rows as $row) {
            ?>

<div class="card mb-3 ">
    <h5 class="card-title" style="margin: 5px;">

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

";?>
        <!----------------- add favouit ------>

        <?php

            $postid = $row['id'];
            $countComments = new register();
            $r = $countComments->countFavorites($postid);
            echo "

            <a href='home.php?id= {$row['id']} ' style='text-decoration: none;'>
            <button type='submit' name='add' class='btn btn-default btn-sm' id='heart'>
                <i class='fas fa-heart'></i></i> <span style='margin-left:3px'>{$r['nom']}</span>
            </button> </a> "?>
        <!-------------------------->

        <p style="display: inline; margin-left:10px"><i class="far fa-clock"></i>
            <span><?php echo $row['time'] ?></span></p>

        <p class="card-text"><?php echo $row['discussion'] ?>... <a href="singel-post.php?id=<?php echo $row['id'] ?>"
                style="color:blue">See More</a>
        </p>
        <!------------------------------------------------->



        <!----------------------------------------------->
    </div>
</div>


<?php
}
    } else {

        echo "
                    <div class='alert alert-danger ' role='alert' id='alert'  >
                    Found Nothing !
                    </div>
                    ";}

}