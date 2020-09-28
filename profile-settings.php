<?php
ob_start();

include "include/header.php";
include "include\sidebar.php";

/////////////////////////////////////
if(isset($_SESSION['username'])){

    if(isset($_POST['save'])){


        $username=$_SESSION['username'];
        $phone=$_POST['phone'];
        $title=$_POST['title'];
        $bio=$_POST['bio'];
        $imageName=$_FILES['image']['name'];
        $imagetmp=$_FILES['image']['tmp_name'];
        $image=rand(0,1000).'_'.$imageName;
        move_uploaded_file($imagetmp,"upload\\".$image);
        $user=new register();
        $user->insertData($phone,$title,$bio,$image,$username);

    }


}



   
       
        
        










?>
<!------------------------->

<div class="col-md-9 side1" style="margin-top: 40px;">
    <h2 class="h2">Profile Settings</h2>

    <form class="setting" method="POST" action="" enctype="multipart/form-data">
        <div class="form-group row ">

            <label for="inputPassword" class="col-sm-2 col-form-label">Phone..</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" placeholder="phone number" name="phone">
            </div>
            <label for="inputPassword" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" placeholder="Title" name="title">
            </div>
            <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Biography</label>

            <div class="form-group">
                <textarea class="form-control" name="bio" id="exampleFormControlTextarea1" rows="6"
                    style="width: 700px;"
                    placeholder="Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque doloribus voluptates distinctio id, explicabo quod voluptatem aperiam veniam beatae eos corporis deserunt provident aspernatur quasi? Exercitationem repellendus reprehenderit explicabo consectetur."></textarea>
            </div>
            <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Profile Pic</label>
            <div class="form-group">
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
            </div>

            <div class='save1'>
                <a href='#'> <button class=' btn btn-primary save' type='submit' name='save'>Save</button></a>
            </div>


        </div>
    </form>

</div>
<!----------------------------------------------------------------------->


<?php include "include/footer.php" ?>