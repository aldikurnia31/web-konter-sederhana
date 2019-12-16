<?php
	//baca data kd yang dibawa oleh link
	$kode=isset($_REQUEST["kd"]) ? $_REQUEST["kd"]:"";
	
	//buat cookie untuk menyimpan data kodesupplier ke memory
	setcookie("supplier",$kode,time()+7200);
	
	//lanjutkan ke halaman penerimaan
	echo "<meta http-equiv=\"refresh\" content=\"0;url=clearpenerimaan.php\" />";
?>