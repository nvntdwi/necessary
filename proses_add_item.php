<?php
    include"koneksi.php";

function anti_injection($data){
	$filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	return $filter;
	}

    $id=$_POST['id'];
    $item=$_POST['item'];
    $size=$_POST['size'];

    $query="INSERT INTO tbl_item(id,item,size)
    VALUES('$id','$item','$size')";
    $result=mysql_query($query);

    if(isset($result)){
        echo "Data Berhasil Di Input";
     }else{
        echo "Data Gagal Di Input";
        }

?>