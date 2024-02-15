
<?php include 'connection.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <!-- Alphin alpinejs  -->
    <!--<script src="//unpkg.com/alpinejs" defer></script>-->
  <script src="https://cdn.tailwindcss.com"></script>
    <link href="./output.css" rel="stylesheet">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
<style>
    #preloader {
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 9999;
    }

    .animate-spin {
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>

    <script>
    tailwind.config = {
        darkMode: "class",
        container: {
            padding: {
                DEFAULT: '1rem',
                sm: '2rem',
                lg: '4rem',
                xl: '5rem',
                '2xl': '6rem',
            },
        },
        theme: {
            container: {
                center: true,
            },
            fontFamily: {
                sans: ["Roboto", "sans-serif"],
                body: ["Roboto", "sans-serif"],
                mono: ["ui-monospace", "monospace"],
            },
        },

    };
    </script>


</head>

<body>
    
  
  <?php   include(__DIR__ . '/Include/navbar.php'); ?>

    
    
    
    <?php include 'banner.php'; ?>
    
 <!--product categories-->
    
    <!-- <?php  print_r($_SESSION['cart']);?>
    <?php  print_r("Total ".$_SESSION['total']);?>    -->
    <div class="dark:bg-gray-900 py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">

        <?php
            $query = "SELECT DISTINCT product_category FROM `products`;"; 
  
            $result = $conn->query($query); 
            if ($result->num_rows > 0)  
            { 
                $first_product=true; 
                $first_category=true;
                while($row = $result->fetch_assoc()) 
                { 
              ?> 
            <div class="mb-6 flex items-end justify-between gap-4">
<h2 class="text-2xl font-bold dark:text-white text-[#382bf0]  lg:text-3xl text-center"><?php echo $row['product_category'];?></h2>

               <button class="flex items-center px-4 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
    <svg class="w-5 h-5 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
    </svg>

    <span class="mx-1">Show More</span>
</button>
            </div>

            <div class="grid gap-x-4 gap-y-8 sm:grid-cols-2 md:gap-x-6 lg:grid-cols-3 xl:grid-cols-4">
          

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
                            <span class="font-bold dark:text-white text-[#382bf0]  lg:text-lg"><?php echo $row['product_name']; ?></span>
                            <span class="font-bold dark:text-white text-[#382bf0] lg:text-lg">₹ <?php echo $row['product_price']; ?></span>
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
                                 <!--<input type="hidden" name="item_price" value="<?php echo $row['product_image']; ?>">-->
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
    
    
    
    
    
    
    
    
   

   
    

    
    
    
    
    
    
    
    
    
    
   
    <?php  include(__DIR__ . '/Include/footer.php'); ?>
    

    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>



     <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en', // Set the default language of your page (e.g., English)
            includedLanguages: 'ta,en,hi,mr', // Set the supported languages
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false
        }, 'google_translate_element');
    }
    </script>
<script>
    window.addEventListener('load', function () {
        // Hide the preloader when the page is fully loaded
        document.getElementById('preloader').style.display = 'none';
    });
</script>


    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</body>

</html>