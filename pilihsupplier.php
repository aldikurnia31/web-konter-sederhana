<script src="selectsupplier.js"></script>
<form action="" method="post" autocomplete="off">
<div id="form">
	<div id="form-title">PENERIMAAN - PILIH SUPPLIER</div>
    <table width="100%" border="0">
      <tr>
        <td width="12%">&nbsp;</td>
        <td width="88%">&nbsp;</td>
      </tr>
      <tr>
        <td>Nama Supplier</td>
        <td><input name="txtnmsupplier" type="text" id="txtnmsupplier" size="50" maxlength="50" placeholder="Ketik Nama Supplier..." onkeyup="showsupplier(this.value)"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
         <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
</div>
</form>
<div id="list">
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
  	$sql="select * from supplier order by nmsupplier";
	$stmt=$db->query($sql);
	if($stmt->num_rows>0)
	{
		$nmr=1;
		while($row=$stmt->fetch_object())
		{
			echo "<tr>
					<td align=\"center\">$nmr</td>
					<td align=\"center\">".$row->kdsupplier."</td>
					<td align=\"center\">".$row->nmsupplier."</td>
					<td align=\"center\">".$row->alamat."</td>
					<td align=\"center\">".$row->telp."</td>
					<td align=\"center\">
						<a href=\"setsupplier.php?kd=".$row->kdsupplier."\">Pilih</a> |
					</td>
				</tr>";
			$nmr++;
		}
	}
	else
	{
		echo"<tr>
				<td colspan=\"7\" align=\"center\">DATA MASIH KOSONG</td>
			</tr>";
	}
	?>
 </table>
</div>