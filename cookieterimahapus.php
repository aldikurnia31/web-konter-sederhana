<?php
	//membaca index cookie yang akan dihapus
	$index=isset($_REQUEST["index"]) ? $_REQUEST["index"]:"";
	//hapus cookie berdasarkan index diatas
	setcookie("barangterima[$index]","",time()-7200);
	//kembali ke halaman penerimaan
	echo "<meta http-equiv=\"refresh\"content=\"0;url=home.php?p=penerimaan\" />";
?>