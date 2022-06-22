<?php
error_reporting(0);

$msg = "";
include 'conn.php';
if (isset($_GET['id'])){
    $id= $_GET['id'];
    $delete = mysqli_query($db, "DELETE FROM `image` WHERE `id`= '$id'");

}
// If upload button is clicked ...
if (isset($_POST['upload'])) {

	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "./image/" . $filename;

	// $db = mysqli_connect("localhost", "root", "", "memo");
    $creator = $_POST["creator"];
    $title = $_POST["title"];
    $msg = $_POST["msg"];
    $tag = $_POST["tag"];
	// Get all the submitted data from the form
	//$sql = "INSERT INTO image (filename) VALUES ('$filename')";
    $sql = "INSERT INTO `image`( filename, `creator`, `title`, `msg`, `tag`) VALUES ('$filename','$creator','$title','$msg','$tag')";
	// Execute query
	mysqli_query($db, $sql);

	// Now let's move the uploaded image into the folder: image
	if (move_uploaded_file($tempname, $folder)) {
		echo "<h3> Image uploaded successfully!</h3>";
	} else {
		echo "<h3> Failed to upload image!</h3>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/6e2a8b2838.js" crossorigin="anonymous"></script>   
     <title>Memories</title>
   
</head>

<body>
<div class="container mt-4 ">
    <h1 class="text-center text-info">Memories<img src="image/memo.png" alt="" width ="90" height ="40"></h1>
</div>
 
    <div class="container mt-4">
    <div class="row">
            <div class="col-8">    
            <div class="row align-items-start">
<?php 
    	// $db = mysqli_connect("localhost", "root", "", "memo");
    $sql = "SELECT * FROM `image`";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_assoc($result)){
    $title= $row['title'];
    $creator= $row['creator'];
    $msg= $row['msg']; 
    $tag= $row['tag'];                 
     
echo '<div class=" img mr-2 my-2">
       <div class="card" style="width: 18rem;">'
       ?>
     
       <img src="./image/<?php echo $row['filename'];?>" class="rounded float-start"  height =" 210">
  
    <?php
         echo'<div class="card-img-overlay">
         <a href="index.php?id=' . $row['id']. '" style="text-decoration: none; color:white;" class ="d-grid gap-2 d-md-flex justify-content-md-end " >
         <i class="fa-solid fa-trash" ></i>
         </a>
         </div>
            <div class="card-body">
            <h6 class="card-title">  '. $creator . '</h6>
            <h6 class="card-title">'. $title . '</h6>
            <p class="card-text">'. $msg .'</p>
            <p class="card-text">'. $tag .'</p>
        </div>
        </div>

    </div>';

} 

?>
 </div>
 </div>

    <div class="col-4 border border-2 rounded">
    <form action="" method="POST"  enctype="multipart/form-data">
            <h3 class =" text-center mt-2">Creating a Memory</h3>
            <div class="mb-3">
                <input type="Creator" class="form-control" id="Creator" name="creator" placeholder="Creator">
            </div>
            <div class="mb-3">
                <input type="Title" class="form-control" id="Title" name="title" placeholder="Title">
            </div>

            <div class="mb-3">
                <textarea class="form-control" id="" name="msg" placeholder="message"></textarea>
            </div>
            <div class="mb-3">
                <input type="Tag" class="form-control" id="Tag" name="tag" placeholder="Tag (Coma Seprated)">
            </div>
            <div class="mb-3">
				<input class="form-control" type="file" name="uploadfile" value="" />
			</div>
			<div class="mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
				<button class="btn btn-primary " type="submit" name="upload">UPLOAD</button>
			</div>
        </form>
    </div>
  </div>
</body>
</html>