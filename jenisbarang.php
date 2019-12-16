<?php
	//membuat kode otomatis
	$sql="select max(kdjns) as kodejns from tbljnsbarang"; //ambil kode paling akhir
	$res=$db->query($sql);
	if($res->num_rows>0) //jika ditemukan
	{
		$row=$res->fetch_object(); //simpan hasil query ke object row
		$kodebaru=(int) substr($row->kodejns,1); //mengambil nilai angka
		$kodebaru++; //menambahkan nilai akhir
		$kodebaru="J".str_pad($kodebaru,2,"0",STR_PAD_LEFT); //bentuk menjdi format kode
	}
	else
	{
		$kodebaru="J01";
	}
?>
<form action="?p=jenisbarangsimpan" method="post" autocomplete="off">
<div id="form">
	<div id="form-title">JENIS BARANG</div>
    <table width="100%" border="0">
      <tr>
        <td width="13%">Kode Jenis</td>
        <td width="87%"><input name="txtkode" type="text" id="txtkode" size="3" maxlength="3"
         readonly="readonly" value="<?php echo $kodebaru;?>"></td>
      </tr>
      <tr>
        <td>Nama Jenis</td>
        <td><input name="txtnama" type="text" id="txtnama" size="25" maxlength="25"></td>
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
    <th>KODE</th>
    <th>NAMA JENIS</th>
    <th>PILIHAN</th>
  </tr>
  <?php
  	$sql="select * from tbljnsbarang order by kdjns";
	$stmt=$db->query($sql);
	if($stmt->num_rows>0)
	{
			$nmr=1;
			while($row=$stmt->fetch_object())
			{
				echo "<tr>
						<td align=\"center\">$nmr</td>
						<td align=\"center\">".$row->kdjns."</td>
						<td align=\"left\">".$row->nmjns."</td>
						<td align=\"center\">
							<a href=\"?p=jenisbarangedit&kd=".$row->kdjns."\">Edit</a>
							<a href=\"?p=jenisbaranghapus&kd=".$row->kdjns."\" onclick=\"return confirm('Yakin akan menghapus data')\">Hapus</a>
								</td>
							</tr>";
							$nmr++;
			}
	}
	else
	{
		echo "<tr>
			<td colspan=\"4\" align=\"center\">DATA MASIH KOSONG</td>
			</tr>";
	}
?>
</table>
