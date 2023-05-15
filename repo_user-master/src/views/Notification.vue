<template>
    <div class="notification">
        <div class="back">
            <BackButton :value="'Special notification'"></BackButton>
        </div>

        <div class="content">
            <div class="ctn">
                <div class="ctn__text">
                    <p>Today</p>
                </div>

                <!-- List -->
                <NotificationCard :promo="promo" class="banner" v-for="(promo, index) in promos" :key="index" />
            </div>
        </div>
    </div>
</template>
  
<script>
import BackButton from '@/components//BackButton'
import NotificationCard from '@/components/NotificationCard'

export default {
    components: {
        BackButton,
        NotificationCard
    },
    computed: {
        promos() {
            return this.$store.state.promos;
        },
    }
}
</script>
  
<style lang="scss" scoped>
.notification {
    background-color: rgba(204, 204, 204, 0.2705882353);

    .back {
        height: 60px;
        display: flex;
        align-items: center;
        padding-left: 20px;
        position: fixed;
        top: 0;
        background-color: #f1f1f1;
        width: 100%;
    }

    .content {
        width: 90%;
        margin: auto;
        letter-spacing: normal;
        font-family: system-ui;
        overflow: auto;
        padding-top: 65px;

        .ctn {
            display: flex;
            flex-direction: column;
            letter-spacing: normal;
            font-family: system-ui;

            &__text {
                padding-bottom: 10px;

                p {
                    font-size: 20px;
                    font-weight: 500;
                }
            }
        }
    }
}
</style>