<template>
    <div class="slides">
        <div class="slides__img" v-for="(image, index) in images" :key="index">
            <img :src="image.src" alt="" v-if="index == active">
        </div>

        <span class="prev" @click="prev()">
            <font-awesome-icon icon="fa-solid fa-chevron-left" />
        </span>

        <span class="next" @click="next()">
            <font-awesome-icon icon="fa-solid fa-chevron-right" />
        </span>

        <ul class="dots">
            <li v-for="(dot, index) in images" :class="{ active: index === active }" @click="jump(index)" :key="index">
            </li>
        </ul>
    </div>
</template>
  
<script>
export default {
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

        jump(index) {
            this.active = index
        }
    }
}
</script>
  
<style lang="scss" scoped>
$primary: #221e21;

.slides {
    width: 100%;
    height: 422px;
    position: relative;

    &__img {

        img {
            height: 422px;
            width: 100%;
            object-fit: cover;
            transition: all ease-in-out 0.5s;
        }
    }

    .prev,
    .next {
        position: absolute;
        top: 50%;
        width: 50px;
        height: 50px;
        border: 2px solid #221e21;
        color: #221e21;
        border-radius: 50%;
        cursor: pointer;
        line-height: 48px;
        text-align: center;
        text-indent: -2px;
        transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transform: translateY(-50%);

        &:active {
            transform: translate(0, 3px) scale(1.2);
        }
    }

    .next {
        right: 5%;
    }

    .prev {
        left: 5%;
    }

    .dots {
        position: absolute;
        display: block;
        width: 100%;
        text-align: center;
        bottom: 6%;

        li {
            width: 6px;
            height: 6px;
            border-radius: 3px;
            background: $primary;
            opacity: 0.2;
            display: inline-block;
            margin: 0 3px;
            cursor: pointer;
            transition: opacity 0.4s ease-in-out, width 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);

            &.active {
                width: 22px;
                opacity: 1;
            }
        }
    }
}
</style>