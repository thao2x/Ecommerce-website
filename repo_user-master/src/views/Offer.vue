<template>
    <div class="offers">
        <div class="back">
            <BackButton :value="'Special Offers'"></BackButton>
        </div>

        <div class="content">
            <OfferCard :promo="promo" :color="colors[Math.floor(Math.random() * 6)]"
                :image="images[Math.floor(Math.random() * 6)]" class="banner" v-for="(promo, index) in promos"
                :key="index" />
        </div>
    </div>
</template>
  
<script>
import BackButton from '@/components//BackButton'
import OfferCard from '@/components/OfferCard'
import { getPromos } from "@/api"

export default {
    data() {
        return {
            colors: [
                '#4e5e75',
                '#633f3fde',
                '#10907e',
                '#132c85de',
                '#d02828'
            ],
            images: [
                'https://png.pngtree.com/png-clipart/20230414/original/pngtree-colorful-diorama-of-sneakers-png-image_9057177.png',
                'https://png.pngtree.com/png-vector/20230328/ourmid/pngtree-childrens-model-flat-shoes-png-image_6670735.png',
                'https://png.pngtree.com/png-vector/20230328/ourmid/pngtree-casual-shoes-kids-model-png-image_6670734.png',
                'https://png.pngtree.com/png-vector/20230328/ourmid/pngtree-childrens-model-of-sneakers-png-image_6670732.png',
                'https://png.pngtree.com/png-vector/20230414/ourmid/pngtree-colorful-cloud-gradient-creative-png-image_6698081.png',
                'https://png.pngtree.com/png-vector/20230413/ourmid/pngtree-musical-note-color-creative-png-image_6698127.png',
                'https://png.pngtree.com/png-vector/20230328/ourmid/pngtree-sneakers-color-model-png-image_6670733.png'
            ]
        }
    },
    components: {
        BackButton,
        OfferCard
    },
    computed: {
        promos() {
            return this.$store.state.promos;
        },
    },
    created() {
        getPromos().then((response) => {
            if (response.data.success) {
                // Lưu promos mới vào state vuex store
                this.$store.commit('changePromos', response.data.data);
            }
        }).catch((error) => {
            this.$store.commit('changePromos', []);
            console.log(error.response.data.message);
        })
    }
}
</script>
  
<style lang="scss" scoped>
.offers {
    .back {
        height: 60px;
        display: flex;
        align-items: center;
        padding-left: 20px;
        position: fixed;
        top: 0;
        background-color: #fff;
        width: 100%;
    }

    .content {
        padding-top: 65px;
        width: 90%;
        margin: auto;
        letter-spacing: normal;
        font-family: system-ui;
        overflow: auto;
    }

    .banner {
        margin-bottom: 20px;

        &:nth-child(3) {
            background-color: #4e5e75;
        }

        &:nth-child(4) {
            background-color: #633f3fde;
        }

        &:nth-child(5) {
            background-color: #10907e;
        }

        &:nth-child(6) {
            background-color: #132c85de;
        }
    }
}
</style>