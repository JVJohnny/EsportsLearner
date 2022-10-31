<?php
if(isset($_POST['submit'])){
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if($fileSize < 1000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'img/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("location: profile.php?uploadsuccess");

            } else {
                "imagem é muito grande";
            }

        } else {
            echo "erro no upload!";
        }


    } else {
        echo "you cannot upload files of this type!";
    }

    

}


?>