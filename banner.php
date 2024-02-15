<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Alphin alpinejs  -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <link href="./output.css" rel="stylesheet">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

    <title>Document</title>
</head>

<body>



    <div class="w-full flex ">
        <div class="w-full">
            <div x-data="{ activeSlide: 1, slideCount: 3 }" class="overflow-hidden relative">
                <!-- Slider -->
                <!-- You can remove x-init if you dont want to autoplay -->
                <div class="whitespace-nowrap transition-transform duration-500 ease-in-out" :style="'transform: translateX(-' + (activeSlide - 1) * 100.5 + '%)'" x-init="setInterval(() => { activeSlide = activeSlide < slideCount ? activeSlide + 1 : 1 }, 5000)">
                    <!-- Item 1 -->
                    <div class="inline-block w-full">
                        <img src="./Assest/banner.jpg" alt="" />
                    </div>
                    <!-- Item 2 -->
                    <div class="inline-block w-full">
                        <img src="./Assest/banner2.jpg" alt="" />
                    </div>
                    <!-- Item 3 -->
                    <div class="inline-block w-full">
                        <img src="./Assest/banner3.jpg" alt="" />
                    </div>
                </div>

                <!-- Prev/Next Arrows -->
                <div class="absolute inset-0 flex items-center justify-between px-2">
                    <button @click="activeSlide = activeSlide > 1 ? activeSlide - 1 : slideCount" class="w-[30px] h-[30px] flex items-center bg-black/30 text-white p-2 rounded-full">
                        &#8592;
                    </button>
                    <button @click="activeSlide = activeSlide < slideCount ? activeSlide + 1 : 1" class="w-[30px] h-[30px] flex items-center bg-black/30 text-white p-2 rounded-full">
                        &#8594;
                    </button>
                </div>

                <!-- Dots Navigation -->
                <div class="absolute bottom-0 left-0 right-0 flex justify-center space-x-2 p-4">
                    <template x-for="slideIndex in slideCount" :key="slideIndex">
                        <button @click="activeSlide = slideIndex" class="h-2 w-2 rounded-full" :class="{'bg-orange-500': activeSlide === slideIndex, 'bg-white/50': activeSlide !== slideIndex}"></button>
                    </template>
                </div>
            </div>
        </div>
    </div>

</body>

</html>