<?php
	//membuat kode otomatis
	$sql="select max(kdbarang) as kdbarang from tblbarang"; //ambil kode paling akhir
	$res=$db->query($sql);
	if($res->num_rows>0) //jika ditemukan
	{
		$row=$res->fetch_object(); //simpan hasil query ke object row
		$kodebaru=(int) substr($row->kdbarang,3); //mengambil nilai angka
		$kodebaru++; //menambahkan nilai akhir
		$kodebaru="BRG".str_pad($kodebaru,2,"0",STR_PAD_LEFT); //bentuk menjdi format kode
	}
	else
	{
		$kodebaru="BRG01";
	}
?>
<form action="?p=barangsimpan" method="post" autocomplete="off">
<div id="form">
	<div id="form-title"> KODE BARANG</div>
    <table width="100%" border="0">
      <tr>
        <td width="13%">Kode Barang</td>
        <td width="87%"><input name="txtkode" type="text" id="txtkode" size="5" maxlength="5"
         readonly="readonly" value="<?php echo $kodebaru;?>"></td>
      </tr>
      <tr>
        <td>Nama Barang</td>
        <td><input name="txtnama" type="text" id="txtnama" size="25" maxlength="25"></td>
      </tr>
      <tr>
        <td>Stok</td>
        <td><input name="txtstok" type="text" id="txtstok" size="11" maxlength="11"></td>
      </tr>
      <tr>
        <td>Harga</td>
        <td><input name="txtharga" type="text" id="txtharga" size="25" maxlength="25"></td>
      </tr>
       <tr>
        <td> Kode Jenis</td>
        <td><input name="txtkdjns" type="text" id="txtkdjns" size="5" maxlength="5"></td>
         
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="simpan" id="simpan" value="Simpan">
        <input type="button" name="Button2" id="Button2" value="Batal" onClick="location.href='home.php'"></td>
      </tr>
    </table>
</div>
</form>
<table width="100%" class="keren">
  <tr>
  	<th>NO</th>
    <th>KODE BARANG</th>
    <th>NAMA BARANG</th>
    <th>STOK</th>
    <th>HARGA</th>
    <th>KODE JENIS</th>
    <th>PILIHAN</th>
  </tr>
  <?php
  	$sql="select * from tblbarang order by kdbarang";
	$stmt=$db->query($sql);
	if($stmt->num_rows>0)
	{
			$nmr=1;
			while($row=$stmt->fetch_object())
			{
				echo "<tr>
						<td align=\"center\">$nmr</td>
						<td align=\"center\">".$row->kdbarang."</td>
						<td align=\"left\">".$row->nmbarang."</td>
						<td align=\"center\">".$row->stok."</td>
						<td align=\"left\">".$row->harga."</td>
						<td align=\"center\">".$row->kdjns."</td>
						<td align=\"center\">
							<a href=\"?p=barangedit&kd=".$row->kdbarang."\">Edit</a>
							<a href=\"?p=baranghapus&kd=".$row->kdbarang."\" onclick=\"return confirm('Yakin akan menghapus data')\">Hapus</a>
								</td>
							</tr>";
							$nmr++;
			}
	}
	else
	{
		echo "<tr>
			<td colspan=\"7\" align=\"center\">DATA MASIH KOSONG</td>
			</tr>";
	}
?>
</table>
