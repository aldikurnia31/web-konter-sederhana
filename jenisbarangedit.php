<?php
	//baca variabel kd dari link
	$kd=isset($_REQUEST["kd"]) ? $_REQUEST["kd"]:"";
	
	//cari data dari tabel database bedasarkan kd di atas 
	$sql="select * from tbljnsbarang where kdjns=?";
	$res=$db->prepare($sql);
	$res->bind_param("s",$kd);
	$res->execute();
	$res->bindresult($kdjns,$nmjns);
	$res->fetch();
	$res->close();
	//selanjutnya menampilkan hasil query pada textbox masing2
?>
<form action="?p=jenisbarangupdate" method="post" autocomplete="off">
<div id="form">
	<div id="form-title">EDIT JENIS BARANG</div>
    <table width="100%" border="0">
      <tr>
        <td width="13%">Kode Jenis</td>
        <td width="87%"><input name="txtkode" type="text" id="txtkode" size="3" maxlength="3"
         readonly="readonly" value="<?php echo $kdjns;?>"></td>
      </tr>
      <tr>
        <td>Nama Jenis</td>
        <td><input name="txtnama" type="text" id="txtnama" size="25" maxlength="25" value="<?php
		echo $nmjns;?>"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="simpan" id="simpan" value="Update">
        <input type="button" name="Button2" id="Button2" value="Batal" onClick="location.href='?p=jenisbarang.php'"></td>
      </tr>
    </table>
</div>
</form>

