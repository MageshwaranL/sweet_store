<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db="sweet_store";
// Create connection
$conn =  mysqli_connect($servername, $username, $password, $db);

// Check connection
if (mysqli_connect_error()) {
  die("Connection failed: " . $conn->connect_error);
}


    if(isset($_POST['purchase']))
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $token = '';

        // Generate timestamp part
        $token .= time();

        // Generate random characters part
        for ($i = 0; $i < $length - strlen((string)time()); $i++) {
            $token .= $characters[rand(0, $charactersLength - 1)];
        }

         $query1="insert into order_manager (full_name,email,pay_mode,token) values('$_POST[name]','$_POST[email]','$_POST[pay_mode]',$token)";
         if(mysqli_query($conn,$query1)==true)
         {
            $order_id=mysqli_insert_id($conn);
            $query2='insert into user_orders(order_id,item_name,price,quantity,token) values(?,?,?,?,?)';
            $stmt=mysqli_prepare($conn,$query2);
            if($stmt)
            {
                mysqli_stmt_bind_param($stmt,'isiis',$order_id,$item_name,$price,$quantity,$token);
                foreach($_SESSION['cart'] as $key=>$values)
                {
                    $item_name=$values['Item_Name'];
                    $price=$values['Item_Price'];
                    $quantity=$values['Item_Quantity'];
                    mysqli_stmt_execute($stmt);
                }
                unset($_SESSION['cart']);
                unset($_SESSION['total']);
                echo "<script>
                     alert('Order Placed');
                     window.location.href='index.php'
                     </script>";

            }else{
                echo "<script>
                     alert('Error Occured');
                     window.location.href='mycart.php'
                     </script>";
            }    

         }else{
            echo "Error: " . $conn->error;
         }
    }

?>