<?php
	//definisikan konstanta koneksi
	define("db_host","localhost");
	define("db_user","root");
	define("db_pass","");
	define("db_name","dbkonter");
	//buat instance objek mysqli baru untuk membuat koneksi
	$db=new MySQLi(db_host,db_user,db_pass,db_name);
	//cek keberhsilan koneksi
	if($db->connect_errno>0)
	{
		die("Tidk dapat terhubung ke Database: <br />".$db->connect_error);
	}
?>