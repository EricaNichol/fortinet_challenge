<?php
session_start();
//define document root
define('ROOTPATH',$_SERVER['DOCUMENT_ROOT'].'/');
// good
$original_name = $_POST['original'];

// ./ get ride of
$ext           = pathinfo($oldpath, PATHINFO_EXTENSION);
$oldname       = substr($_POST["oldname"], 2);
  // needs uploads/doc
$oldpath       = ROOTPATH.$oldname;

$newname       = $_POST['item'];
$newpath       =  ROOTPATH.'./uploads/'.$newname;

// variables ok
// print $oldpath;
// print $newname;
$session_id = md5(substr($newname, 0, strrpos($newname, '.')));

if (rename($oldpath, $newpath)) {
  $_SESSION["$session_id"] = $original_name;
  echo json_encode($newname);
} else {
  echo json_encode('sorry there was a problem but please still consider me');
  // print $oldpath;
  // print $newpath;

}

    // echo json_encode($oldpath);
 ?>
