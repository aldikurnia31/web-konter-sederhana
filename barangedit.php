<?php
	//baca variabel kd dari link
	$kd=isset($_REQUEST["kd"]) ? $_REQUEST["kd"]:"";
	
	//cari data dari tabel database bedasarkan kd di atas 
	$sql="select * from tblbarang where kdbarang=?";
	$res=$db->prepare($sql);
	$res->bind_param("s",$kd);
	$res->execute();
	$res->bind_result($kdbarang,$nmbarang,$stok,$harga,$kdjns);
	$res->fetch();
	$res->close();
	//selanjutnya menampilkan hasil query pada textbox masing2
?>
<form action="?p=barangupdate" method="post" autocomplete="off">
<div id="form">
	<div id="form-title">EDIT BARANG</div>
    <table width="100%" border="0">
      <tr>
        <td width="13%">Kode Barang</td>
        <td width="87%"><input name="txtkode" type="text" id="txtkode" size="5" maxlength="5"
         readonly="readonly" value="<?php echo $kdbarang;?>"></td>
      </tr>
      <tr>
        <td>Nama Barang</td>
        <td><input name="txtnama" type="text" id="txtnama" size="25" maxlength="25" value="<?php
		echo $nmbarang;?>"></td>
      </tr>
      <tr>
        <td>Stock</td>
        <td><input name="txtstok" type="text" id="txtstok" size="11" maxlength="11" value="<?php
		echo $stok;?>"></td></td>
      </tr>
      <tr>
        <td>Harga</td>
        <td><input name="txtharga" type="text" id="txtharga" size="25" maxlength="25" value="<?php
		echo $harga;?>"></td></td>
      </tr>
       <tr>
        <td> Kode Jenis</td>
        <td><input name="txtkdjns" type="text" id="txtkdjns" size="3" maxlength="3"value="<?php
		echo $kdjns;?>"></td></td>
         
      </tr>
      <tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="simpan" id="simpan" value="Update">
        <input type="button" name="Button2" id="Button2" value="Batal" onClick="location.href='?p=barang.php'"></td>
      </tr>
    </table>
</div>
</form>

