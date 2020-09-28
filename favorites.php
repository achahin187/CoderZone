<?php include "include/header.php";
$msg = '';
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $delete = new register();
    $delete->deleteFavorite($id);
    $name = 'You';
    $msg = 'Post Deleted';
    $nodifi = new register();
    $notifi->insertNotifications($name, $msg);

}
;

include "include\sidebar.php";
?>

<div class="col-md-9 side1" style="margin-top: 40px;" id="data">
    <h2 class="h2"> <span class="us">My</span> Favorites </h2>

    <div class="row row-cols-1 row-cols-md-2">
        <?php
if (isset($_SESSION['username'])) {

    $favorite = new register();
    $favorite->fetchFavorite();
    $rows = $favorite->fetchFavorite();
    $nom = '';
    if (!empty($rows)) {
        foreach ($rows as $row) {
            $nom++;
            ?>

        <div class="col mb-4">
            <div class="card">
                <img src="upload/<?php echo $row['post_image'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <textarea class="form-control rounded-0 " readonly id="exampleFormControlTextarea2" rows="3"
                        style="width: 200px;">
                        <?php echo $row['discussion'] ?></textarea>
                </div>
                <div class="card-footer">
                    <a href="singel-post.php?id=<?php echo $row['posts_id'] ?>" style="text-decoration: none;">
                        <button class="btn btn-success btn-sm">Go To The Post</button> </a>

                    <a href="favorites.php?del=<?php echo $row['id'] ?>&id=<?php echo $row['user_id'] ?>"> <button
                            class="btn btn-danger btn-sm">Delete</button></a>
                    <?php
$postid = $row['posts_id'];
            $countComments = new register();
            $r = $countComments->countComments($postid);
            echo "
    <a class='add'>
    <i class='fas fa-comments'> </i> <span style='margin-left:3px'>{$r['nom']}</span>
    </a>
    ";
            ?>
                </div>
            </div>
        </div>



        <?php
}

    } else {

        $msg = "
                <div class='alert alert-danger ' role='alert' id='alert'  >
                  No Posts IN Favorites!
                </div>
                ";
    }

}
?>

        <h5 style="text-align:center;"><?php echo $msg; ?></h5>

    </div>



    <?php include "include/footer.php"?>