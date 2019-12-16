<?php
	//membuat kode penerimaan
	$sql="select max(kdpenerimaan) as kdmax from penerimaan";
	$res=$db->query($sql);
	if($res->num_rows > 0) //jika data ditemukan
	{
		$row=$res->fetch_object();
		if(substr($row->kdmax,1,6) <date("Ym")) //apakah bulan berganti
		{
			//reset kode ke 001
			$kode="M".date("Ym")."001";
		}
		else
		{
			//tambahkan nomor seri berikutnya
			$kode=(int) substr($row->kdmax,7);
			$kode++;
			$kode="M".date("Ym").str_pad($kode,3,"0",STR_PAD_LEFT);
		}
	}
	else
	{
		$kode="M".date("Ym")."001";
	}
	$tglterima=date("Y-m-d H:i:s");
	$sup=$_COOKIE["supplier"];
	
	//simpan data ke penrimaan
	$sql="insert into penerimaan(kdpenerimaan,tglpenerimaan,kdsupplier)
			values(?,?,?)";
	$ins=$db->prepare($sql);
	$ins->bind_param("sss", $kode, $tglterima, $sup);
	if($ins->execute())
	{
		$ins->close();
		//jika simpan penerimaan berhasil, lanjut ke simpan penerimaan_detail
		//loop cookie barang terima untuk disimpan
		if(isset($_COOKIE["barangterima"]))
		{
			foreach($_COOKIE["barangterima"] as $name=>$value)
			{
				$data=explode("#",$value);
				$sqld="insert into penerimaan_detail(kdpenerimaan,kdbarang,qty)
						values(?,?,?)";
				$ins_d=$db->prepare($sqld);
				$ins_d->bind_param("sss", $kode, $data[0], $data[1]);
				$ins_d->execute();
				$ins_d->close();
				//ambil jumlah stok dari tabel barang untuk barang saat ini
				$sqlb="select stok from tblbarang where kdbarang=?";
				$res=$db->prepare($sqlb);
				$res->bind_param("s", $data[0]);
				$res->execute();
				$res->bind_result($stokawal);
				$res->fetch();
				$res->close();
				$stokbaru=$stokawal+$data[1];
				//update jumalh stok baru
				$sqlu="update tblbarang set stok=? where kdbarang=?";
				$upd=$db->prepare($sqlu);
				$upd->bind_param("ss", $stokbaru, $data[0]);
				$upd->execute();
				$upd->close();
				
			}
		}
		//buka halaman clearpenerimaan untuk membersihkan cookie barangterima
		echo "<meta http-equiv=\"refresh\" content=\"0;url=clearpenerimaan.php?opt=y\" />";
	}
	else
	{
		?>
        <script type="text/javascript">
			alert('PERHATIAN\nSimpan Penerimaan GAGAL!');
			location.href='javascript:history.go(-1)';
		</script>
        <?php
	}
?>