<?php
	//baca variabel kd dari link
	$kd=isset($_REQUEST["kd"]) ? $_REQUEST["kd"]:"";
	
	//cari data dari tabel database bedasarkan kd di atas 
	$sql="select * from supplier where kdsupplier=?";
	$res=$db->prepare($sql);
	$res->bind_param("s",$kd);
	$res->execute();
	$res->bind_result($kdsupplier,$nmsupplier,$alamat,$telp);
	$res->fetch();
	$res->close();
	//selanjutnya menampilkan hasil query pada textbox masing2
?>
<form action="?p=supplierupdate" method="post" autocomplete="off">
<div id="form">
	<div id="form-title">EDIT Supplier</div>
    <table width="100%" border="0">
      <tr>
        <td width="13%">Kode Supplier</td>
        <td width="87%"><input name="txtkode" type="text" id="txtkode" size="5" maxlength="5"
         readonly="readonly" value="<?php echo $kdsupplier;?>"></td>
      </tr>
      <tr>
        <td>Nama Supplier</td>
        <td><input name="txtnama" type="text" id="txtnama" size="50" maxlength="50" value="<?php
		echo $nmsupplier;?>"></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td><input name="txtalamat" type="text" id="txtalamat" size="100" maxlength="100" value="<?php
		echo $alamat;?>"></td></td>
      </tr>
      <tr>
        <td>Telp</td>
        <td><input name="txttelp" type="text" id="txttelp" size="15" maxlength="15" value="<?php
		echo $telp;?>"></td></td>
      </tr>
      <tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="simpan" id="simpan" value="Update">
        <input type="button" name="Button2" id="Button2" value="Batal" onClick="location.href='?p=supplier.php'"></td>
      </tr>
    </table>
</div>
</form>

