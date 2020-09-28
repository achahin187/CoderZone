<?php
ob_start();

class register extends DB
{
    public function signup($username, $email, $password)
    {
        $sql = "SELECT Count(Username) AS Num FROM users WHERE username = ? ";
        $result = $this->connect()->prepare($sql);
        $result->execute(array($username));
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if ($row['Num'] > 0) {
            echo " username is Alread Exist!";

        } else {
            $sql = "INSERT INTO users(username,email,password) VALUES (?,?,?)";
            $result = $this->connect()->prepare($sql);
            $result->execute(array($username, $email, $password));
            header("location:./profile-settings.php");
        }
    }
/////////////////////////////////////////

    public function insertData($phone, $title, $bio, $image, $username)
    {
        $sql = "UPDATE users SET phone_number=?, title=? , bio=? , image=?  WHERE username='$username'";
        $result = $this->connect()->prepare($sql);
        $result->execute(array($phone, $title, $bio, $image));
        header("location:./profile.php");

    }

/////////////////////////////////////////////
    public function selectData($username)
    {
        $sql = "SELECT * FROM users WHERE username=? ";
        $result = $this->connect()->prepare($sql);
        $result->execute(array($username));
        $row = $result->fetch();
        return $row;

    }
/////////////////////////////
    public function selectDatainProfile($userid)
    {
        $sql = "SELECT * FROM users WHERE id=? ";
        $result = $this->connect()->prepare($sql);
        $result->execute(array($userid));
        $row = $result->fetch();
        return $row;

    }
////////////////////////////
    public function selectUsers($username)
    {
        $sql = "SELECT * FROM users WHERE username=? ";
        $result = $this->connect()->prepare($sql);
        $result->execute(array($username));
        $row = $result->fetch();
        return $row;

    }

///////////////////////////////////////////
    public function login($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username=? AND password=?";
        $result = $this->connect()->prepare($sql);
        $result->execute(array($username, $password));
        if ($result->rowCount() == 1) {

            $row = $result->fetch();
            $_SESSION['usernmae'] = $username;
            if ($row['admin'] == "") {
                header('location:./home.php');
            } else {
                header('location:./add-category.php');
            }

        } else {
            echo "<div class='alert alert-success' role='alert'>
    username is not exist!
  </div>";

        }

    }
/////////////////////////////
    public function selectCategory()
    {
        $sql = "SELECT * FROM category ORDER BY id DESC";
        $result = $this->connect()->query($sql);
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;

            }
            return $data;
        }
    }
///////////////////////////////////////

    public function insertPost($category, $disc, $postimage, $userID)
    {
        $sql = "INSERT INTO posts(category,discussion,post_image,user_id) VALUES (?,?,?,?)  ";
        $result = $this->connect()->prepare($sql);
        $result->execute(array($category, $disc, $postimage, $userID));
        return $result;

    }
///////////////////////////////////////////////
    public function insertevent($title, $content, $eventimage, $date, $place, $userID)
    {
        $sql = "INSERT INTO events(title,content,event_image,start_date,place,user_id) VALUES (?,?,?,?,?,?) ";
        $result = $this->connect()->prepare($sql);
        $result->execute(array($title, $content, $eventimage, $date, $place, $userID));
        return $result;

    }
//////////////////////////////////////////////////

    public function selectPosts($username)
    {
        $sql = "SELECT users.username , users.image, posts.discussion, posts.post_image, posts.time,posts.id,category.name AS category FROM users
  INNER JOIN posts ON users.id=posts.user_id
  INNER JOIN category ON category.id=posts.category   WHERE users.username='$username'   ORDER BY posts.id DESC ";
        $result = $this->connect()->query($sql);
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;

            }
            return $data;
        }

    }
    //////////////////////////////////////
    public function selectPostsinProfile($userid)
    {
        $sql = "SELECT users.username , users.image, posts.discussion, posts.post_image,posts.user_id, posts.time,posts.id,category.name AS category FROM users
    INNER JOIN posts ON users.id=posts.user_id
    INNER JOIN category ON category.id=posts.category   WHERE users.id='$userid'   ORDER BY posts.id DESC ";
        $result = $this->connect()->query($sql);
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;

            }
            return $data;
        }

    }
////////////////////////////////////////////////////////////////////////////
    public function editPost()
    {
        $sql = "SELECT * FROM posts WHERE id=" . $_GET['up'];
        $result = $this->connect()->query($sql);
        $rows = $result->fetch();
        return $rows;

    }

/////////////////////////////////

    public function updatePost($disc, $postimage)
    {
        $sql = "UPDATE posts SET 	discussion=? , post_image=?  WHERE id=" . $_GET['up'];
        $result = $this->connect()->prepare($sql);
        $result->execute(array($disc, $postimage));
        return $result;

    }
///////////////////////////////////////////
    public function fetchPost()
    {
        $sql = "SELECT * FROM posts";
        $result = $this->connect()->query($sql);
        $r = $result->fetch();
        return $r;

    }

//////////////////////////////////////////////////////
    public function selectPost()
    {
        $sql = "SELECT users.username, users.image, posts.discussion, posts.post_image, posts.time,posts.id,posts.user_id,category.name
 AS category FROM users
INNER JOIN posts ON users.id=posts.user_id
INNER JOIN category ON category.id=posts.category ORDER BY posts.id DESC";
        $result = $this->connect()->query($sql);
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;

            }
            return $data;
        }

    }
//////////////////////////////////
    public function selectEvent()
    {
        $sql = "SELECT users.username, users.image, events.title , events.content, events.event_image,events.start_date,events.place,events.user_id ,events.id
 FROM users
INNER JOIN events ON users.id=events.user_id  ORDER BY events.id DESC";
        $result = $this->connect()->query($sql);
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;

            }
            return $data;
        }

    }

/////////////////////
    public function fetchEvent()
    {
        $sql = "SELECT * FROM events";
        $result = $this->connect()->query($sql);
        $r = $result->fetch();
        return $r;

    }
///////////////
    public function fetchuser()
    {
        $sql = "SELECT * FROM users";
        $result = $this->connect()->query($sql);
        $r = $result->fetch();
        return $r;

    }

/////////////////////////////////
    public function deletePost($id)
    {
        $sql = "DELETE FROM posts WHERE id='$id'";
        $result = $this->connect()->query($sql);
        return $result;

    }
//////////////////////////////
    public function singelPost($id)
    {
        $sql = "SELECT users.username, users.image, posts.discussion, posts.post_image, posts.time,posts.id
   FROM users
 INNER JOIN posts ON users.id=posts.user_id WHERE posts.id='$id'";
        $result = $this->connect()->query($sql);
        $row = $result->fetch();
        return $row;
    }
/////////////////////////////
    public function singelEvent($id)
    {
        $sql = "SELECT users.username, users.image,users.id, events.title , events.content, events.event_image,events.start_date,events.place,events.user_id ,events.id
    FROM users
   INNER JOIN events ON users.id=events.user_id WHERE events.id='$id'";
        $result = $this->connect()->query($sql);
        $row = $result->fetch();
        return $row;
    }
/////////////////////////////////////////////

    public function insertComment($comment, $userid, $postid)
    {
        $sql = "INSERT INTO comments (content_comment,user_id,post_id) VALUES (?,?,?)";
        $result = $this->connect()->prepare($sql);
        $result->execute(array($comment, $userid, $postid));
        return $result;
    }
////////////////////////////
    public function insertCommentEvent($comment, $userid, $eventid)
    {
        $sql = "INSERT INTO comments_event (content_comment,user_id,event_id) VALUES (?,?,?)";
        $result = $this->connect()->prepare($sql);
        $result->execute(array($comment, $userid, $eventid));
        return $result;
    }
////////////////////////////////////////
    public function selectComments()
    {
        $sql = "SELECT users.username ,users.image,users.id ,comments.post_id ,comments.content_comment,comments.id   FROM users
  INNER JOIN comments ON comments.user_id=users.id  WHERE  comments.post_id={$_GET['id']}   ORDER BY comments.id DESC ";
        $result = $this->connect()->query($sql);
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;

            }
            return $data;
        }

    }
    /////////////////////////////
    public function selectCommentsEvent()
    {
        $sql = "SELECT users.username ,users.image,users.id ,comments_event.event_id ,comments_event.content_comment,comments_event.id   FROM users
INNER JOIN comments_event ON comments_event.user_id=users.id  WHERE  comments_event.event_id={$_GET['id']}   ORDER BY comments_event.id DESC ";
        $result = $this->connect()->query($sql);
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;

            }
            return $data;
        }

    }
//////////////////////////////
    public function selectCommentsInHome()
    {
        $sql = "SELECT users.username ,users.image,users.id ,comments.post_id ,comments.content_comment,comments.id   FROM users
  INNER JOIN comments ON comments.user_id=users.id   ORDER BY comments.id DESC ";
        $result = $this->connect()->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;

    }
/////////////////////////////////
    public function countComments($postid)
    {
        $sql = "SELECT  Count(id) AS nom  FROM comments WHERE post_id='$postid' ";
        $result = $this->connect()->query($sql);
        $r = $result->fetch();
        return $r;

    }
    /////////////////////
    public function countCommentsEvent($eventid)
    {
        $sql = "SELECT  Count(id) AS nom  FROM comments_event WHERE event_id='$eventid' ";
        $result = $this->connect()->query($sql);
        $r = $result->fetch();
        return $r;

    }
    /////////////////////
    public function visitor($userid, $eventid)
    {
        $sql = "INSERT INTO visitor (user_id,event_id) VALUES (?,?) ";
        $result = $this->connect()->prepare($sql);
        $result->execute(array($userid, $eventid));
        return $result;
    }
    /////////////////////
    public function countViewEvent($eventid)
    {
        $sql = "SELECT  Count(id) AS nom  FROM visitor Where  event_id='$eventid'";
        $result = $this->connect()->query($sql);
        $r = $result->fetch();
        return $r;

    }
///////////////////////////////////
    public function countFavorites($postid)
    {
        $sql = "SELECT  Count(id) AS nom  FROM favorites WHERE posts_id='$postid' ";
        $result = $this->connect()->query($sql);
        $r = $result->fetch();
        return $r;

    }
//////////////////////////////
    public function addFavorites($postid, $userid)
    {
        $sql = "INSERT INTO favorites(posts_id,user_id) VALUES (?,?) ";
        $result = $this->connect()->prepare($sql);
        $result->execute(array($postid, $userid));
        return $result;

    }
/////////////////////////
    public function fetchFavorite()
    {
        $sql = "SELECT users.username,users.id , posts.discussion, posts.post_image,posts.id,favorites.id,favorites.user_id,favorites.posts_id,favorites.id AS favorites FROM users
  INNER JOIN posts ON users.id=posts.user_id
  INNER JOIN favorites ON favorites.posts_id=posts.id  WHERE favorites.posts_id=posts.id AND favorites.user_id={$_GET['id']}  ORDER BY favorites.id DESC ";
        $result = $this->connect()->query($sql);
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;

            }
            return $data;
        }

    }
///////////////////////////////////////////////////
    public function deleteFavorite($id)
    {
        $sql = "DELETE FROM favorites WHERE id='$id'";
        $result = $this->connect()->query($sql);
        return $result;

    }

//////////////////////////
    public function search($category)
    {
        $sql = "SELECT users.username, users.image, posts.discussion, posts.post_image, posts.time,posts.id,posts.user_id,category.name
AS category FROM users
INNER JOIN posts ON users.id=posts.user_id
INNER JOIN category ON category.id=posts.category  WHERE category.name LIKE '%" . $category . "%' ORDER BY posts.id DESC";
        $result = $this->connect()->query($sql);
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;

            }
            return $data;
        }

    }

/////////////////////
}