<script src="selectbarang.js"></script>
<script type="text/javascript">
function validasi()
{
	var valList = document.getElementById("listbarang").value;
	var valStk = document.getElementById("txtstok").value;
	if(valList == "" && valStk != "")
	{
		alert("Barang belum dipilih");
		return false;
	}
	else if(valList != "" && valStk == "")
	{
		alert("Stok belum diisi");
		return false;
	}
	else if(valList == "" && valStk == "")
	{
		alert("Form belum lengkap");
		return false;
	}
}
</script>
<?php
	//membaca cookie supplier
	$sup=isset($_COOKIE["supplier"]) ? $_COOKIE["supplier"]:"";
	//mencari data supplier
	$sql="select * from supplier where kdsupplier = ?";
	$res=$db->prepare($sql);
	$res->bind_param("s",$sup);
	$res->execute();
	$res->bind_result($kodesup,$nmsup,$alamat,$telp);
	$res->fetch();
	$res->close();
?>	
<form action="setbarang.php" method="post" autocomplete="off" onsubmit="return validasi()">
<div id="form">
	<div id="form-title">PENERIMAAN - BARANG</div>
    <table>
    	<tr>
        	<td>Supplier</td>
            <td>: <b><?php echo $nmsup." - ".$kodesup;?></b></td>
        </tr>
        <tr>
        	<td>Alamat</td>
            <td>: <b><?php echo $alamat;?></b></td>
        </tr>
        <tr>
        	<td>Telp</td>
            <td>: <b><?php echo $telp;?></b></td>
        </tr>
    </table>
    
    <table width="100%" border="0">
  <tr>
    <td width="19%" valign="top">Nama Barang</td>
    <td width="81%"><input name="txtnama" type="text" id="txtnama" size="25" maxlength="25" placeholder="Ketik Nama Barang..." onkeyup=										"showbarang(this.value)" />
      <br />
      <select name="listbarang" size="6" id="listbarang" style="width:250px">
      	<?php
			$sql="select * from tblbarang order by nmbarang";
			$stmt=$db->query($sql);
			if($stmt->num_rows>0)
			{
				while($row=$stmt->fetch_object())
				{
					echo "<option value=\"".$row->kdbarang."\">".$row->nmbarang."</option>";
				}
			}
		?>
      </select></td>
  </tr>
  <tr>
    <td>Stok Masuk</td>
    <td><input name="txtstok" type="text" id="txtstok" size="11" maxlength="25" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="simpan" id="simpan" value="Tambah Barang Masuk" />
      <input name="button2" type="button" value="Batal" id="button2" onClick="location.href='clearpenerimaan.php?opt=cancel'"/></td>
  </tr>
</table>
</div>
</form>
<h2>DATA BARANG MASUK</h2>
<table width="100%" class="keren">
  <tr>
    <th width="4%">NO</th>
    <th width="14%">KODE BARANG</th>
    <th width="22%">NAMA BARANG</th>
    <th width="11%">STOK MASUK</th>
    <th>OPSI</th>
  </tr>
  <?php
	if(isset($_COOKIE["barangterima"]))
	{
		$nmr=1;
		foreach($_COOKIE["barangterima"] as $name=>$value)
		{
			$data=explode("#",$value);
			// cari nama barang berdasarkan value saat ini
			$sql="select nmbarang from tblbarang where kdbarang=?";
			$res=$db->prepare($sql);
			$res->bind_param("s",$data[0]);
			$res->execute();
			$res->bind_result($namabrg);
			$res->fetch();
			$res->close();
			echo "<tr>
					<td align=\"center\">$nmr</td>
					<td align=\"center\">".$data[0]."</td>
					<td align=\"center\">".$namabrg."</td>
					<td align=\"center\">".$data[1]."</td>
					<td align=\"center\">
						<a href=\"cookieterimahapus.php?index=".$name."\" onclick=\"return confirm('Yakin akan menghapus barang terima ini?')\">Hapus</a>
					</td>
				</tr>";
			$nmr++;
		}
		echo "<tr>
				<td colspan=\"5\" align=\"center\">
					<button onclick=\"location.href='home.php?p=penerimaansimpan'\">
					<img src=\"images/save.png\" width=\"20\" align=\"left\" />&nbsp;
						Simpan Penerimaan
					</button>
				</td>
			</tr>";
	}
	else
	{
		echo "<tr>
				<td colspan=\"7\" align=\"center\">SILAKAN TAMBAH BARANG MASUK</td>
			</tr>";
	}
  ?>
  </table>


