<?php
//menghapus cookie data barang terima jika ada
if(isset($_COOKIE["barangterima"]))
{
	foreach($_COOKIE["barangterima"] as $name=>$value)
	{
		setcookie("barangterima[$name]","",time()-7200);
	}
}

if(isset($_REQUEST["opt"]))
{
	//kembali ke halaman pilihsupplier
	echo "<meta content=\"refresh\" content=\"0;url=home.php?p=pilihsupplier\" />";
}
else
{
	//lanjutkan ke halaman penerimaan barang
	echo "<meta equiv=\"refresh\" content=\"0;url=home.php?p=penerimaan\" />";
}
?>