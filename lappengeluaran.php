<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LAPORAN PENGELUARAN</title>
<style type="text/css">
body{
	margin:0 0 0 0;
	font-size:medium;
	font-family:Arial, Helvetica, sans-serif;
	color:#000;
}
table.report{
	width:100%;
	margin:auto;
	border-width:1px;
	border-spacing:0px;
	border-style:solid;
	border-color:#000;
	border-collapse:collapse;
	background-color:#FFFFFF;
}
table.report th{
	border-width:1px;
	padding:1px;
	border-style:solid;
	border-color:#000;
	background-color:#fff;
	color:#000;
	font-weight:bold;
	text-align:center;
	height:25px;
}
table.report td{
	border-width:1px;
	padding:2px;
	border-style:solid;
	border-color:#000;
	color:#000000;
	height:25px;
}
</style>
</head>
<?php
	include "db/koneksi.php";
	//membaca tanggal periode
	$tgl1=isset($_POST["txttgl1"]) ? $_POST["txttgl1"]:"";
	$tgl2=isset($_POST["txttgl2"]) ? $_POST["txttgl2"]:"";
	
	//mencari data penerimaan pada range tanggal diatas
	$sql="select * from pengeluaran where DATE_FORMAT(tglpengeluaran,'%Y-%m-%d') between ? and ? order by kdpengeluaran";
	$res=$db->prepare($sql);
	$res->bind_param("ss",$tgl1,$tgl2);
	$res->execute();
	$res->store_result();
	$numrow=$res->num_rows;
	$res->bind_result($kdkeluar,$tglkeluar);
?>
<body>
<table width="100%" border="0">
  <tr>
    <td width="13%"><img src="images/comot.jpg" width="100" height="100" /></td>
    <td width="87%" valign="top"><p>Cahaya Cell</p>
    <p>System Inventory</p>
    <p>Laporan Pengeluaran Barang</p></td>
  </tr>
</table>
<p>PERIODE: <?php echo $tgl1." s.d. ".$tgl2; ?></p>
<p>
	<?php
		if($numrow>0)
		{
			while($res->fetch())
			{
				echo "&nbsp;";
				echo "<b>No Trx : </b> ".$kdkeluar."&nbsp;&nbsp;";
				echo "<b>Tgl Trx : </b> ".$tglkeluar."&nbsp;&nbsp;";
				//mencari detail pengeluaran
				$sql="select a.*, b.nmbarang from pengeluaran_detail a, barang b
						where a.kdpengeluaran=? and a.kdbarang=b.kdbarang";
				$stmt=$db->prepare($sql);
				$stmt->bind_param("s",$kdkeluar);
				$stmt->execute();
				$stmt->bind_result($kdkeluar2,$kdbrg,$qty,$nmbrg);
				echo "<table class=\"report\">
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Nama Barang</th>
							<th>Qty</th>
						</tr>";
				$nmr=1;
				while($stmt->fetch())
				{
					echo "<tr>
							<td align=\"center\">$nmr</td>
							<td align=\"center\">$kdbrg</td>
							<td align=\"left\">$nmbrg</td>
							<td align=\"center\">$qty</td>
						</tr>";
						$nmr++;
				}
				echo "</table><p />";
				$stmt->close();
				
			}
			$res->close();
		}
	?>
</p>
</body>
</html>