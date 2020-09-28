<!------------------------->

<div class="container" style="margin-top: 50px;">
    <div class="row">

        <div class="col-md-3 " id="sidebar">
            <div class="home">
                <a href="home.php">
                    <i class="fas fa-home "></i> <span class="span">Home</span></a>
            </div>
            <div class="home">

                <?php
$username = $_SESSION['username'];
$header = new register();
$header->selectData($username);
$row = $header->selectData($username);
echo "

<a href='favorites.php?id={$row['id']}'>
<i class='fas fa-heart'></i> <span class='span' style='font-size: 20px;'>My favorites</span></a>
";

?>
            </div>
            <div class="home">
                <a href="contactus.php">
                    <i class="fas fa-envelope-open"></i><span class="span" style="font-size: 20px;"> Contact
                        Us</span></a>
            </div>
            <div class="home">
                <div>
                    <a href="#">
                        <i class="fas fa-paperclip"></i> <span class="span">Categories</span></a>
                </div>
                <div>

                    <span> PHP</span>

                </div>
                <div>

                    <span> Laravel</span>

                </div>
                <div>

                    <span> JavaScript</span>

                </div>
                <div>

                    <span> css</span>

                </div>
                <div>

                    <span> Bootstrap</span>

                </div>

            </div>

            <div style="font-weight: bold; font-size:20px;border-bottom: 1px solid rgb(184, 174, 174);">
                <a href="#" style="text-decoration: none; color:black;"> <i class="fas fa-calendar-week fa-sm"></i>
                    Events</a>

            </div>

            <!------------------>




        </div>


        <!------------------->