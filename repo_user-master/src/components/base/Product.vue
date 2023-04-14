<template>
    <div class="product">
        <div class="product__cart" @click="push()">
            <div class="product__cart--img">
                <img src="@/assets/shoes/nike/Air Jordan 1 Mid/1.png" alt="">
                <div class="heart">
                    <font-awesome-icon icon="fa-solid fa-heart" />
                </div>
            </div>
            <div class="product__cart--name">
                <p>Air Jordan 1 Mid</p>
            </div>
            <div class="product__cart--star">
                <font-awesome-icon icon="fa-regular fa-star-half-stroke" />
                <p>4.3</p>
                <p class="sold">6,937 sold</p>
            </div>
            <div class="product__cart--price">
                <font-awesome-icon icon="fa-solid fa-dollar-sign" />
                <p>150.00</p>
            </div>
        </div>
        <div class="product__cart">
            <div class="product__cart--img">
                <img src="@/assets/shoes/nike/Nike Air Force 1 '07 LV8/1.png" alt="">
                <div class="heart">
                    <font-awesome-icon icon="fa-solid fa-heart" />
                </div>
            </div>
            <div class="product__cart--name">
                <p>Nike Air Force 1 '07 LV8</p>
            </div>
            <div class="product__cart--star">
                <font-awesome-icon icon="fa-regular fa-star-half-stroke" />
                <p>4.3</p>
                <p class="sold">6,937 sold</p>
            </div>
            <div class="product__cart--price">
                <font-awesome-icon icon="fa-solid fa-dollar-sign" />
                <p>110.00</p>
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    methods: {
        push() {
            this.$router.push('/product-detail')
        }
    }
}
</script>
  
<style lang="scss" scoped>
.product {
    display: flex;
    justify-content: space-between;
    margin-bottom: 80px;
    font-family: system-ui;

    &__cart {
        width: 47.5%;
        margin-bottom: 20px;

        &--img {
            position: relative;

            img {
                border-radius: 30px;
                width: 100%;
                height: 90%;
            }

            .heart {
                position: absolute;
                top: 16px;
                right: 20px;
                padding: 10px;
                border-radius: 50%;
                background-color: #000;

                svg {
                    color: #fff;
                }
            }
        }

        &--name {
            p {
                font-size: 18px;
                font-weight: bold;
                padding: 10px 0;
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }
        }

        &--star {
            display: flex;
            align-items: center;
            padding-bottom: 10px;
            gap: 10px;

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

        &--price {
            display: flex;
            align-items: center;

            svg {
                height: 18px;
            }

            p {
                font-size: 18px;
                font-weight: bold;
            }
        }
    }
}
</style>