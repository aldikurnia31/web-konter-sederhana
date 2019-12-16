<?php
	//baca variabel kd dari link
	$kd=isset($_REQUEST["kd"]) ? $_REQUEST["kd"]:"";
	//buat sql untuk insert
	$sql="delete from tbljnsbarang where kdjns=?";
	$ins=$db->prepare($sql);
	$ins->bind_param("s",$kd);
	if($ins->execute())
	{
		//jika perintah insert berhasil
		echo "<p>Delete Berhasil...</p>";
		//kembalikan ke form
		echo "<meta http-equiv=\"refresh\"content=\"0;url=?p=jenisbarang\"/>";
	}
	else
	{
		//jika perintah Delete gagal
		?>
        <div id="eror" style="display:none">
        	Delete Gagal!<br>
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
	
	