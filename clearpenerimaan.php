<?php
	//cek apakah sudah ada cookie mtk sebelumnya
	if(isset($_COOKIE["barangterima"]))
	{
		//loop untuk menghapus cookie
		foreach($_COOKIE["barangterima"] as $name=>$value)
		{
			setcookie("barangterima[$name]","",time()-7200);
		}
	}
	if(isset($_REQUEST["opt"]))
	{
		//kembali ke pilih supplier
		echo "<meta http-equiv=\"refresh\" content=\"0;url=home.php?p=pilihsupplier\" />";
	}
	else
	{
		//buka halaman penerimaan
		echo "<meta http-equiv=\"refresh\" content=\"0;url=home.php?p=penerimaan\" />";
	}
	?>