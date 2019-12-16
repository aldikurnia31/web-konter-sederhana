<script src="maskedinput/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="maskedinput/jquery.maskedinput.js" type="text/javascript"></script>
<script>
jQuery(function($){
   $("#txttgl1").mask("9999-99-99",{placeholder:"____-__-__"});
   $("#txttgl2").mask("9999-99-99",{placeholder:"____-__-__"});

});
</script>
<form action="lappengeluaran.php" method="post" autocomplete="off" target="_blank">
<div id="form">
	<div id="form-title">SET LAPORAN PENGELUARAN</div>
    <table width="100%" border="0">
      <tr>
        <td width="12%">&nbsp;</td>
        <td width="88%">&nbsp;</td>
      </tr>
      <tr>
        <td>Tanggal Pengeluaran</td>
        <td><input name="txttgl1" type="text" id="txttgl1" size="10" maxlength="10" placeholder="Tgl Awal" > 
          s.d. <input name="txttgl2" type="text" id="txttgl2" size="10" maxlength="10" placeholder="Tgl Akhir"/> 
           format tanggal: yyyy-mm-dd</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="button" id="button" value="Tampilkan" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
         <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
</div>
</form>
