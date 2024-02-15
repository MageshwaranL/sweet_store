<?php include './Include/navbar.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    
</head>

<body>

    <div class="dark:bg-gray-900 py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-lg px-4 md:px-8">
            <div class="mb-6 sm:mb-10 lg:mb-16">
                <h2 class="mb-4 text-center text-2xl font-bold text-white md:mb-6 lg:text-3xl">Your Cart</h2>
            </div>

            <div class="mb-5 flex flex-col sm:mb-8 sm:divide-y sm:border-t sm:border-b">
              <?php
                if(isset($_SESSION['cart']))
                {
                foreach($_SESSION['cart'] as $key => $item)
                { 
                     
               ?>
                <div class="py-5 sm:py-8">
                    <div class="flex flex-wrap gap-4 sm:py-2.5 lg:gap-6">
                        <div class="sm:-my-2.5">
                            <a href="#" class="group relative block h-40 w-24 overflow-hidden rounded-lg bg-gray-100 sm:h-56 sm:w-40">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($item['Item_image']); ?>" loading="lazy" alt="Product Image" class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />
                    </a>
                        </div>

                        <div class="flex flex-1 flex-col justify-between">
                            <div>
                                <a href="#" class="mb-1 inline-block text-lg font-bold text-white transition duration-100 hover:text-gray-500 lg:text-xl"><?php echo isset($item['Item_Name'])?$item['Item_Name']:"N/A" ?></a>
<!-- 
                                <span class="block text-gray-500">Size: S</span>
                                <span class="block text-gray-500">Color: White</span> -->
                            </div>

                            <div>
                                <span class="mb-1 block font-bold text-white md:text-lg">Rs.<?php echo isset($item['Item_Price'])?$item['Item_Price']:"N/A" ?></span>

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
                                    <!-- <input type="number"  class="flex w-6 flex-1 select-none items-center justify-center bg-white leading-none transition duration-100 hover:bg-gray-100 active:bg-gray-200" />
                                     -->
                                    <!-- <span class="flex w-6 flex-1 select-none items-center justify-center bg-white leading-none transition duration-100 hover:bg-gray-100 active:bg-gray-200">1</span>
                                    <div class="flex flex-col divide-y border-l">
                                        <button class="flex w-6 flex-1 select-none items-center justify-center bg-white leading-none transition duration-100 hover:bg-gray-100 active:bg-gray-200">+</button>
                                        <button class="flex w-6 flex-1 select-none items-center justify-center bg-white leading-none transition duration-100 hover:bg-gray-100 active:bg-gray-200">-</button>
                                    </div> -->
                                  
                                    <div class="flex w-6 flex-1 select-none items-center justify-center bg-white leading-none transition duration-100 hover:bg-gray-100 active:bg-gray-200" id="numericValue" onchange='this.form.submit()'>1</div>
                                    <div class="flex flex-col divide-y border-l">
                                      
                                       <button class="flex w-6 flex-1 select-none items-center justify-center bg-white leading-none transition duration-100 hover:bg-gray-100 active:bg-gray-200" onclick="adjustValue(1)">+</button>
                                        <button class="flex w-6 flex-1 select-none items-center justify-center bg-white leading-none transition duration-100 hover:bg-gray-100 active:bg-gray-200" onclick="adjustValue(-1)">-</button>
                               
                                    </div>
                                   
                                </div>
                                <form action="manage_cart.php" method="POST"> 
                    <button type="submit" name="Remove_Item" class="select-none text-sm font-semibold text-indigo-500 transition duration-100 hover:text-indigo-600 active:text-indigo-700">Delete</button>

                                </form>
                            </div>

                            <div class="ml-4 pt-3 sm:pt-2 md:ml-8 lg:ml-16">
                                <span class="block font-bold text-white md:text-lg">$15.00</span>
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
                <div class="w-full rounded-lg dark:bg-gray-900 p-4 sm:max-w-xs">
                    <div class="space-y-1">
                        <div class="flex justify-between gap-4 text-white">
                            <span>Subtotal</span>
                            <span>$129.99</span>
                        </div>

                        <div class="flex justify-between gap-4 text-white">
                            <span>Shipping</span>
                            <span>$4.99</span>
                        </div>
                    </div>

                    <div class="mt-4 border-t pt-4">
                        <div class="flex items-start justify-between gap-4 text-white">
                            <span class="text-lg font-bold">Total</span>

                            <span class="flex flex-col items-end">
                                <span class="text-lg font-bold">$134.98 USD</span>
                                <span class="text-sm text-white">including VAT</span>
                            </span>
                        </div>
                    </div>
                </div>

               <button class="buy_now inline-block rounded-lg bg-indigo-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base" data-amount="100" data-id="1">Check out</button>

            </div>
            <!-- totals - end -->
        </div>
    </div>
    <script>
    function adjustValue(adjustment) {
        let numericValue = parseInt(document.getElementById("numericValue").innerText);
        numericValue += adjustment;
      
        // Ensure the value doesn't go below 1
        numericValue = Math.max(1, numericValue);

        document.getElementById("numericValue").innerText = numericValue;

        // Send AJAX request to update session count in PHP
        // let xhr = new XMLHttpRequest();
        // xhr.open("POST", "manage_cart.php", true);
        // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // xhr.onreadystatechange = function () {
        //     if (xhr.readyState == 4 && xhr.status == 200) {
        //         // Handle the response, if needed
        //         console.log(xhr.responseText);
        //         // Redirect to mycart.php
        //         window.location.href = 'mycart.php';
        //     }
        // };
        // xhr.send("Item_Name=" + itemName + "&Mod_Quantity=" + newQuantity);
    }
</script>



<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  $('body').on('click', '.buy_now', function(e){
    var totalAmount = $(this).attr("data-amount");
    var product_id =  $(this).attr("data-id");
    var options = {
      "key": "rzp_test_coemrweGrm2ve0",
      "amount": (totalAmount * 100), // Convert amount to paisa
      "name": "Sweet Em",
      "description": "Payment",
      "image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
      "handler": function (response){
        $.ajax({
          url: 'https://sweet.newtheme.shop/sweet.newtheme.shop/payment-proccess.php',
          type: 'post',
          dataType: 'json',
          data: {
            razorpay_payment_id: response.razorpay_payment_id,
            totalAmount: totalAmount,
            product_id: product_id
          }, 
          success: function (msg) {
            window.location.href = 'https://sweet.newtheme.shop/sweet.newtheme.shop/payment-success.php';
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