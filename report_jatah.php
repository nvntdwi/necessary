<?php
session_start();
if (isset($_SESSION['nik']))
{
include("koneksi.php"); 
ob_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report Stock Seragam</title>
</head>
<body>
 <bookmark title="Lettre" level="0" ></bookmark>
    <table style="width: 100%; text-align: center; font-size: 14px; margin-top:20px;">
        <tr>
          <td style="width:30%" rowspan="4"><img src="images/oti.png" alt="Logo" width="150"></td>
          <td style="width:70%">REPORT PENGELUARAN BARANG </td>
        </tr>
        <tr>
          <td class="style37">GUDANG</td>
        </tr>
        <tr>
          <td class="style38">EJIP Industrial Park Plot 5C-1 Cikarang Selatan, Bekasi 17550</td>
        </tr>
        <tr>
          <td class="style38">Telp:(62-21) 897 1701 Fax: (62-21) 897 1706 </td>
        </tr>
        <tr>
            <td colspan="2"><hr/></td>
        </tr>
    </table>
    
<table style="background-color:#2980b9; border: solid 1px grey; margin-top:20px;" border="1" bordercolor="#3498db" style="width: 1200px;">
                                    <thead style="text-align:center; height:40px;">
                                        <tr style="background-color:#2980b9; color:white; font-size:16px; padding:5px;">
                                            <th data-sortable='true' style="width:172.5;">Nama Item</th>
											<th data-sortable='true' style="width:172.5;">Stock Keluar</th>
											<th data-sortable='true' style="width:172.5;">PIC</th>
											<th data-sortable='true' style="width:172.5;">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php			
         
                    $sql=mysql_query("select * from tbl_transaksi where tipe='keluar' ");
                    while($a=mysql_fetch_array($sql)){
                        $b=mysql_query("select item from tbl_item where id='$a[id_item]'");
                        $c=mysql_fetch_array($b);
                        $d=mysql_query("select nama from tbl_pic where id='$a[id_pic]'");
                        $e=mysql_fetch_array($d);
                    echo " 
                    <tr>
                        <td style='text-align:center;'>$c[item]</td>
                        <td style='text-align:center;'>$a[qty]</td>
                        <td style='text-align:center;'>$e[nama]</td>
                        <td style='text-align:center;'>$a[tgl]</td>
                    </tr>";
                    }
                                    
                   
 
?>
                                    

</tbody>
</table>
</body>
</html>
<?php
$filename="laporan-item-masuk.pdf"; 

$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.($content).'</page>';
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
try
{
$html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
$html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>
<?php
}
			else{
				echo"Anda harus login telebih dahulu";
			}
?>