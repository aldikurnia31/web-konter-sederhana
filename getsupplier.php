<table width="100%" class="keren">
  <tr>
    <th>NO</th>
    <th>KODE SUPPLIER</th>
    <th>NAMA SUPPLIER</th>
    <th>ALAMAT</th>
    <th>TELEPON</th>
    <th>PILIHAN</th>
  </tr>
<?php
$q="%".$_GET["q"]."%";

include "db/koneksi.php";

			
			//buat perintah untuk mengambil data dari tabel
			$sql="select * from supplier where nmsupplier like ? order by nmsupplier";
	$stmt=$db->prepare($sql);
	$stmt->bind_param("s",$q);
	$stmt->execute();
	$stmt->store_result();
	$row=$stmt->num_rows;
	$stmt->bind_result($kodesup,$namasup,$alamat,$telp);
	if($row>0)
	{
		$nmr=1;
		while($stmt->fetch())
		{
			echo "<tr>
					<td align=\"center\">$nmr</td>
					<td align=\"center\">".$kodesup."</td>
					<td align=\"center\">".$namasup."</td>
					<td align=\"center\">".$alamat."</td>
					<td align=\"center\">".$telp."</td>
					<td align=\"center\">
						<a href=\"setsupplier.php?kd=".$kodesup."\">Pilih</a> |
					</td>
				</tr>";
			$nmr++;
		}
	}
	else
	{
		echo"<tr>
				<td colspan=\"7\" align=\"center\">DATA TIDAK DITEMUKAN</td>
			</tr>";
	}
?>
</table>
