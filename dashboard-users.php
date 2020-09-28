<?php include "admin-include\admin-header.php";
$msg='';
if(isset($_GET['id'])){

$id=$_GET['id'];
$post=new dashboard();
$post->deleteUsers($id);
$msg="
<div class='alert alert-danger ' role='alert' id='alert'>
  Post Deleted!
</div>
";


}



?>


<div class="col-md-6 class1">
    <h2 style="font-family:'Courier New', Courier, monospace; text-align:center">Users:</h2>

    <th scope="row"><?php echo$msg ?></th>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">UserName</th>
                <th scope="col">UserImage</th>
                <th scope="col">Bio</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Edit</th>

            </tr>
        </thead>
        <tbody>
            <?php
$users=new dashboard();
$users->selectUsers();
$rows=$users->selectUsers();
$nom='';
foreach($rows as $row){
$nom++;
?>
            <tr>
                <th scope="row"><?php  echo$nom ?></th>
                <td><?php  echo$row['username'] ?></td>
                <td><img src="upload/<?php echo$row['image'] ?>" style="width:100px; height:100px"></td>
                <td>

                    <textarea class="form-control rounded-0 " readonly id="exampleFormControlTextarea2" rows="5"
                        style="width: 200px;">
                        <?php echo$row['bio'] ?></textarea>


                </td>
                <td><?php echo$row['email'] ?></td>
                <td><?php echo$row['phone_number'] ?></td>
                <td>
                    <a href="posts.php?id=<?php echo$row['id'] ?>"> <button
                            class="btn btn-danger btn-sm">Delete</button>
                    </a>

                </td>

            </tr>



            <?php
}

?>

        </tbody>
    </table>







</div>




















<?php include "admin-include\admin-footer.php" ?>