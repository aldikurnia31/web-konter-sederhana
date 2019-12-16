<?php
	//baca input dari from
	$kode=isset($_POST["txtkode"]) ? $_POST["txtkode"]:"";
	$nama=isset($_POST["txtnama"]) ? $_POST["txtnama"]:"";
	$stok=isset($_POST["txtstok"]) ? $_POST["txtstok"]:"";
	$harga=isset($_POST["txtharga"]) ? $_POST["txtharga"]:"";
	$kdjns=isset($_POST["txtkdjns"]) ? $_POST["txtkdjns"]:"";
	//buat sql untuk insert
	$sql="insert into tblbarang(kdbarang,nmbarang,stok,harga,kdjns) values(?,?,?,?,?)";
	$ins=$db->prepare($sql);
	$ins->bind_param("sssss",$kode,$nama,$stok,$harga,$kdjns);
	if($ins->execute())
	{
		//jika perintah insert berhasil
		echo "<p>Insert Berhasil...</p>";
		//kembalikan ke form
		echo "<meta http-equiv=\"refresh\"content=\"0;url=?p=barang\" />";
	}
	else
	{
		//jika perintah insert gagal
		?>
        <div id="eror" style="display:none">
        	Insert Gagal!<br>
            Eror NO:<?php echo $ins->errno;?><br />Error Desc:\n<?php echo $ins->error;?>
        </div>
        <script type="text/javasript">
			var msg=document.getElementById('error').innerHTML; //ambil data pesan error
			alert(msg); //tampilkan pesan error
			locltion.href='javasript:history.go(-1)'; //kembali ke form
		</script>
        <?php
	}
?>
	
	