<template>
    <div class="form">
        <BackButton :value="''" class="backBtn"></BackButton>

        <div class="slides">
            <div class="slides__img" v-for="(image, index) in images" :key="index">
                <img :src="image.url_img" alt="" v-if="index == active">
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

        <div class="intro">
            <div class="intro__name">
                <p>Air Jordan 3 Retro</p>
                <font-awesome-icon icon="fa-regular fa-heart" />
            </div>
            <div class="intro__star">
                <p class="sold">6,937 sold</p>
                <font-awesome-icon icon="fa-regular fa-star-half-stroke" />
                <p>4.3 (6,573 reviews)</p>
            </div>
        </div>

        <div class="des">
            <div class="des__title">
                <h3>Description</h3>
                <p :class="{ line_clamp2: readmore }" @click="readmore = !readmore">It doesn't get more legendary than this.
                    Designed to turn heads, the Nike Air
                    Force 1 '07 crosses hardwood
                    comfort with off-court flair. Its crisp leather upper looks sleek and fresh, while lustrous Swoosh logos
                    give
                    off an almost iridescent look to add the perfect amount of flash to make you shine. Consider them a slam
                    dunk.
                </p>
            </div>
        </div>

        <div class="choose">
            <div class="choose__size">
                <p class="choose__size--title">Size</p>
                <div class="choose__size--number">
                    <p>40</p>
                    <p>40</p>
                    <p>40</p>
                    <p>40</p>
                    <p>40</p>
                </div>
            </div>
            <div class="choose__color">
                <p class="choose__color--title">Color</p>
                <div class="choose__color--number">
                    <img src="@/assets/shoes/nike/Air Jordan 1 Mid/1.png" alt="">
                    <img src="@/assets/shoes/nike/Air Jordan 1 Mid/2.png" alt="">
                    <img src="@/assets/shoes/nike/Air Jordan 1 Mid/3.png" alt="">
                    <img src="@/assets/shoes/nike/Air Jordan 1 Mid/3.png" alt="">
                    <img src="@/assets/shoes/nike/Air Jordan 1 Mid/3.png" alt="">
                </div>
            </div>
            <div class="choose__quantity">
                <p>Quantity</p>
                <div class="choose__quantity--icon">
                    <font-awesome-icon icon="fa-solid fa-minus" @click="quantity <= 1 ? quantity = 1 : quantity--" />
                    <p>{{ quantity }}</p>
                    <font-awesome-icon icon="fa-solid fa-plus" @click="quantity++" />
                </div>
            </div>
        </div>

        <div class="total">
            <div class="total__text">
                <p>Total price</p>
                <span>${{ 150.00 * quantity }}.00</span>
            </div>
            <div class="total__btn">
                <button>
                    <font-awesome-icon icon="fa-solid fa-bag-shopping" />
                    Add to Cart
                </button>
            </div>
        </div>
    </div>
</template>
  
<script>

import BackButton from '@/components/base/BackButton';

export default {
    components: {
        BackButton
    },
    data() {
        return {
            active: 0,
            readmore: true,
            quantity: 1,
            total: null,
            images: [
                {
                    url_img: require("@/assets/shoes/nike/Air Jordan 1 Mid/1.png")
                },
                {
                    url_img: require("@/assets/shoes/nike/Air Jordan 1 Mid/2.png")
                },
                {
                    url_img: require("@/assets/shoes/nike/Air Jordan 1 Mid/3.png")
                },
                {
                    url_img: require("@/assets/shoes/nike/Air Jordan 1 Mid/4.png")
                },
                {
                    url_img: require("@/assets/shoes/nike/Air Jordan 1 Mid/5.png")
                },
            ]
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

.form {
    display: flex;
    flex-direction: column;
    padding-top: 10px;
    width: 90%;
    margin: auto;
    letter-spacing: normal;
    font-family: system-ui;

    .backBtn {
        z-index: 999;
    }

    .slides {
        &__img {
            position: absolute;
            overflow: hidden;
            max-height: 50%;
            top: 0;
            left: 0;

            img {
                max-width: 100%;
            }
        }

        .prev,
        .next {
            position: absolute;
            top: 25%;
            width: 50px;
            height: 50px;
            border: 2px solid $primary;
            color: $primary;
            border-radius: 50%;
            margin-top: -25px;
            cursor: pointer;
            line-height: 48px;
            text-align: center;
            text-indent: -2px;
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);

            &:active {
                transform: translate(0, 3px) scale(1.2);
            }
        }

        .next {
            right: 0;
            margin-left: auto;
            margin-right: 20px;
            text-indent: 2px;
        }

        .dots {
            position: absolute;
            display: block;
            width: 90%;
            text-align: center;
            top: 46%;

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

    .intro {
        margin-top: 51vh;

        &__name {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;

            p {
                font-weight: 500;
                font-size: 24px;
            }

            svg {
                width: 25px;
                height: 25px;
            }
        }

        &__star {
            display: flex;
            align-items: center;
            padding-bottom: 15px;
            gap: 10px;
            border-bottom: 0.5px solid #6b666657;

            svg {
                height: 18px;
            }

            p {
                font-size: 15px;
                color: #656060;
            }

            .sold {
                font-size: 13px;
                padding: 7px;
                background-color: rgba(204, 204, 204, 0.2705882353);
                color: #565252e8;
                border-radius: 5px;
                font-weight: bold;
            }
        }
    }

    .des {
        &__title {
            h3 {
                font-size: 20px;
                margin-top: 15px;
                font-weight: 500;
            }

            p {
                margin-top: 10px;
                line-height: 20px;
                font-size: 15px;
                color: #656060;
                text-overflow: ellipsis;
                transition: all 2s ease-in;
            }

            .line_clamp2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        }
    }

    .choose {
        margin-top: 15px;
        display: flex;
        flex-wrap: wrap;
        gap: 10%;
        border-bottom: 0.5px solid #6b666657;

        &__size {
            width: 45%;

            &--title {
                font-size: 20px;
                font-weight: 500;
            }

            &--number {
                margin-top: 15px;
                display: flex;
                overflow-x: scroll;
                gap: 10px;
                padding-bottom: 10px;

                p {
                    font-size: 18px;
                    padding: 10px;
                    border-radius: 50%;
                    border: 1px solid #000;
                }
            }
        }

        &__color {
            width: 45%;

            &--title {
                font-size: 20px;
                font-weight: 500;
            }

            &--number {
                margin-top: 15px;
                display: flex;
                overflow-x: scroll;
                gap: 15px;
                padding-bottom: 10px;

                img {
                    width: 35px;
                }
            }
        }

        &__quantity {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px 0;

            p {
                font-size: 20px;
                font-weight: 500;
            }

            &--icon {
                display: flex;
                gap: 25px;
                padding: 15px 20px;
                background-color: #cfcfcf3b;
                border-radius: 30px;

                svg {
                    width: 20px;
                    height: 20px;
                }

                p {
                    font-size: 18px;
                }
            }
        }
    }

    .total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 15px 0 35px 0;

        &__text {
            p {
                margin-bottom: 10px;
            }

            span {
                font-size: 22px;
                font-weight: 500;
            }
        }

        &__btn {
            width: 65%;

            button {
                background-color: #000;
                border: none;
                border-radius: 30px;
                width: 100%;
                padding: 15px 30px;
                font-size: 18px;
                color: #fff;
                box-shadow: 5px 10px 18px #888888;

                svg {
                    color: #fff;
                    padding-right: 10px;
                }
            }
        }
    }
}
</style>