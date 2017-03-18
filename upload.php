<?php
include('./includes/class.uploader.php');

$edited_name = substr($_POST['editname'], 0, strpos($_POST['editname'], '.'));

$uploader = new Uploader();
$data = $uploader->upload($_FILES['file'], array(
    'limit' => 10, //Maximum Limit of files. {null, Number}
    'maxSize' => 1, //Maximum Size of files {null, Number(in MB's)}
    'extensions' => array('js','css','php','html'), //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
    'required' => false, //Minimum one file is required for upload {Boolean}
    'uploadDir' => 'uploads/', //Upload directory {String}
    'title' => array($edited_name), //New file name {null, String, Array} *please read documentation in README.md
    'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
    'replace' => false, //Replace the file if it already exists {Boolean}
    'perms' => 0777, //Uploaded file permisions {null, Number}
    'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
    'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
    'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
    'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
    'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
    'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
));
if($data['isComplete']){
    session_start();
    $files             = $data['data'];
    $session_id        = $edited_name;
    $original_name     = $files['metas'][0]['old_name'];

    $session_id        = md5($session_id);

    $_SESSION["$session_id"] = $original_name;

    // print "<pre>";
    // print_r($files);
    // print "</pre>";

    echo json_encode($files);

}

if($data['hasErrors']){
    $errors = $data['errors'];
    print "<pre>";
    print_r($errors);
    print "</pre>";
}

?>
