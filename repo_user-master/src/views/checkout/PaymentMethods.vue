<template>
    <div class="form">
        <BackButton :value="'Payment Methods'"></BackButton>
        <p>Select the payment method you want to use.</p>

        <!-- Container -->
        <form>
            <div class="method">
                <div class="method__choose">
                    <div class="method__choose--icon">
                        <font-awesome-icon icon="fa-solid fa-file-invoice-dollar" />
                    </div>
                    <div class="method__choose--text">
                        <p>Payment on delivery</p>
                        <input type="radio" name="choose">
                    </div>
                </div>
            </div>
        </form>

        <!-- Footer Btn -->
        <div class="footer">
            <ButtonVue :value="'Confirm Payment'" @onClick="$router.push('/confirm_PIN')"></ButtonVue>
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
    min-height: 75vh;
    background-attachment: fixed;
    padding-bottom: 170px;
    z-index: 0;

    p {
        font-size: 15px;
        color: #656060;
        padding-left: 5%;
        padding-right: 5%;
    }

    form {
        .method {
            padding-left: 5%;
            padding-right: 5%;

            h3 {
                font-size: 20px;
                font-weight: 500;
            }

            &__choose {
                display: flex;
                align-items: center;
                margin: 25px 0;
                padding: 20px 20px;
                background-color: #fff;
                border-radius: 25px;

                &--icon {
                    width: 15%;

                    svg {
                        color: #000;
                        width: 25px;
                        height: 25px;
                    }
                }

                &--text {
                    display: flex;
                    width: 85%;
                    justify-content: space-between;
                    align-items: center;

                    p {
                        color: #000;
                        font-size: 18px;
                        font-weight: 500;
                        padding: 0;
                    }

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