<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table style="width:100mm;">
       


              

      <?php  for ($i=0; $i <$pcount ; $i++) { ?>
         <tr>
         <td style="width:50%;">
              <?php 
        
echo DNS1D::getBarcodeHTML($product->product_code, $barcode_format,$pheight,$pweight);
          
?>


<?php
    if (in_array('description', $plabels)) { ?>
         <br>
        <span>{{$product->description}}</span>

<?php    }
?>


<?php
    if (in_array('product_name', $plabels)) { ?>
         <br>
        <span>{{$product->product_name}}</span>

<?php    }
?>


<?php
    if (in_array('selling_price', $plabels)) { ?>
         <br>
        <span>{{$product->selling_price}}</span>

<?php    }
?>
<?php
    if (in_array('product_code', $plabels)) { ?>
         <br>
        <span>{{$product->product_code}}</span>

<?php    }
?>
<?php
    if (in_array('part_no', $plabels)) { ?>
        <br>
        <span>{{$product->part_no}}</span>

<?php    }
?>

   </td>
  </tr>
      <?php }?>


           
            




      
    </table>

  
</body>
</html>