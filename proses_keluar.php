<?php
    include"koneksi.php";

function anti_injection($data){
	$filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	return $filter;
	}

    $id_item=$_POST['id_item'];
    $Qty_k=$_POST['Qty_k'];
    $tgl_k=$_POST['tgl_k'];
    $pic_k=$_POST['pic_k'];

    $query="INSERT INTO tbl_keluar(id_item,Qty_k,tgl_k,pic_k)
    VALUES('$id_item','$Qty_k','$tgl_k','$pic_k')";
    $result=mysql_query($query);

    if(isset($result)){
        echo "Data Berhasil Di Input";
     }else{
        echo "Data Gagal Di Input";
        }

?>