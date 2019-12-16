<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LAPORAN PENERIMAAN</title>
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
	$sql="select * from penerimaan where DATE_FORMAT(tglpenerimaan,'%Y-%m-%d') between ? and ? order by kdpenerimaan";
	$res=$db->prepare($sql);
	$res->bind_param("ss",$tgl1,$tgl2);
	$res->execute();
	$res->store_result();
	$numrow=$res->num_rows;
	$res->bind_result($kdterima,$tglterima,$kodesup);
?>
<body>
<table width="100%" border="0">
  <tr>
    <td width="13%"><img src="images/comot.jpg" width="100" height="100" /></td>
    <td width="87%" valign="top"><p>Cahaya Cell</p>
    <p>System Inventory</p>
    <p>Laporan Penerimaan Barang</p></td>
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
				//mencari nama supplier
				$sql="select nmsupplier from supplier where kdsupplier=?";
				$stmt=$db->prepare($sql);
				$stmt->bind_param("s",$kodesup);
				$stmt->execute();
				$stmt->bind_result($namasup);
				$stmt->fetch();
				$stmt->close();
				echo "<b>No Trx : </b> ".$kdterima."&nbsp;&nbsp;";
				echo "<b>Tgl Trx : </b> ".$tglterima."&nbsp;&nbsp;";
				echo "<b>Supplier : </b> ".$namasup."&nbsp;&nbsp;";
				//mencari detail penerimaan
				$sql="select a.*, b.nmbarang from penerimaan_detail a, tblbarang b
						where a.kdpenerimaan=? and a.kdbarang=b.kdbarang";
				$stmt=$db->prepare($sql);
				$stmt->bind_param("s",$kdterima);
				$stmt->execute();
				$stmt->bind_result($kdterima,$kdbrg,$qty,$nmbrg);
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