<?php
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/nonpm/');
    if(isset($_FILES['file'])){
        switch($_FILES['file']['error']){
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                echo 'No File Sent';
            default:
                echo '???';
        }

        if($_FILES['file']['size'] > 1000000){
            echo 'Exceeded filesize limit.';
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);

        $ext = array_search(
            $finfo->file($_FILES['file']['tmp_name']),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png'
            ),
            true
        );

        if(false === $ext){
            echo 'Invalid file format.';
        }

        $hashname = sprintf('%s.%s', sha1($_FILES['file']['tmp_name']), $ext);

        $uploadpath = BASEURL.'/images/'.$hashname;

        if(!move_uploaded_file(
            $_FILES['file']['tmp_name'], 
            $uploadpath
        )){
            echo 'Failed to move uploaded file.';
        }else{
            echo $hashname;
        }
    }
?>