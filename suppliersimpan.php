<?php
	//baca input dari from
	$kode=isset($_POST["txtkode"]) ? $_POST["txtkode"]:"";
	$nama=isset($_POST["txtnama"]) ? $_POST["txtnama"]:"";
	$alamat=isset($_POST["txtalamat"]) ? $_POST["txtalamat"]:"";
	$telp=isset($_POST["txttelp"]) ? $_POST["txttelp"]:"";
	//buat sql untuk insert
	$sql="insert into supplier(kdsupplier,nmsupplier,alamat,telp) values(?,?,?,?)";
	$ins=$db->prepare($sql);
	$ins->bind_param("ssss",$kode,$nama,$alamat,$telp);
	if($ins->execute())
	{
		//jika perintah insert berhasil
		echo "<p>Insert Berhasil...</p>";
		//kembalikan ke form
		echo "<meta http-equiv=\"refresh\"content=\"0;url=?p=supplier\" />";
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
	
	