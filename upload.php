<?php
// PHP Upload File sederhana dengan otomatis pembuatan folder baru (jika belum tersedia), pembatasan ukuran file dan ektensi file.

$allowedExts = array("doc", "docx", "jpg", "jpeg", "png", "pdf");
$extension = end(explode(".", $_FILES["upload"]["name"]));

if (($_FILES["upload"]["size"] < 200000000)
&& in_array($extension, $allowedExts)) {
    if ($_FILES["upload"]["error"] > 0)
    {
        echo "Return Code: " . $_FILES["upload"]["error"] . "<br />";
    }
    else
    {
        echo "Upload : " . $_FILES["upload"]["name"] . "<br />";
        echo "Type : " . $_FILES["upload"]["type"] . "<br />";
        echo "Size : " . ($_FILES["upload"]["size"] / 1024) . " Kb<br />";
        echo "Temp file : " . $_FILES["upload"]["tmp_name"] . "<br />";

        if (file_exists("uploads/2021/" . $_FILES["upload"]["name"]))
        {
            echo $_FILES["upload"]["name"] . " already exists. "; // ganti nama lain menggunakan rand
        }
        else
        {
            // Check if directory exists if not create it 
            if(!is_dir("uploads/2021/")) {
               mkdir("uploads/2021/");
             }
             move_uploaded_file($_FILES["upload"]["tmp_name"],
            "uploads/2021/". $_FILES["upload"]["name"]);
            echo "Stored in: " . "uploads/2021/". $_FILES["upload"]["name"];
        }
    }
} else {
    echo "Invalid file";
}
?>

<form action="" method="POST" enctype="multipart/form-data">
<input type="file" name="upload" />
<input type="submit"/>
</form>

<?php
/*
 *  Keterangan 
 *
pwd = /var/www/html/file_upload/

file =
/var/www/html/file_upload/uploads/
/var/www/html/file_upload/upload.php

> Folder file_uploads & uploads harus memiliki hak akses 777 (semua bisa read & write)
> Saat proses file diupload, dari client akan diupload ke folder temporary di server, untuk linux folder tersebut berada di direktori /tmp/
> Setelah semua validasi selesai, file yang berada di direktori /tmp/namafileacak akan dipindahkan ke direktori tujuan yaitu uploads/2021 dengan nama file asli
> Penggunaan function is_dir untuk mengecek apakah direktori tujuan upload tersedia di server atau tidak, jika tidak maka menggunakan function mkdir untuk membuat folder baru
> Ekstensi yang diperbolehkan diupload menggunakan function in_array('ektensi file', 'ektensi yang diijinkan') dan pembatasan ukuran file menggunakan if $_FILES["upload"]["size"] < filesize 

*/

