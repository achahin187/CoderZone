<?php
ob_start();

include "include/header.php";
////////////////////////
$msg = '';

if (isset($_GET['uid'])) {
    $username = $_SESSION['username'];
    $user = new register();
    $rows = $user->selectUsers($username);
    $userid = $rows['id'];
    $userid = $rows['id'];
    $postid = $_GET['uid'];
    $favorit = new register();
    $favorit->addFavorites($postid, $userid);
    $msg = "
        <div class='alert alert-danger ' role='alert' id='alert' >
          Post Added To Favorite!
        </div>
        ";

}

/////////////////////////////

if (isset($_POST['add'])) {
    $comment = $_POST['comment'];
    $username = $_SESSION['username'];
    $comments = new register();
    $r = $comments->fetchPost();
    $comments = new register();
    $row = $comments->selectUsers($username);
    if (isset($row['id'])) {
        if (isset($_GET['id'])) {
            $r['id'] = $_GET['id'];
            $postid = $r['id'];
            $userid = $row['id'];
            $comments = new register();
            $comments->insertComment($comment, $userid, $postid);
            $name = $username;
            echo "Comment Added!";

        }
    }
}

?>


<!------------------------->
<?php include "include\sidebar.php";
?>
<!------------------->
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $singel = new register();
    $singel->singelPost($id);
    $row = $singel->singelPost($id);
    echo "


<div class='col-md-9 side1' style='margin-top: 40px;' id='data'>
<div class='card mb-3'>

    <img class='card-img-top'
        src='upload/{$row['post_image']}' alt='Card image cap'
        style='height: 400px; '>
    <h5 style='margin: 5px;' class='h5'> <img src='upload/{$row['image']}' alt='Avatar' class='avatar'>
        <span>{$row['username']}</span>
    </h5>
    <div class='card-body'>
    ";?>

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

<?php

    $postid = $row['id'];
    $countComments = new register();
    $r = $countComments->countFavorites($postid);
    echo "

    <a href='home.php?id= {$row['id']} ' style='text-decoration: none;'>
    <button type='submit' name='add' class='btn btn-default btn-sm' id='heart'>
        <i class='fas fa-heart'></i></i> <span style='margin-left:3px'>{$r['nom']}</span>
    </button> </a> "?>



<?php
echo "
<a href='#'><i class='far fa-clock'></i> <span>{$row['time']}</span></a>

<p class='card-text'> {$row['discussion']}</p>
<div class='tab-pane'>
    ";
}
?>


<form action='#' method='post' class='form-horizontal' role='form'>
    <div class='form-group'>
        <textarea style='padding-top: 5px;' class='form-control' name='comment' rows='2'
            placeholder='Write Comment'></textarea>

        <button class='btn btn-success btn-sm' type='submit' name='add' id="add">Add</button>

    </div>
</form>
</div>

<!------------------------------>
<?php
$comments = new register();
$comments->selectComments();
$rows = $comments->selectComments();
if (!empty($rows)) {
    foreach ($rows as $row) {
        ?>


<div class='show-comment'>
    <div class='form-group'>

        <h6 style='margin-left: 10px;' id="h6"><?php echo $row['username'] ?></h6>
        <img src='upload/<?php echo $row['image'] ?>' alt='Avatar' class='avatar' style='margin-bottom: 10px;' id="img">
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

</div>
</div>
</div>









</div>

<?php include "include/footer.php"?>