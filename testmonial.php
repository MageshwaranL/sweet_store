<div class="relative font-inter antialiased">

    <main class="relative min-h-screen flex flex-col justify-center bg-slate-50 overflow-hidden">
        <div class="w-full max-w-6xl mx-auto px-4 md:px-6 py-24">
            <div class="flex justify-center">

                <!-- Fancy testimonial slider component -->
                <div class="w-full max-w-3xl mx-auto text-center" x-data="slider">
                    <!-- Testimonial image -->
                    <div class="relative h-32">
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[480px] h-[480px] pointer-events-none before:absolute before:inset-0 before:bg-gradient-to-b before:from-indigo-500/25 before:via-indigo-500/5 before:via-25% before:to-indigo-500/0 before:to-75% before:rounded-full before:-z-10">
                            <div class="h-32 [mask-image:_linear-gradient(0deg,transparent,theme(colors.white)_20%,theme(colors.white))]">
                                <!-- Alpine.js template for testimonial images: https://github.com/alpinejs/alpine#x-for -->
                                <template x-for="(testimonial, index) in testimonials" :key="index">
                                    <div x-show="active === index" class="absolute inset-0 -z-10" x-transition:enter="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-700 order-first" x-transition:enter-start="opacity-0 -rotate-[60deg]" x-transition:enter-end="opacity-100 rotate-0" x-transition:leave="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-700" x-transition:leave-start="opacity-100 rotate-0" x-transition:leave-end="opacity-0 rotate-[60deg]">
                                        <img class="relative top-11 left-1/2 -translate-x-1/2 rounded-full" :src="testimonial.img" width="56" height="56" :alt="testimonial.name">
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    <!-- Text -->
                    <div class="mb-9">
                        <div class="relative flex flex-col transition-all duration-150 delay-300 ease-in-out" x-ref="testimonials">
                            <!-- Alpine.js template for testimonials: https://github.com/alpinejs/alpine#x-for -->
                            <template x-for="(testimonial, index) in testimonials" :key="index">
                                <div x-show="active === index" x-transition:enter="transition ease-in-out duration-500 delay-200 order-first" x-transition:enter-start="opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-out duration-300 delay-300 absolute" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-4">
                                    <div class="text-2xl font-bold text-slate-900 before:content-['\201C'] after:content-['\201D']" x-text="testimonial.quote"></div>
                                </div>
                            </template>
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class="        -m-1.5 mt-10 ">
                        <!-- Alpine.js template for buttons: https://github.com/alpinejs/alpine#x-for -->
                        <template x-for="(testimonial, index) in testimonials" :key="index">
                            <button class="inline-flex justify-center whitespace-nowrap rounded-full px-3 py-1.5 m-1.5 text-xs shadow-sm focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300 dark:focus-visible:ring-slate-600 transition-colors duration-150" :class="active === index ? 'bg-indigo-500 text-white shadow-indigo-950/10' : 'bg-white hover:bg-indigo-100 text-slate-900'" @click="active = index; stopAutorotate();">
                                <span x-text="testimonial.name"></span> <span :class="active === index ? 'text-indigo-200' : 'text-slate-300'">-</span> <span x-text="testimonial.role"></span>
                            </button>
                        </template>
                    </div>
                </div>
                <!-- Slider data and functionality: https://github.com/alpinejs/alpine -->
                <script>
                        document.addEventListener('alpine:init', () => {
                            Alpine.data('slider', () => ({
                                active: 0,
                                autorotate: true,
                                autorotateTiming: 3000, // Set the interval to 3 seconds
                                testimonials: [{
                                        img: 'https://cruip-tutorials.vercel.app/fancy-testimonials-slider/testimonial-01.jpg',
                                        quote: "The ability to capture responses is a game-changer. If a user gets tired of the sign up and leaves, that data is still persisted. Additionally, it's great to select between formats.",
                                        name: 'Jessie J',
                                        role: 'Acme LTD'
                                    },
                                    {
                                        img: 'https://cruip-tutorials.vercel.app/fancy-testimonials-slider/testimonial-02.jpg',
                                        quote: "Having the power to capture user feedback is revolutionary. Even if a participant abandons the sign-up process midway, their valuable input remains intact.",
                                        name: 'Nick V',
                                        role: 'Malika Inc.'
                                    },
                                    {
                                        img: 'https://cruip-tutorials.vercel.app/fancy-testimonials-slider/testimonial-03.jpg',
                                        quote: "The functionality to capture responses is a true game-changer. Even if a user becomes fatigued during sign-up and abandons the process, their information remains stored.",
                                        name: 'Amelia W',
                                        role: 'Panda AI'
                                    },
                                ],
                                init() {
                                    if (this.autorotate) {
                                        this.autorotateInterval = setInterval(() => {
                                            this.active = this.active + 1 === this.testimonials.length ? 0 : this.active + 1;
                                            this.heightFix();
                                        }, this.autorotateTiming);
                                    }
                                    this.$watch('active', callback => this.heightFix());
                                },
                                stopAutorotate() {
                                    clearInterval(this.autorotateInterval);
                                    this.autorotateInterval = null;
                                },
                                heightFix() {
                                    this.$nextTick(() => {
                                        this.$refs.testimonials.style.height = this.$refs.testimonials.children[this.active + 1].offsetHeight + 'px';
                                    });
                                },
                            }));
                        });
                    </script>
                <!-- End: Fancy testimonial slider component -->

            </div>
        </div>
    </main>



</div>