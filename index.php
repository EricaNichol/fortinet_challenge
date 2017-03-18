<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="./css/jquery.filer.css" type="text/css" rel="stylesheet">
    <link href="./css/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"> <!-- load bootstrap css -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"> <!-- load fontawesome -->
    <link rel="stylesheet" href="/css/codingbydave.css">
    <script src="http://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="./js/jquery.filer.js"></script>
    <script type="text/javascript" src="./js/my_custom.js"></script>
  </meta>
    <title>Fortinet Challenge</title>
  </head>
  <body>
    <div class="container">
        <div class="content_container">
            <h1 class="page-title">Fortinet Exercise</h1>
              <h3 class="page-subheader">Developer Challenge</h3>

            <!-- LOGIN FORM -->
            <div class="part_container first">
              <h2>Part 1: Multiple File Uploads</h2>
              Please select multiple file at once. Upload and repeat.
              <h2>Features:</h2>
              <ul>
                <li>Multiple Uploads (jquery.filer)
                  <li>Edit file name before uploading (AJAX)</li>
                  <li>See the Original Name (PHP sessions)
                  <li>Update name and Downlaod  (Php Uploader)</li>
                  </ul>
              <form action="./upload.php" method="post" id="upload_form" enctype="multipart/form-data">
                <h2>Uploading multiple files</h2>
                  <input type="file" name="files[]" id="filer_input" multiple="multiple">
                  <input type="submit"  class='btn btn-info btn-sm' value="Upload">
                  <a style="float:right"href='http://codingbydave.com' target="_blank">CodingByDave</a>
              </form>

              <div id="file_container">
                <div class="files">
                  <?php $files = glob('./uploads/*.*');
                  session_start();
                  foreach($files as $file):
                    // print "<pre>";
                    // print_r($_SESSION);
                    // print "</pre>";
                    $current_file_name = substr($file, strrpos($file, '/') + 1);
                    $session_id = md5(substr($current_file_name, 0, strrpos($current_file_name, '.')));
                    // print md5($current_file_name);
                    // print $session_id;
                    // print $file;
                    ?>
                    <div class='field_item'>
                      <div class="field_box">
                        <h2>Original Name:</h2>
                        <a class='download_link' href="<?php echo $file; ?>"><?php echo $_SESSION["$session_id"]; ?></a>
                      </div>
                      <div class="field_box">
                        <h2>Edit the Current Name</h2>
                        <input class='custom-input form-control' type='text' name="oldname" value="<?php print $current_file_name; ?>">
                        <input class='custom_button btn btn-info btn-sm' type='submit' value='Update'>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

            <div class="part_container">

              <h2>Part 2: Function</h2>

              Wrote a elegant recursion function in that can be viewed in <code>function.php</code>

              <form action="/function.php" method="get" class="recursion_form">
                <h2>Enter a number</h2>
                <input name="number" type="text" class="form-control number_box">
                <input type="submit" value="Submit" class='btn btn-info btn-sm'>
                <a style="float:right"href='http://codingbydave.com' target="_blank">CodingByDave</a>
              </form>

            </div>


            <!-- LOGIN FORM -->

        </div>

  </body>
</html>
