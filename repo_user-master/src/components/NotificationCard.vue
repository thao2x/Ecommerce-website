<template>
    <div class="ctn__content">
        <font-awesome-icon icon="fa-solid fa-gears" />
        <div class="ctn__content--text">
            <p>
                {{ promo.percentage }}% Specials Discount!
            </p>
            <span>
                {{ promo.description }}
            </span>
        </div>
    </div>
</template>
  
<script>
export default {
    props: {
        promo: {
            type: Object,
            required: true,
        }
    }
}
</script>
  
<style lang="scss" scoped>
.ctn {
    display: flex;
    flex-direction: column;
    padding-top: 80px;
    width: 90%;
    margin: auto;
    letter-spacing: normal;
    font-family: system-ui;

    &__content {
        display: flex;
        align-items: center;
        gap: 15px;
        background-color: #fff;
        border-radius: 20px;
        padding: 15px;
        margin: 5px 0;

        svg {
            border-radius: 50%;
            background-color: #000;
            color: #fff;
            width: 40px;
            height: 40px;
            padding: 15px;
        }

        &--text {
            p {
                font-size: 20px;
                margin-bottom: 10px;
                font-weight: 500;
            }

            span {
                font-size: 14px;
                color: #6b6464e0;
            }
        }
    }
}
</style>