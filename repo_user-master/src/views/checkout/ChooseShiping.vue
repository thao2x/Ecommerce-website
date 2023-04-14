<template>
    <div class="form">
        <BackButton :value="'Choose Shipping'"></BackButton>

        <!-- Container -->
        <form>
            <div class="shipping" v-for="(item, index) in items" :key="index">
                <div class="shipping__choose">
                    <div class="shipping__choose--icon">
                        <font-awesome-icon :icon="item.icon" />
                    </div>
                    <div class="shipping__choose--text">
                        <p>{{ item.name }}</p>
                        <span>{{ item.address }}</span>
                    </div>
                    <div class="shipping__choose--price">
                        <p>${{ item.price }}</p>
                    </div>
                    <div class="shipping__choose--edit">
                        <input type="radio" name="choose">
                    </div>
                </div>
            </div>
        </form>

        <!-- Footer Btn -->
        <div class="footer">
            <ButtonVue :value="'Apply'"></ButtonVue>
        </div>
    </div>
</template>
  
<script>

import BackButton from '@/components/base/BackButton';
import ButtonVue from '@/components/base/Button';

export default {
    components: {
        BackButton,
        ButtonVue
    },
    data() {
        return {
            items: [
                {
                    name: 'Economy',
                    address: 'Estimated Arrivial, 6 to 7 days',
                    icon: 'fa-solid fa-box',
                    price: 10
                },
                {
                    name: 'Regular',
                    address: 'Estimated Arrivial, 4 to 5 days',
                    icon: 'fa-solid fa-motorcycle',
                    price: 15
                },
                {
                    name: 'Cargo',
                    address: 'Estimated Arrivial, 3 to 4 days',
                    icon: 'fa-solid fa-truck',
                    price: 20
                },
                {
                    name: 'Express',
                    address: 'Estimated Arrivial, 2 to 3 days',
                    icon: 'fa-solid fa-truck-fast',
                    price: 30
                }
            ]
        }

    }
}
</script>
  
<style lang="scss" scoped>
$color1: #f4f4f4;
$color2: #000;

.form {
    display: flex;
    flex-direction: column;
    padding-top: 70px;
    letter-spacing: normal;
    font-family: system-ui;
    background: #f5f5f5a6;
    width: 100%;
    min-height: 100vh;
    background-attachment: fixed;
    padding-bottom: 170px;
    z-index: 0;

    form {
        .shipping {
            padding-left: 5%;
            padding-right: 5%;

            h3 {
                font-size: 20px;
                font-weight: 500;
            }

            &__choose {
                display: flex;
                align-items: center;
                gap: 15px;
                margin: 25px 0;
                padding: 20px 10px;
                background-color: #fff;
                border-radius: 25px;

                &--icon {
                    padding: 8px;
                    background-color: #000;
                    border-radius: 50%;

                    svg {
                        color: #fff;
                        padding: 12px;
                        border-radius: 50%;
                        width: 20px;
                        height: 20px;
                    }
                }

                &--text {
                    p {
                        font-size: 18px;
                        font-weight: 500;
                        padding-bottom: 10px;
                    }

                    span {
                        font-size: 15px;
                        color: #656060;
                    }
                }

                &--price {
                    p {
                        font-size: 18px;
                        font-weight: 500;
                    }
                }

                &--edit {
                    input {
                        height: 25px;
                        width: 25px;

                        &:before {
                            content: '';
                            background: $color1;
                            border-radius: 100%;
                            border: 1px solid darken($color1, 25%);
                            display: inline-block;
                            width: 1.4em;
                            height: 1.4em;
                            top: -0.2em;
                            margin-right: 1em;
                            vertical-align: top;
                            cursor: pointer;
                            text-align: center;
                            transition: all 250ms ease;
                        }

                        &:checked {
                            &:before {
                                background-color: $color2;
                                box-shadow: inset 0 0 0 4px $color1;
                            }
                        }

                        &:focus {
                            &:before {
                                outline: none;
                                border-color: $color2;
                            }
                        }

                        &:empty {
                            &:before {
                                margin-right: 0;
                            }
                        }
                    }
                }
            }
        }
    }

    .footer {
        position: fixed;
        height: 120px;
        bottom: 0px;
        left: 0px;
        right: 0px;
        margin-bottom: 0px;
        display: flex;
        padding-left: 5%;
        padding-right: 5%;
        align-items: center;
        justify-content: space-around;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        border-top: 0.5px solid #6b666657;
        background: #f5f5f5;
    }
}
</style>