<?php
	date_default_timezone_set("Asia/Jakarta"); //set timezone
	include "db/koneksi.php";	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cahaya Cellular</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
<div id="header">

</div><!--header-->
<div id="menu">
	<ul>
    	<li><a href="home.php">Home</a></li>
    	<li><a href="#">File</a>
    		<ul>
    			<li><a href="?p=jenisbarang">Jenis Barang</a></li>
        		<li><a href="?p=barang">Barang</a></li>
        		<li><a href="?p=supplier">Supplier</a></li>
        	</ul>
    	</li>

        <li><a href="#">Profil</a>
            <ul>
                <li><a href="profil.php">Profil Perusahaan</a></li>
                <li><a href="clearpengeluaran.php">Visi & Misi</a></li>
            </ul>
        </li>


    	<li><a href="#">Transaksi</a>
    		<ul>
        		<li><a href="?p=pilihsupplier">Penerimaan</a></li>
            	<li><a href="clearpengeluaran.php">Pengeluaran</a></li>
         	</ul>
     	</li>
     	<li><a href="#">Laporan</a>
     	 	<ul>
         	 	<li><a href="?p=lapterimaset">Penerimaan</a></li>
             	<li><a href="?p=lapkeluarset">Pengeluaran</a></li>
         	</ul>
      	</li>
  	</ul>
</div><!--menu-->
<div id="content">
	<?php
		if(isset($_REQUEST["p"]))
		{
			include $_REQUEST["p"].".php"; //menampilkan halaman yang dibawa oleh link
		}
	?><!--content--></div>
</body>
</html>