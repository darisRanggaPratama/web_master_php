<html><head><title>Insert Data Siswa</title></head>
<body>
   <form method="post" action="insert.php">
      <table border=1 cellpadding="5" cellspacing="0">
         <tr bgcolor="silver">
             <td Colspan="3" align="center"><H3>DATA SISWA</H3></td>
         </tr>   
         <tr>
             <td>NIS</td>
             <td>:</td>
             <td><input type="text" name="txtnis" size="10"></td>
         </tr>   
         <tr>
             <td>NAMA</td>
             <td>:</td> 
             <td><input type="text" name="txtnama" size="50"></td>
         </tr>   
         <tr>
             <td>UMUR</td>
             <td>:</td> 
             <td><input type="text" name="txtumur" size="5"></td>
         </tr>   
         <tr>
             <td>SEKS</td>
             <td>:</td> 
             <td>
                <input type="radio" name="rdoseks" value="PRIA">PRIA
                <input type="radio" name="rdoseks" value="WANITA">WANITA
             </td>
         </tr>   
         <tr align="center">
             <td colspan="3">
                <input type="submit" value="INSERT">
                <input type="reset" value="BATAL">
                <?php echo "\t [<a href=index.php>Lihat Data Siswa</a>]"; ?>
             </td>
         </tr>   
      </table>
   </form>
</body>
</html>
