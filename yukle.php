<?php 
include("ssi/class.upload.php");

if($_POST)
{
	
$fotobilgileri=$_POST["fotobilgileri"];
$bilgiler=explode(",",$fotobilgileri);


$handle = new Upload($_FILES['image_field']);
if ($handle->uploaded) {
  $handle->allowed = array('image/*');
  $handle->file_new_name_body   = $_POST["fotoadi"];
  $handle->image_resize         = true;
  $handle->image_precrop = array($bilgiler[1],$handle->image_src_x - $bilgiler[2],$handle->image_src_y - $bilgiler[3],$bilgiler[0]);
  $handle->image_x              = 250;
  $handle->image_y              = 250;

  $handle->process('upload/');
  if ($handle->processed) {
    header("Location:index.php?m=success");
    $handle->clean();
  } else {
    echo 'error : ' . $handle->error;
  }
}

}
?>