<?php
	//membuat kode pengeluaran
	$sql="select max(kdpengeluaran) as kdmax from pengeluaran";
	$res=$db->query($sql);
	if($res->num_rows > 0) //jika data ditemukan
	{
		$row=$res->fetch_object();
		if(substr($row->kdmax,1,6) <date("Ym")) //apakah bulan berganti
		{
			//reset kode ke 001
			$kode="K".date("Ym")."001";
		}
		else
		{
			//tambahkan nomor seri berikutnya
			$kode=(int) substr($row->kdmax,7);
			$kode++;
			$kode="K".date("Ym").str_pad($kode,3,"0",STR_PAD_LEFT);
		}
	}
	else
	{
		$kode="K".date("Ym")."001";
	}
	$tglkeluar=date("Y-m-d H:i:s");
	//simpan data ke pengeluaran
	$sql="insert into pengeluaran(kdpengeluaran,tglpengeluaran)
			values(?,?)";
	$ins=$db->prepare($sql);
	$ins->bind_param("ss", $kode, $tglkeluar);
	if($ins->execute())
	{
		$ins->close();
		//jika simpan pengeluaran berhasil, lanjut ke simpan pengeluaran_detail
		//loop cookie barang keluar untuk disimpan
		if(isset($_COOKIE["barangkeluar"]))
		{
			foreach($_COOKIE["barangkeluar"] as $name=>$value)
			{
				$data=explode("#",$value);
				$sqld="insert into pengeluaran_detail(kdpengeluaran,kdbarang,qty)
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
				$stokbaru=$stokawal-$data[1];
				//update jumalh stok baru
				$sqlu="update tblbarang set stok=? where kdbarang=?";
				$upd=$db->prepare($sqlu);
				$upd->bind_param("ss", $stokbaru, $data[0]);
				$upd->execute();
				$upd->close();
				
			}
		}
		//buka halaman clearpengeluaran untuk membersihkan cookie barangkeluar
		echo "<meta http-equiv=\"refresh\" content=\"0;url=clearpengeluaran.php?opt=y\" />";
	}
	else
	{
		?>
        <script type="text/javascript">
			alert('PERHATIAN\nSimpan Pengeluaran GAGAL!');
			location.href='javascript:history.go(-1)';
		</script>
        <?php
	}
?>