<?php
$name=$_POST['name'];
$add= $_POST['add'];
$email=$_POST['email'];
$phon=$_POST['tel'];
$invoice=rand(10000,10000000);
$cdate=date("d F,Y");
$ddate=$_POST['date'];
$date=date('d-M-Y',strtotime($ddate));

$prod=$_POST['product1'];
$quan=$_POST['quan'];
$pric=$_POST['price'];
$price=number_format($pric,1).'';
$sutotal=$price*$quan;
$stotal=number_format($sutotal,1).'';
$gst=($stotal*18)/100;

$total=$gst+$stotal;

require('fpdf.php');
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
$html =
      '<html><head><meta name="charset" content="utf-8">
      </head>
      <body style="color:#000;line-height:22px;" >
      <style>table td{border:1px solid #CCC; padding:10px;font-size:16px;}
      table{width:100%}
        table{text-align:center;}
      </style>'.
      '<div><img src="logo.png" width="200";height="80"></div>'.
      '<h1 style="float:right">Invoice</h1><br><hr>'.
      'From<br><b>Essential Services Outsource PVT LTD</b>
      <br>WS - 195 Phase 2 Mayapuri,<br>
      New Delhi 110064, India
      <br> contact@essentialservices.in<br>
      91-8377825955<br>'.
      '<br><div style="text-align:right;margin-top:-150px;">To <br>'.$name.
      '<br>'.$add.
      '<br>'.$email.
      '<br>'.$phon.'</div>'.
      '<div><table cellspacing="0px" style="width:50%;padding:5px">
      <tr><td><b>Invoice Number</b></td><td>'.$invoice.'</td></tr>
      <tr><td><b>Invoice Date</b></td><td>'.$cdate.'</td></tr>
      <tr><td><b> Due Date</b></td><td>'.$date.'</td></tr>
      </table></div>'.
      '<br><div style=""><table cellspacing="0px" style="text-align:right;">
<tr style="font-weight:bold"><td>S. No.</td><td>Products Name</td><td>Quan.</td><td>Price</td><td>Sub Total</td></tr>
<tr><td>1. </td><td>'.$prod.'</td><td>'.$quan.'</td><td>'.$price.'</td><td>'.$stotal.'</td></tr>
</table></div>'.

'<br><br><br><div><table cellspacing="0px;width:">
<tr><td><b>Sub Total</b></td><td>'.$stotal.'</td></tr>
<tr><td><b>GST</b></td><td>18 %</td></tr>
<tr><td><b>Total Due Amount</b></td><td>'.$total.'</td></tr>
</table></div><br><br>
<img src="sign.png" width="100" height="25"><br>'.
'<b>Payment Mode: Cash</b> '.
'<br> <b>Payment Details:</b> '.
'<br><br><b> Refund policy:</b> If you are not 100% satisfied with your purchase,
you can return the product and get a full refund or exchange the product for
 another one, be it similar or not.
 You can return a product for up to 30 days from the date you purchased it'.

'<br><hr><footer style="text-align:center">Thank you for choosing Essential Services.</footer>'.
      '</body></html>';
$pdf=new FPDF();
$pdf->Addpage();
$dompdf= new Dompdf();
$dompdf->loadHtml($html);
// $dompdf->setPaper('A4',"landscape");
$dompdf->render();
$dompdf->stream($invoice."_".$name."_invoice",array('attachment' => 0));
?>
