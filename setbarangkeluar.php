<?php
	//baca data barang dari form pengeluaran
	$kdbrg=isset($_POST["listbarang"]) ? $_POST["listbarang"]:"";
	$stok=isset($_POST["txtstok"]) ? $_POST["txtstok"]:"";
	$val=$kdbrg."#".$stok;
	
	//buat cookie untuk menyimpan data barang keluar ke browser
	if(isset($_COOKIE["barangkeluar"]))
	{
		foreach($_COOKIE["barangkeluar"] as $name=>$value)
		{
			$idx=$name;
		}
		$idx++;
		setcookie("barangkeluar[$idx]",$val,time()+7200);
	}
	else
	{
		setcookie("barangkeluar[0]",$val,time()+7200);
	}
	//lanjutkan ke halaman pengeluaran
	echo "<meta http-equiv=\"refresh\" content=\"0;url=home.php?p=pengeluaran\" />";
?>