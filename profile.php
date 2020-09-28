<?php

ob_start();

include "include/header.php";
//////////////////////
$msg = '';

if (isset($_GET['id'])) {
    $username = $_SESSION['username'];
    $user = new register();
    $rows = $user->selectUsers($username);
    $userid = $rows['id'];
    $post = new register();
    $r = $post->fetchPost();
    if (isset($r['id'])) {
        $userid = $rows['id'];
        $postid = $_GET['id'];

        $favorit = new register();
        $favorit->addFavorites($postid, $userid);
        $name = $username;
        $msg = 'Added your post in Favorite';

    }

}

//////////////////////////
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = new register();
    $delete->deletePost($id);

}

?>
<!------------------------->
<?php
include "include\sidebar.php";
?>
<!------------------->
<?php
$username = $_SESSION['username'];
$user = new register();
$user->selectData($username);
$row = $user->selectData($username);

echo "

<div class='col-md-9 side1' style='margin-top: 40px;'>
<div class='card mb-3' style='max-width: 540px; margin-bottom: 50px;'>
    <div class='row no-gutters'>
        <div class='col-md-4'>
            <img src='upload/{$row['image']}' class='card-img' alt='...'>
        </div>
        <div class='col-md-8'>
            <div class='card-body'>
                <h5 class='card-title'>{$_SESSION['username']} </h5>
        <p class='card-text'>{$row['bio']}</p>
        <p class='card-text'><small class='text-muted'>{$row['title']} </small></p>
    </div>
</div>
</div>
</div>
";
?>


<?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $post = new register();
    $post->selectPosts($username);
    $rows = $post->selectPosts($username);
    if (!empty($rows)) {
        foreach ($rows as $row) {
            ?>

<div class="card mb-3 " style="width:600px ;">

    <h5 class="card-title" style="margin: 5px;">


        <a href="profile.php" id="name">
            <img src="upload/<?php echo $row['image'] ?>" alt="Avatar" class="avatar">
            <span><?php echo $row['username'] ?></span> </a> | <a href="#"
            style="color:blue;text-decoration: none;"><span><?php echo $row['category'] ?></span>

        </a>


        <div id="edit">

            <a href="profile.php?id=<?php echo $row['id'] ?>">
                <button type="button" class="btn btn-danger btn-sm">
                    <i class="fas fa-times"></i>
                </button></a>
        </div>





    </h5>
    <img class="card-img-top" src="upload/<?php echo $row['post_image'] ?>" alt="Card image cap"
        style="height: 400px; ">
    <div class="card-body">

        <?php
$postid = $row['id'];
            $countComments = new register();
            $r = $countComments->countComments($postid);
            echo "
            <a class='add'>
            <i class='fas fa-comments'> </i> <span style='margin-left:3px'>{$r['nom']}</span> Comments
            </a>
            ";
            ?>
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



        <span style="font-size: 15px;"><i class="far fa-clock fa-sm"></i> <?php echo $row['time'] ?></span>

        <!-------------------------->


        <p class="card-text"><?php echo $row['discussion'] ?>... <a href="singel-post.php?id=<?php echo $row['id'] ?>"
                style="color:blue">See
                More</a>
        </p>

    </div>
</div>
<!------------------------->

<?php

        }

    } else {
        $msg = "
    <div class='alert alert-danger ' role='alert' id='alert'  >
      No Posts IN your Profile!
    </div>
    ";
    }
}

?>

<h5 style="text-align:center;"><?php echo $msg; ?></h5>






<!----------------------->
<!-- Button trigger modal -->





<?php include "include/footer.php"?>