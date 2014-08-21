<?php
ob_start();
/*
 Uploadify v3.0.0
 Copyright (c) 2010 Ronnie Garcia, Travis Nickels

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.
 */

require('../../../../../include/config.php');

$targetFolder = 'tmp';

$fileTypes = array('jpg','jpeg','gif','png', 'JPG','JPEG','GIF','PNG'); // File extensions : Image by default

if(!empty($_POST['ext'])){
    $fileTypes = explode(';', $_POST['ext']);
} else {
    $error = 'Using default ext list: '.join(',', $fileTypes);
}

if(!empty($_FILES)){

    $tempFile = $_FILES['Filedata']['tmp_name'];
    $targetFile = SITE_DIR . IMAGE_TMP_DIR . $_FILES['Filedata']['name'];

    // Validate the file type
    $fileParts = pathinfo($_FILES['Filedata']['name']);

    if (in_array($fileParts['extension'],$fileTypes) || $_POST['ext'] == '*')  {

        if(!move_uploaded_file($tempFile,$targetFile)) {
            echo 0;
           $error.='Moving file failed';
        } else {
            echo 1;
            // SUCCESS
        }
    } else {
        $error.='Extension not allowed';
        echo 0;
    }
} else {
    $error.='Empty $_FILES';
}

$fp = fopen('upload.log', 'a');
fwrite($fp, $error, strlen($error));
fclose($fp);

?>