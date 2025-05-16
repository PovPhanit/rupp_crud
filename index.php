<?php
  $localhost="localhost";
  $username="root";
  $password="";
  $database="crud_post";

  $connection=mysqli_connect($localhost,$username,$password,$database);



  if(isset($_POST['submit'])){
    $title= $_POST["title"];
    $description = $_POST["description"];
    $image= $_FILES["image"]["name"];
    $image_tmp = $_FILES["image"]["tmp_name"];
    $query = mysqli_query($connection,"insert into posts(posts_title,posts_description,posts_image) values('$title','$description','$image')");
  }


  if(isset($_GET['delete'])){
    // $id = $_GET['delete'];
    // mysqli_query($connection,"delete from posts where posts_id = $id");
    $showdelete = "hideoverlay";
  }else{
    $showdelete="";
  }

  if(isset($_POST['submitdelete'])){
     $id = $_GET['delete'];
    mysqli_query($connection,"delete from posts where posts_id = $id");
    $showdelete="";
  }



  if(isset($_GET['edit'])){
    $show = "hideoverlay";
    $id = $_GET['edit'];
    $query = mysqli_query($connection,"select * from posts where posts_id = $id");
    while($row=mysqli_fetch_assoc($query)){
        $id = $row['posts_id'];
        $title= $row['posts_title'];
        $description=$row['posts_description'];
        $image = $row['posts_image'];
    }
  }else{
    $show="";
    $title= "";
    $description="";
    $image = "";
  }

  if(isset($_POST['submitedit'])){
    $id = $_GET['edit'];
    $title= $_POST["title"];
    $description = $_POST["description"];
    $image= $_FILES["image"]["name"];
    $image_tmp = $_FILES["image"]["tmp_name"];
    $query = mysqli_query($connection,"update posts set posts_title = '$title', posts_description='$description', posts_image='$image' where posts_id = '$id'");
    $show="";
  }



  $query = mysqli_query($connection,"select * from posts");
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styless.css">
</head>

<body>
    <div class="overlay overlaypost <?php echo $show; ?>">
        <div class="forminput">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="forms">
                    <div  class="input">
                        <label for="">Title </label>
                        <input type="text" name="title" value="<?php echo $title; ?>" placeholder="title">
                    </div>
                    <div  class="input">
                        <label for="">Discription </label>
                        <input type="text" name="description" value="<?php echo $description; ?>" placeholder="description">
                    </div>
                </div>
                <div class="upload">
                    <label for="imageUpload" name="image" >Upload Image</label>
                    <input type="file" name="image" value="<?php echo $image; ?>" id="imageUpload" hidden>
                    <div class="buttonpos">
                        <a class="delete cancelpost cancelposts">Cancel</a>

                        <?php
                            if($show==""){
                                echo '<input class="submitform" type="submit" name="submit" value="Post">';
                            }else{
                                echo '<input class="submitform" type="submit" name="submitedit" value="Update">';
                            }
                        ?>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="overlay overlaydelete  <?php echo $showdelete; ?>">
        <div class="forminput">
            <form action="" method="post" enctype="multipart/form-data">
                <h1 class="deletenow">Delete</h1>
                <hr>
                <div class="upload buttondelete">
                    <div class="buttonpos">
                        <a class="delete cancelpost canceldelete">Cancel</a>
                        <input class="submitform" type="submit" name="submitdelete" value="Delete">
                    </div>
                </div>
            </form>
        </div>
    </div>
   <main>
        <div>
            <button class="createposts">Create new post</button>
        </div>
        <table border="">
                <thead class="head" >
                    <tr>
                        <th>
                            Title
                        </th>
                        <th>
                            Discription
                        </th>
                        <th>
                            Image
                        </th>
                        <th>
                            Date
                        </th>
                        <th  >
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody >

                    <?php
                        while($row=mysqli_fetch_assoc($query)){
                            $id = $row["posts_id"];
                            $title = $row["posts_title"];
                            $description = $row["posts_description"];
                            $image=$row["posts_image"];
                            $date = $row["posts_date"];
                            echo '<tr class="body">
                                    <td>'.$title.'</td>
                                    <td>'.$description.'</td>
                                    <td>'.$image.'</td>
                                    <td>'.$date.'</td>
                                    <td class="actions">
                                         <a href="./post.php?edit='.$id.'" class="edit">Edit</a>
                                        <a href="./post.php?delete='.$id.'" class="delete">Delete</a>
                                    </td>
                                  </tr>';
                        
                        }
                    ?>
                </tbody>
            </table>
   </main>

  <script src="javascript/scripts.js"></script>
</body>
</html>