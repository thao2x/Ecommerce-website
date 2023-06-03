<template>
    <div ref="swiper" class="swiper slides">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide slides__img" v-for="(image, index) in images" :key="index">
                <img :src="getCurrentImage(image.src)" />
            </div>
        </div>

        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <!-- <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div> -->

        <!-- If we need scrollbar -->
        <div class="swiper-scrollbar"></div>
    </div>
</template>
  
<script>
import { mixin } from '@/mixin'
import Swiper, { Navigation, Pagination } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

export default {
    mixins: [mixin],
    props: {
        images: {
            type: [],
            required: true
        },
    },
    data() {
        return {
            active: 0
        }
    },
    mounted() {
        const self = this;
        setTimeout(function () {
            new Swiper(self.$refs.swiper, {
                // configure Swiper to use modules
                modules: [Navigation, Pagination],
                // Optional parameters
                loop: true,

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

                // And if we need scrollbar
                scrollbar: {
                    el: '.swiper-scrollbar',
                },
            })
        }, 1000);
    },
    methods: {
        prev() {
            this.active--;
            if (this.active < 0) {
                this.active = this.images.length - 1;
            }
        },

        next() {
            this.active++;
            if (this.active == this.images.length) {
                this.active = 0;
            }
        },

        onSwiper() {
            console.log(register);
        },

        onSlideChange() {
            console.log('slide change');
        }
    }
}
</script>
  
<style lang="scss" scoped>
.slides {
    width: 100%;
    height: 422px;
    display: flex;
    justify-content: center;
    align-items: center;

    &__img {

        img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transition: all ease-in-out 0.5s;
        }
    }
}
</style>