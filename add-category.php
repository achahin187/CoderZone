<?php 


include "admin-include\admin-header.php"; 

/////////////////////////////
$msg='';
if(isset($_POST['add'])){
    if(!empty($_POST['category'])){

        $name=$_POST['category'];
        $category=new dashboard();
        $category->insertCategory($name);
        
        $msg="
        <div class='alert alert-danger ' role='alert' id='alert'>
          Category Added!
        </div>
        ";



    }else{

        $msg="
        <div class='alert alert-danger ' role='alert' id='alert' >
          Write category!
        </div>
        ";

    }
}
//////////////////////////////
if(isset($_GET['id'])){
$id=$_GET['id'];
$cate=new dashboard();
$cate->deleteCategory($id);
$msg="
<div class='alert alert-danger ' role='alert' id='alert' >
  Category Deleted!
</div>
";
}

?>


<div class="col-md-6 class1">

    <form method="POST" action="">

        <div class="form-group row">
            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Category</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-lg" id="colFormLabelLg" placeholder="Write Category"
                    name="category">
                <button class="btn btn-success btn-sm" id="add" type="submit" name="add">Add</button>
                <h4 style="text-align: center;"><?php echo$msg ?></h4>

            </div>
        </div>
    </form>

    <table class="table table-dark" id="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php 
$dashborad=new dashboard();
$rows=$dashborad->selectCategory();
$nom='';
foreach($rows AS $row){

    $nom++;
?>

            <tr>
                <th scope="row"><?php echo$nom ?></th>
                <td><?php echo$row['name'] ?></td>
                <td>
                    <a href="add-category.php?id=<?php echo$row['id'] ?>">
                        <button class="btn btn-danger btn-sm">Delete</button></a>

                </td>
            </tr>

            <?php
}

?>


        </tbody>
    </table>
</div>




















<?php include "admin-include\admin-footer.php" ?>