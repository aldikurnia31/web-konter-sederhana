<?php
	//membuat kode otomatis
	$sql="select max(kdsupplier) as kdsupplier from supplier"; //ambil kode paling akhir
	$res=$db->query($sql);
	if($res->num_rows>0) //jika ditemukan
	{
		$row=$res->fetch_object(); //simpan hasil query ke object row
		$kodebaru=(int) substr($row->kdsupplier,3); //mengambil nilai angka
		$kodebaru++; //menambahkan nilai akhir
		$kodebaru="SPR".str_pad($kodebaru,2,"0",STR_PAD_LEFT); //bentuk menjdi format kode
	}
	else
	{
		$kodebaru="SPR01";
	}
?>
<form action="?p=suppliersimpan" method="post" autocomplete="off">
<div id="form">
	<div id="form-title">SUPPLIER</div>
    <table width="100%" border="0">
      <tr>
        <td width="13%">Kode Supplier</td>
        <td width="87%"><input name="txtkode" type="text" id="txtkode" size="5" maxlength="5"
         readonly="readonly" value="<?php echo $kodebaru;?>"></td>
      </tr>
      <tr>
        <td>Nama Supplier</td>
        <td><input name="txtnama" type="text" id="txtnama" size="50" maxlength="50"></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td><input name="txtalamat" type="text" id="txtalamat" size="100" maxlength="100"></td>
      </tr>
      <tr>
        <td>Telp</td>
        <td><input name="txttelp" type="text" id="txttelp" size="15" maxlength="15"></td>
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
    <th>KODE SUPPLIER</th>
    <th>NAMA SUPPLIER</th>
    <th>ALAMAT</th>
    <th>TELP</th>
    <th>PILIHAN</th>
  </tr>
  <?php
  	$sql="select * from supplier order by kdsupplier";
	$stmt=$db->query($sql);
	if($stmt->num_rows>0)
	{
			$nmr=1;
			while($row=$stmt->fetch_object())
			{
				echo "<tr>
						<td align=\"center\">$nmr</td>
						<td align=\"center\">".$row->kdsupplier."</td>
						<td align=\"left\">".$row->nmsupplier."</td>
						<td align=\"center\">".$row->alamat."</td>
						<td align=\"left\">".$row->telp."</td>
						<td align=\"center\">
							<a href=\"?p=supplieredit&kd=".$row->kdsupplier."\">Edit</a>
							<a href=\"?p=supplierhapus&kd=".$row->kdsupplier."\" onclick=\"return confirm('Yakin akan menghapus data')\">Hapus</a>
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
