<?php
    include"koneksi.php";

function anti_injection($data){
	$filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	return $filter;
	}
function create_url_slug($string){
  $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
  return $slug;
}
  switch($_GET['admin']){
    case "login":
          $nik          = $_POST['nik'];
          $password     = $_POST['password'];
          $login        = "select * from tbl_pic where nik='$nik' && password='$password'";
          $login_query  = mysql_query($login);
          $num          = mysql_num_rows($login_query);
        
          if($num == 1){
            session_start();
            while($a=mysql_fetch_array($login_query)){
                $_SESSION['nik'] = $nik;
                header('location:dashboard.php');
            }
          }
          else{
            header('location:index.php?message=error');
          }
    break;
    case "logout":
      session_start();
      
      if(isset($_SESSION['nik']))
      {
        unset($_SESSION['nik']);
        header('location:index.php');
      }
      else
      {
        echo"Gagal";
      }
      session_destroy();        
    break;
    case "input":
          $nik          = $_POST['nik'];
          $name         = $_POST['name'];
          $password     = $_POST['password'];
          $lokasi_file  = $_FILES['image']['tmp_name'];
          $dir          = "images/profile/";
          $nama_file    = $_FILES['image']['name'];
          $type         = $_FILES['image']['type'];
          move_uploaded_file($lokasi_file, $dir .$nama_file);
          mysql_query("insert into tbl_pic(nik,nama,password,photo,level) values('$nik', '$name', '$password', '$nama_file', 'admin')");
          header('location:'.$_SERVER['HTTP_REFERER']);
    break;
    case "update":
          $id           = $_POST['id'];
          $nik          = $_POST['nik'];
          $name         = $_POST['name'];
          $password     = $_POST['password'];
          $lokasi_file  = $_FILES['image']['tmp_name'];
          $dir          = "images/profile/";
          $nama_file    = $_FILES['image']['name'];
          $type         = $_FILES['image']['type'];
          move_uploaded_file($lokasi_file, $dir .$nama_file);
          $query = "UPDATE tbl_pic SET ";

          if(!empty($nik))
          { 
            $query .= " nik = '$nik' ,";
          }
          if(!empty($name))
          { 
            $query .= " nama = '$name' ,";
          }
          if(!empty($password))
          { 
            $query .= " password = '$password' ,";
          }
          if(!empty($nama_file))
          { 
            $query .= " photo = '$nama_file' ,";
          }

          $query = trim($query, ','); //remove any trailing comma 
          $query .= "WHERE id = '$id'";
          mysql_query($query);
          header('location:'.$_SERVER['HTTP_REFERER']);
    break;
    case "delete_pic":
          $id=abs((int)($_GET['id']));
          mysql_query("delete from tbl_pic where id='$id'");
          echo"<script>alert('Data Berhasil Hapus');
          window.history.go(-1);</script>";
    break;
    case "input_item":
          $name     = $_POST['name'];
          $size     = $_POST['size'];
          mysql_query("insert into tbl_item(item,size,qty) values('$name','$size',0)");
          header('location:'.$_SERVER['HTTP_REFERER']);
    break;
    case "update_item":
          $id       = $_POST['id'];
          $name     = $_POST['name'];
          $size     = $_POST['size'];
          mysql_query("update tbl_item set item='$name', size='$size' where id='$id'") OR DIE(mysql_error());
          header('location:index_item.php');
    break;
    case "delete_item":
          $id=abs((int)($_GET['id']));
          mysql_query("delete from tbl_item where id='$id'");
          echo"<script>alert('Data Berhasil Hapus');
          window.history.go(-1);</script>";
    break;
    case "add_item":
          $id_item  = $_POST['id_item'];
          $qty      = $_POST['qty'];
          $tgl      = date('Y-m-d', strtotime( $_POST['tgl'] ));
          $pic      = $_POST['pic'];
          mysql_query("insert into tbl_transaksi(id_item,qty,tgl,id_pic,tipe) values('$id_item','$qty','$tgl','$pic', 'masuk')");
          mysql_query("update tbl_item set qty=qty+'$qty' where id='$id_item'");
          header('location:'.$_SERVER['HTTP_REFERER']);
    break;
    case "remove_item":
          $id_item  = $_POST['id_item'];
          $qty      = $_POST['qty'];
          $tgl      = date('Y-m-d', strtotime( $_POST['tgl'] ));
          $pic      = $_POST['pic'];
          mysql_query("insert into tbl_transaksi(id_item,qty,tgl,id_pic,tipe) values('$id_item','$qty','$tgl','$pic', 'keluar')");
          mysql_query("update tbl_item set qty=qty-'$qty' where id='$id_item'");
          header('location:'.$_SERVER['HTTP_REFERER']);
    break;
    case "change_item":
          $from     = $_POST['from'];
          $to       = $_POST['to'];
          $pic      = $_POST['pic'];
          $tgl      = $_POST['tgl'];

          mysql_query("insert into tbl_transaksi(id_item,qty,tgl,id_pic,tipe) values('$from','1','$tgl','$pic', 'masuk')");
          mysql_query("insert into tbl_transaksi(id_item,qty,tgl,id_pic,tipe) values('$to','1','$tgl','$pic', 'keluar')");
          mysql_query("update tbl_item set qty=qty+1 where id='$from'");
          mysql_query("update tbl_item set qty=qty-1 where id='$to'");
          header('location:'.$_SERVER['HTTP_REFERER']);
    break;
    case "input_jatah":
          $nik     = $_POST['nik'];
          $nama       = $_POST['nama'];
          $line      = $_POST['line'];
          $baju      = $_POST['baju'];
          $celana      = $_POST['celana'];
          $sepatu      = $_POST['sepatu'];
          $topi      = $_POST['topi'];
          $kacamata   = $_POST['kacamata'];
          $kerudung   = $_POST['kerudung'];
          $note       = $_POST['note'];
          $id_pic   = $_POST['id_pic'];
          $tgl   = $_POST['tgl'];

        $check = mysql_query("select tgl from tbl_jatah where nik = '$nik' order by tgl DESC limit 1");
        $data = mysql_fetch_row($check);

        if(strtotime($data[0])<strtotime('-1 year')){
            $query = mysql_query("insert into tbl_jatah(nik,nama,line, note) values('$nik','$nama','$line','$note')");
            if (!empty($baju)){
                mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$baju','1', 'keluar', '$id_pic', '$tgl')");
                mysql_query("update tbl_item set qty=qty-1 where id='$baju'");
                mysql_query("update tbl_jatah set baju='$baju' where nik='$nik' order by tgl DESC LIMIT 1");
            }
            if (!empty($celana)){
                mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$celana','1', 'keluar', '$id_pic', '$tgl')");
                mysql_query("update tbl_item set qty=qty-1 where id='$celana'");
                mysql_query("update tbl_jatah set celana='$celana' where nik='$nik' order by tgl DESC LIMIT 1");
            }
            if (!empty($sepatu)){
                mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$sepatu','1', 'keluar', '$id_pic', '$tgl')");
                mysql_query("update tbl_item set qty=qty-1 where id='$sepatu'");
                mysql_query("update tbl_jatah set sepatu='$sepatu' where nik='$nik' order by tgl DESC LIMIT 1");
            }
            if (!empty($topi)){
                mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$topi','1', 'keluar', '$id_pic', '$tgl')");
                mysql_query("update tbl_item set qty=qty-1 where id='$topi'");
                mysql_query("update tbl_jatah set topi='$topi' where nik='$nik' order by tgl DESC LIMIT 1");
            }
            if (!empty($kacamata)){
                mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$kacamata','1', 'keluar', '$id_pic', '$tgl')");
                mysql_query("update tbl_item set qty=qty-1 where id='$kacamata'");
                mysql_query("update tbl_jatah set kacamata='$kacamata' where nik='$nik' order by tgl DESC LIMIT 1");
            }
            if (!empty($kerudung)){
                mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$kerudung','1', 'keluar', '$id_pic', '$tgl')");
                mysql_query("update tbl_item set qty=qty-1 where id='$kerudung'");
                mysql_query("update tbl_jatah set kerudung='$kerudung' where nik='$nik' order by tgl DESC LIMIT 1");
            }

            if($query){
                header('location:jatah.php?result=success');
            }else{
                header('location:jatah.php?result=error');
            }
        }else{
            header('location:jatah.php?result=validate');
        }      
    break;
    case "update_jatah":
      $nik     = $_POST['nik'];
      $nama       = $_POST['nama'];
      $line      = $_POST['line'];
      $baju      = $_POST['baju'];
      $celana      = $_POST['celana'];
      $sepatu      = $_POST['sepatu'];
      $topi      = $_POST['topi'];
      $kacamata   = $_POST['kacamata'];
      $kerudung   = $_POST['kerudung'];
      $note       = $_POST['note'];
      $tgl   = $_POST['tgl'];
      $id_pic   = $_POST['id_pic'];
      $old_nik     = $_POST['old_nik'];
      $old_nama       = $_POST['old_nama'];
      $old_line      = $_POST['old_line'];
      $old_baju      = $_POST['old_baju'];
      $old_celana      = $_POST['old_celana'];
      $old_sepatu      = $_POST['old_sepatu'];
      $old_topi      = $_POST['old_topi'];
      $old_kacamata   = $_POST['old_kacamata'];
      $old_kerudung   = $_POST['old_kerudung'];

      if (!empty($baju)){
        if($baju != $old_baju){
          mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$baju','1', 'keluar', '$id_pic', '$tgl')");
          mysql_query("update tbl_item set qty=qty-1 where id='$baju'");
          mysql_query("update tbl_jatah set baju='$baju' where nik='$nik' order by tgl DESC LIMIT 1");
          if(!empty($old_baju)){
            mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$old_baju','1', 'masuk', '$id_pic', '$tgl')");
            mysql_query("update tbl_item set qty=qty+1 where id='$old_baju'");
          }
        }
      }
      if (!empty($celana)){
        if($celana != $old_celana){
          mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$celana','1', 'keluar', '$id_pic', '$tgl')");
          mysql_query("update tbl_item set qty=qty-1 where id='$celana'");
          mysql_query("update tbl_jatah set celana='$celana' where nik='$nik' order by tgl DESC LIMIT 1");
          if(!empty($old_celana)){
            mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$old_celana','1', 'masuk', '$id_pic', '$tgl')");
            mysql_query("update tbl_item set qty=qty+1 where id='$old_celana'");
          }
        }
      }
      if (!empty($sepatu)){
        if($sepatu != $old_sepatu){
          mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$sepatu','1', 'keluar', '$id_pic', '$tgl')");
          mysql_query("update tbl_item set qty=qty-1 where id='$sepatu'");
          mysql_query("update tbl_jatah set sepatu='$sepatu' where nik='$nik' order by tgl DESC LIMIT 1");
          if(!empty($old_sepatu)){
            mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$old_sepatu','1', 'masuk', '$id_pic', '$tgl')");
            mysql_query("update tbl_item set qty=qty+1 where id='$old_sepatu'");
          }
        }
      }
      if (!empty($topi)){
        if($topi != $old_topi){
          mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$topi','1', 'keluar', '$id_pic', '$tgl')");
          mysql_query("update tbl_item set qty=qty-1 where id='$topi'");
          mysql_query("update tbl_jatah set topi='$topi' where nik='$nik' order by tgl DESC LIMIT 1");
          if(!empty($old_topi)){
            mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$old_topi','1', 'masuk', '$id_pic', '$tgl')");
            mysql_query("update tbl_item set qty=qty+1 where id='$old_topi'");
          }
        }
      }
      if (!empty($kacamata)){
        if($kacamata != $old_kacamata){
          mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$kacamata','1', 'keluar', '$id_pic', '$tgl')");
          mysql_query("update tbl_item set qty=qty-1 where id='$kacamata'");
          mysql_query("update tbl_jatah set kacamata='$kacamata' where nik='$nik' order by tgl DESC LIMIT 1");
          if(!empty($old_kacamata)){
            mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$old_kacamata','1', 'masuk', '$id_pic', '$tgl')");
            mysql_query("update tbl_item set qty=qty+1 where id='$old_kacamata'");
          }
        }
      }
      if (!empty($kerudung)){
        if($kerudung != $old_kerudung){
          mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$kerudung','1', 'keluar', '$id_pic', '$tgl')");
          mysql_query("update tbl_item set qty=qty-1 where id='$kerudung'");
          mysql_query("update tbl_jatah set kerudung='$kerudung' where nik='$nik' order by tgl DESC LIMIT 1");
          if(!empty($old_kerudung)){
            mysql_query("insert into tbl_transaksi(id_item,qty, tipe, id_pic, tgl) values('$old_kerudung','1', 'masuk', '$id_pic', '$tgl')");
            mysql_query("update tbl_item set qty=qty+1 where id='$old_kerudung'");
          }
        }
      }

      $query = mysql_query("update tbl_jatah set note='$note' where nik='$nik' order by tgl DESC LIMIT 1");

      if($query){
          header('location:index_jatah.php?result=success');
      }else{
          header('location:index_jatah.php?result=error');
      }

    break;
	}
	
?>
