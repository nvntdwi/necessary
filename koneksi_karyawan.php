<?php
//buat koneksi my sql dan database

$con_server=mysql_connect('127.0.0.1:3306','root','otinihon2010');
$con_db=mysql_select_db('otem');

if($con_server == false )
{
die("Koneksi dengan MYSQL gagal ! :'( <br><br>". mysql_error());
}

if ($con_db == false )
{
 die("Database engga ada <br><br>");   
}

?>