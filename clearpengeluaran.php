<?php
	//cek apakah sudah ada cookie mtk sebelumnya
	if(isset($_COOKIE["barangkeluar"]))
	{
		//loop untuk menghapus cookie
		foreach($_COOKIE["barangkeluar"] as $name=>$value)
		{
			setcookie("barangkeluar[$name]","",time()-7200);
		}
	}
	if(isset($_REQUEST["opt"]))
	{
		//kembali ke home
		echo "<meta http-equiv=\"refresh\" content=\"0;url=home.php\" />";
	}
	else
	{
		//buka halaman pengeluaran
		echo "<meta http-equiv=\"refresh\" content=\"0;url=home.php?p=pengeluaran\" />";
	}
	?>