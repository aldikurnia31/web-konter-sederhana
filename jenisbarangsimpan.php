<?php
	//baca input dari from
	$kode=isset($_POST["txtkode"]) ? $_POST["txtkode"]:"";
	$nama=isset($_POST["txtnama"]) ? $_POST["txtnama"]:"";
	//buat sql untuk insert
	$sql="insert into tbljnsbarang(kdjns,nmjns) values(?,?)";
	$ins=$db->prepare($sql);
	$ins->bind_param("ss",$kode,$nama);
	if($ins->execute())
	{
		//jika perintah insert berhasil
		echo "<p>Insert Berhasil...</p>";
		//kembalikan ke form
		echo "<meta http-equiv=\"refresh\"content=\"0;url=?p=jenisbarang\"/>";
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
	
	