<?php include './Include/navbar.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>

    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-lg px-4 md:px-8">
            <div class="mb-6 sm:mb-10 lg:mb-16">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Your Cart</h2>
            </div>

            <div class="mb-5 flex flex-col sm:mb-8 sm:divide-y sm:border-t sm:border-b">
              <?php
                $total=0;
                if(isset($_SESSION['cart']))
                {
                foreach($_SESSION['cart'] as $key => $item)
                {
                $total=$total+$item['Item_Price'];
               ?>
                <!-- product - start -->
                <div class=" sm:py-8">
                    <div class="flex flex-wrap gap-4 sm:py-2.5 lg:gap-6">
                        <div class="sm:-my-2.5">
                            <a href="#" class="group relative block h-40 w-40 overflow-hidden rounded-lg bg-gray-100 sm:h-56 sm:w-40">


                                <!-- <img src="https://images.unsplash.com/photo-1612681621979-fffe5920dbe8?auto=format&q=75&fit=crop&w=200" loading="lazy" alt="Photo by Thái An" class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" /> -->
                                <?php
                                    // Connect to the database
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "sweet_store";

                                    $conn = new mysqli($servername, $username, $password, $dbname);

                                    // Check connection
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // Retrieve the blob image data
                                    $sql = "SELECT product_image FROM products WHERE product_name = '".$item['Item_Name']."'"; // Assuming you have a table named 'images' with a column 'image_blob' and primary key 'image_id'
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Output image data
                                        $row = $result->fetch_assoc();
                                        $imageData = base64_encode($row['product_image']); // Convert blob data to base64 format
                                        $src = 'data:image/jpeg;base64,'.$imageData; // Construct the src attribute value with base64 encoded image data
                                        echo '<img src="'.$src.'" loading="lazy" alt="Photo by Thái An" class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />';
                                    } else {
                                        echo "Image not found";
                                    }
                                    $conn->close();
                                    ?>
                           
                            </a>
                        </div>

                        <div class="flex flex-1 flex-col justify-between">
                            <div>
                                <a href="#" class="mb-1 inline-block text-lg font-bold text-gray-800 transition duration-100 hover:text-gray-500 lg:text-xl"><?php echo isset($item['Item_Name'])?$item['Item_Name']:"N/A" ?></a>

                            </div>
                            <div>
                                <span class="mb-1 block font-bold text-gray-800 md:text-lg">Rs.<?php echo isset($item['Item_Price'])?$item['Item_Price']:"N/A" ?></span>

                                <span class="flex items-center gap-1 text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>

                                    In stock
                                </span>
                            </div>
                        </div>

                        <div class="flex w-full justify-between border-t pt-4 sm:w-auto sm:border-none sm:pt-0">
                            <div class="flex flex-col items-start gap-2">
                                <div class="flex h-12 w-20 overflow-hidden rounded border">
                                   
                                    <div class="flex w-6 flex-1 select-none items-center justify-center bg-white leading-none transition duration-100 hover:bg-gray-100 active:bg-gray-200" id="<?php echo $item['Item_Name']."Quantity" ?>" onchange='this.form.submit()'>
                                    <?php echo $item['Item_Quantity']?>
                                    </div>
                                   
                                    <div class="flex flex-col divide-y border-l">
                                      
                                       <button class="flex w-6 flex-1 select-none items-center justify-center bg-white leading-none transition duration-100 hover:bg-gray-100 active:bg-gray-200" onclick="adjustValue(1,'<?php echo isset($item['Item_Name'])?$item['Item_Name']:"N/A"; ?>','<?php echo isset($item['Item_Price'])?$item['Item_Price']:0; ?>','<?php echo $item['Item_Name']."Quantity" ?>','<?php echo $item['Item_Name']."Price" ?>')">+</button>
                                       <button class="flex w-6 flex-1 select-none items-center justify-center bg-white leading-none transition duration-100 hover:bg-gray-100 active:bg-gray-200" onclick="adjustValue(-1,'<?php echo isset($item['Item_Name'])?$item['Item_Name']:"N/A"; ?>','<?php echo isset($item['Item_Price'])?$item['Item_Price']:0; ?>','<?php echo $item['Item_Name']."Quantity" ?>','<?php echo $item['Item_Name']."Price" ?>')">-</button>
                               
                                    </div>
                                   
                                </div>

                                <button class="select-none text-sm font-semibold text-indigo-500 transition duration-100 hover:text-indigo-600 active:text-indigo-700" onclick="removeValue('<?php echo isset($item['Item_Name'])?$item['Item_Name']:'N/A' ?>')">Delete</button>
                            </div>

                            <div class="ml-4 pt-3 sm:pt-2 md:ml-8 lg:ml-16">
                                <span class="block font-bold text-gray-800 md:text-lg" id="<?php echo $item['Item_Name']."Price" ?>">Rs.<?php echo isset($item['Item_Price'])?number_format(($item['Item_Price']*$item['Item_Quantity']),2):"N/A" ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product - end -->
             <?php
                    }
                }
              ?>
                
            </div>

            <!-- totals - start -->
            <div class="flex flex-col items-end gap-4">
                <div class="w-full rounded-lg bg-gray-100 p-4 sm:max-w-xs">
                    

                    <div class="mt-4  pt-4">
                        <div class="flex items-start justify-between gap-4 text-gray-800">
                            <span class="text-lg font-bold">Total</span>

                            <span class="flex flex-col items-end">
                                <span class="text-lg font-bold" id="totals" value="<?php echo isset($_SESSION['total'])?$_SESSION['total']:0; ?>" >Rs.<?php echo isset($_SESSION['total'])?number_format($_SESSION['total'],2):0; ?></span>
                                <input type="hidden" id="totals1" value="<?php echo isset($_SESSION['total'])?number_format($_SESSION['total'],2):0; ?>" >
                                <span class="text-sm text-gray-500">including VAT</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- <button class="inline-block rounded-lg bg-indigo-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base">Check
                    out</button> -->
                    <button class="bg-indigo-500 text-white rounded-md px-4 py-2 hover:bg-indigo-700 transition" onclick="openModal('modelConfirm')" >
                    Check out
                    </button>

            </div>
            <!-- totals - end -->
        </div>
    </div>
    <div id="modelConfirm" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
        <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">

            <div class="flex justify-end p-2">
                <button onclick="closeModal('modelConfirm')" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6 pt-0 text-center">
            <h3 class="text-xl font-bold text-gray-500  mb-6">Payment Details</h3>
               
            <div class="mx-auto max-w-xs">
                <form method="post" action="purchase.php" id="purchase_form">
                    <input
                        class="w-full px-6 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                        type="text" placeholder="Name" name="name" id="name" />
                    <input
                        class="w-full px-6 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                        type="email" id="email" placeholder="Email" name="email" required/>
                    <select name="pay_mode" id="pay_mode" class="w-full px-6 py-3 rounded-lg text-gray-500 font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5">
                        <option value="Payment Mode">Payment Mode</option>
                        <option value="Cash On">Cash On</option>
                        <option  value="UPI Payment">UPI Payment</option>
                        <option  value="Card Payment">Card Payment</option>
                    </select>
                    <button type="button" name="purchase"
                        class="purchase mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                        
                        <span class="ml-3">
                            Pay Now
                        </span>
                    </button>
               </form> 
                
            </div>
                <!-- <a href="#"  onclick="closeModal('modelConfirm')"
                    class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                    Pay Now
                </a> -->
               
            </div>

        </div>
    </div>

<script type="text/javascript">
    window.openModal = function(modalId) {
        document.getElementById(modalId).style.display = 'block'
        document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
    }

    window.closeModal = function(modalId) {
        document.getElementById(modalId).style.display = 'none'
        document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
    }

    
</script>
    
    <script>
    function adjustValue(adjustment,name,price,itemquantity,itemprice) {
       
        let numericValue = parseInt(document.getElementById(itemquantity).innerText);
        numericValue += adjustment;
      
        // Ensure the value doesn't go below 1
        numericValue = Math.max(1, numericValue);

        document.getElementById(itemquantity).innerText = numericValue;
        document.getElementById(itemprice).innerText = "Rs."+(Number( price*numericValue).toFixed(2));
        var total=document.getElementById("totals1").value;
        //console.log(Number(total)+1);
        //document.getElementById("totals").innerText = "Rs."+(Number(total+price).toFixed(2));
        
          // AJAX request
          $.ajax({
                type: "POST",
                url: "manage_cart.php", // Your server-side script
                data: {
                    Mod_Quantity: numericValue,
                    Item_Name:name
                    },
                success: function(response) {
                    //alert(response); // Show the response from the server
                    Swal.fire({
                    title: "Sucess",
                    
                    icon: "success"
                    });
                    response="Rs."+(Number(response).toFixed(2));
                    $('#totals').text(response);
                },
                error: function(error) {
                    alert("Error: " + error.responseText);
                }
            });
        console.log(numericValue+" "+name+" "+price*numericValue);
    }
   
    function removeValue(name) {
       
      
         // AJAX request
         $.ajax({
               type: "POST",
               url: "manage_cart.php", // Your server-side script
               data: {
                   Remove_Item:"Remove_Item",
                   Item_Name:name
                   },
               success: function(response) {
                   //alert(response); // Show the response from the server
                   Swal.fire({
                   title: "Sucess",
                   
                   icon: "success"
                   });
                   location.reload();
               },
               error: function(error) {
                   alert("Error: " + error.responseText);
               }
           });
       
   }
</script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  $('body').on('click', '.purchase', function(e){
    //var totalAmount = $(this).attr("data-amount");
    var totalAmount=$("#totals1").val();
    var name=$("#name").val();
    var email=$("#email").val();
    var paymode=$("#pay_mode").val();
    //console.log(name+" "+email+" "+paymode);
    // var product_id =  $(this).attr("data-id");
    var options = {
      "key": "rzp_test_coemrweGrm2ve0",
      "amount": (totalAmount * 100), // Convert amount to paisa
      "name": "Sweet Em",
      "description": "Payment",
      "image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
      "handler": function (response){
        $.ajax({
          url: 'http://localhost/sweet.newtheme.shop/payment-proccess.php',
          type: 'post',
          dataType: 'json',
          data: {
            razorpay_payment_id: response.razorpay_payment_id,
            totalAmount: totalAmount
            // product_id: product_id
          }, 
          success: function (msg) {
            //console.log("success");
            $.ajax({
                url:'http://localhost/sweet.newtheme.shop/purchase.php',
                type:'post',
                data:{
                    name:name,
                    email:email,
                    pay_mode:paymode,
                    purchase:1
                },success:function(msg){
                    window.location.href = 'http://localhost/sweet.newtheme.shop/payment-success.php';
                }
            })
            //$('#purchase_form').submit();
            
          }
        });
      },
      "theme": {
        "color": "#528FF0"
      }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
    e.preventDefault();
  });
</script>
</body>

</html>