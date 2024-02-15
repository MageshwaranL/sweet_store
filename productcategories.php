<?php include 'connection.php';?>
<?php include './Include/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
<?php  print_r($_SESSION['cart']);?>
    
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">

        <?php
            // SQL QUERY 
            $query = "SELECT DISTINCT product_category FROM `products`;"; 
  
            // FETCHING DATA FROM DATABASE 
            $result = $conn->query($query); 
            if ($result->num_rows > 0)  
            { 
                // OUTPUT DATA OF EACH ROW
                $first_product=true; 
                $first_category=true;
                while($row = $result->fetch_assoc()) 
                { 
              ?> 
            <div class="mb-6 flex items-end justify-between gap-4">
                <h2 class="text-2xl font-bold text-gray-800 lg:text-3xl"><?php echo $row['product_category'];?> </h2>

                <a href="#" class="inline-block rounded-lg border bg-white px-4 py-2 text-center text-sm font-semibold text-gray-500 outline-none ring-indigo-300 transition duration-100 hover:bg-gray-100 focus-visible:ring active:bg-gray-200 md:px-8 md:py-3 md:text-base">Show
                    more</a>
            </div>

            <div class="grid gap-x-4 gap-y-8 sm:grid-cols-2 md:gap-x-6 lg:grid-cols-3 xl:grid-cols-4">
                <!-- product - end -->

                <?php
                    $query1 = "SELECT * FROM `products` where product_category='".$row['product_category']."'"; 
                    $result1 = $conn->query($query1); 
                    while($row = $result1->fetch_assoc()) 
                    { 
                        
                    ?>
                    
                <!-- product - start -->
                <div>
                    <a href="#" class="group relative mb-2 block h-50 overflow-hidden rounded-lg bg-gray-100 lg:mb-3">
                        <!-- <img src="https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&q=75&fit=crop&w=600" loading="lazy" alt="Photo by Galina N" class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />
                        -->
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['product_image']); ?>" class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" /> 
                    </a>

                    <div class="p-4">
                       <form action="manage_cart.php" method="POST">
                           
                        <!-- Product Price -->
                        <div class='flex justify-between items-center'>
                            <span class="font-bold text-gray-800 lg:text-lg"><?php echo $row['product_name']; ?></span>
                            <span class="font-bold text-gray-800 lg:text-lg"><?php echo $row['product_price']; ?></span>
                            <!-- <span class="mb-0.5 text-red-500 line-through">$30.00</span> -->
                            
                        </div>

                        <!-- Action Buttons -->
                        <div class='flex justify-between mt-2'>
                            <!-- Add to Cart Button -->
                            <button type="submit" name="Add_To_Cart" class="block w-3/4 select-none rounded-lg bg-pink-500 py-3.5 px-7 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                Add to Cart
                            </button>
                            <input type="hidden" name="item_name" value="<?php echo $row['product_name']; ?>">
                            <input type="hidden" name="item_price" value="<?php echo $row['product_price']; ?>">
                            <!-- Wishlist Button -->
                            <button class="text-red-400 hover:text-red-500 rounded-lg focus:outline-none border-spacing-1 border-slate-400   shadow-md bg-zinc-300 py-3.5 px-2">
                                <span class=''><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg></span>
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- product - end -->
                <?php    
                 
                }
               ?>
                
                

            </div>
            <br><br>
            <?php
             //$first_category=false;
                }
            }
             $conn->close(); 
            ?>
        </div>
    </div>



</body>

</html>