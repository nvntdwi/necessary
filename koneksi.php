 
 <?php
//buat koneksi my sql dan database

$con_server=mysql_connect('localhost','root','');
$con_db=mysql_select_db('seragam');

if($con_server == false )
{
die("Koneksi dengan MYSQL gagal ! :'( <br><br>");
}

if ($con_db == false )
{
 die("Database Tidak Ada <br><br>");   
}

?>