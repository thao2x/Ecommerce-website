<template>
    <div class="footer" v-show="show">
        <div class="footer__item" v-for="(item, index) in items" :class="{ active: index == activeItem }"
            @click="setActive(index)" :key="index">
            <font-awesome-icon :icon="item.icon" />
            <p>{{ item.name }}</p>
        </div>
    </div>
</template>
  
<script>
import { mixin } from '@/mixin'

export default {
    mixins: [mixin],
    data() {
        return {
            activeItem: 0,
            show: true,
            items: [
                {
                    icon: "fa-solid fa-house",
                    name: "Home",
                },
                {
                    icon: "fa-solid fa-bag-shopping",
                    name: "Cart",
                },
                {
                    icon: "fa-solid fa-cart-shopping",
                    name: "Orders",
                },
                {
                    icon: "fa-solid fa-bell",
                    name: "Notification",
                },
                {
                    icon: "fa-solid fa-user",
                    name: "Profile",
                },
            ],
        };
    },
    created() {
        const name = this.$router.currentRoute.name;
        this.checkTab(name);
    },
    watch: {
        $route(to, from) {
            // Ẩn bottom navigation nếu không thuộc những page này
            const publicPages = ['home', 'cart', 'order', 'notification', 'profile'];
            if (!publicPages.includes(to.name)) {
                this.show = false;
            } else {
                this.show = true;
            }

            // Check tab active
            this.checkTab(to.name);
        }
    },
    methods: {
        setActive: function (index) {
            // Trường hợp đang đứng ở tab này thì không được click
            if (this.activeItem == index) return;

            this.activeItem = index;

            switch (index) {
                case 0:
                    this.goToPage('home');
                    break;
                case 1:
                    this.goToPage('cart');
                    break;
                case 2:
                    this.goToPage('order');
                    break;
                case 3:
                    this.goToPage('notification');
                    break;
                case 4:
                    this.goToPage('profile');
                    break;
            }
        },

        checkTab: function (name) {
            switch (name) {
                case 'home':
                    this.activeItem = 0;
                    break;
                case 'cart':
                    this.activeItem = 1;
                    break;
                case 'order':
                    this.activeItem = 2;
                    break;
                case 'notification':
                    this.activeItem = 3;
                    break;
                case 'profile':
                    this.activeItem = 4;
                    break;
                default:
                    this.show = false;
            }
        },
    },
};
</script>
  
<style lang="scss" scoped>
.footer {
    position: fixed;
    height: 70px;
    background-color: #fff;
    bottom: -1px;
    left: 0px;
    right: 0px;
    margin-bottom: 0px;
    display: flex;
    padding-left: 5%;
    padding-right: 5%;
    align-items: center;
    justify-content: space-around;
    border-top: 0.5px solid #e5e5e5de;

    &__item {
        text-align: center;

        svg {
            height: 24px;
            color: #ccc;
        }

        p {
            padding-top: 5px;
            font-size: 12px;
            color: #ccc;
        }
    }

    .active {

        svg,
        p {
            color: #000;
        }
    }
}
</style>