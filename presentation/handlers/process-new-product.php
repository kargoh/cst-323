<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../Autoloader.php';

$id = 0;
$productname = $_POST['productname'];
$productdescription = $_POST['productdescription'];
$productprice = $_POST['productprice'];

$target_dir = "../../upload/";
$target_file = $target_dir . basename($_FILES['productphoto']['name']);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["productphoto"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

  // Check file size
if ($_FILES["productphoto"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["productphoto"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["productphoto"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

$product = new Product($id, $productname, $productdescription, $productprice, $target_file);

$bs = new ProductBusinessService();
$bs->makeNew($product);
echo "Inserted item " . $productname . ".<br>";

echo '<a href="../views/adminProducts.php">Return to Admin page</a>';

?>