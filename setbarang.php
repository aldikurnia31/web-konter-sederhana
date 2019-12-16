<?php
	//baca data barang dari form penerimaan
	$kdbrg=isset($_POST["listbarang"]) ? $_POST["listbarang"]:"";
	$stok=isset($_POST["txtstok"]) ? $_POST["txtstok"]:"";
	$val=$kdbrg."#".$stok;
	
	//buat cookie untuk menyimpan data barang terima ke browser
	if(isset($_COOKIE["barangterima"]))
	{
		foreach($_COOKIE["barangterima"] as $name=>$value)
		{
			$idx=$name;
		}
		$idx++;
		setcookie("barangterima[$idx]",$val,time()+7200);
	}
	else
	{
		setcookie("barangterima[0]",$val,time()+7200);
	}
	//lanjutkan ke halaman penerimaan
	echo "<meta http-equiv=\"refresh\" content=\"0;url=home.php?p=penerimaan\" />";
?>