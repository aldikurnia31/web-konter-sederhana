<?php
$q="%".$_GET["q"]."%";

include "db/koneksi.php";

			
	//buat perintah untuk mengambil data dari tabel
	$sql="select * from tblbarang where nmbarang like ? order by nmbarang";
	$stmt=$db->prepare($sql);
	$stmt->bind_param("s",$q);
	$stmt->execute();
	$stmt->store_result();
	$row=$stmt->num_rows;
	$stmt->bind_result($kodebrg,$nmbrg,$stok,$harga,$kdjns);
	if($row>0)
	{
		while($stmt->fetch())
		{
			echo "<option value=\"".$kodebrg."\">".$nmbrg."</option>";
		}
		
	}
	$stmt->close();
?>
