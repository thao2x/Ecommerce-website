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
    height: calc(100vh - 70px);

    .back {
        height: 60px;
        display: flex;
        align-items: center;
        top: 0;
        z-index: 1;
        padding: 0 5%;
    }

    .content {
        padding: 10px 15px;
        height: calc(100% - 80px);
        overflow: auto;

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