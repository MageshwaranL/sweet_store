<?php
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['Add_To_Cart']))
    {
        if(isset($_SESSION['cart']))
        {
          $myitems=array_column($_SESSION['cart'],'Item_Name');
          
          if(in_array($_POST['item_name'],$myitems))
          {
            echo "<script>
            alert('Item Already Added to Card');
            window.location.href='index.php';
            </script>";
         }else{
            $count=count($_SESSION['cart']);
            $_SESSION['cart'][$count]=array(
                'Item_Name'=>$_POST['item_name'],
                'Item_Price'=>$_POST['item_price'],
                'Item_Quantity'=>1
            );

             // Recalculate total and store in session
             $_SESSION['total'] = calculateTotal($_SESSION['cart']);

            echo "<script>
            alert('Item Added');
            window.location.href='index.php';
            </script>";
         }

        }else{
            $_SESSION['cart'][0]=array(
                'Item_Name'=>$_POST['item_name'],
                'Item_Price'=>$_POST['item_price'],
                'Item_Quantity'=>1
            );

             // Store initial total in session
             $_SESSION['total'] = calculateTotal($_SESSION['cart']);

            echo "<script>
            alert('Item Added');
            window.location.href='index.php';
            </script>";
            // print_r($_SESSION['cart']);
        }
    }

    if(isset($_POST['Remove_Item']))
    {   
        foreach($_SESSION['cart'] as $key => $item)
        {
          
             if($item['Item_Name']==$_POST['Item_Name'])
             {
             unset($_SESSION['cart'][$key]);
             $_SESSION['cart']=array_values($_SESSION['cart']);
            // Recalculate total and store in session
            $_SESSION['total'] = calculateTotal($_SESSION['cart']);
            echo $_SESSION['total'];
             
             }
        }
    }
    if(isset($_POST['Mod_Quantity']))
    {
        foreach($_SESSION['cart'] as $key => $item)
        {
          
             if($item['Item_Name']==$_POST['Item_Name'])
             {
             $_SESSION['cart'][$key]['Item_Quantity']=$_POST['Mod_Quantity'];   
              // Recalculate total and store in session
              $_SESSION['total'] = calculateTotal($_SESSION['cart']);
              echo $_SESSION['total'];
            //  echo "<script>
            
            //  window.location.href='mycart.php'
            //  </script>";
             }
        }   
    }
}

// Function to calculate total from cart array
function calculateTotal($cart)
{
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['Item_Price'] * $item['Item_Quantity'];
    }
    return $total;
}
?>