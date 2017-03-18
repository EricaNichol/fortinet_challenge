<?php
    include('./includes/class.uploader.php');
    //folder url
    $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].substr($_POST['file'],1);
    $date                 = date('m_d_y');
    $original_name        = substr($_POST['og'], 0, strrpos($_POST['og'],'.'));
    $edited_name          = $_POST['edit'];

    $download_link        = $original_name.'_'.$edited_name.'_'.$date;

    // print $url;
    print $download_link;

    $uploader = new Uploader();
    $data = $uploader->upload($url, array(
        'uploadDir' => 'downloads/', //Upload directory {String}
        'title' => array($download_link, 10), //New file name {null, String, Array} *please read documentation in README.md
    ));

    if($data['isComplete']){
        $files = $data['data'];
        print_r($files);
    }
    if($data['hasErrors']){
        $errors = $data['errors'];
        print_r($errors);
    }
?>
