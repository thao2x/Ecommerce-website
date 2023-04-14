<template>
    <div>
        <div class="footer">
            <div class="footer__item" v-for="(item, index) in items" :key="index" :class="{ active: index == activeItem }"
                @click="setActive(index)">
                <font-awesome-icon :icon="item.icon" />
                <p>{{ item.name }}</p>
            </div>
        </div>
    </div>
</template>
  
<script>

export default {
    data() {
        return {
            activeItem: 0,
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
                    value: 2,
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
        const path = this.$router.currentRoute.path;
        console.log(this.$router.currentRoute);

        switch (path) {
            case '/home':
                this.activeItem = 0;
                break;
            case '/cart':
                this.activeItem = 1;
                break;
            case '/notifications':
                this.activeItem = 3;
                break;
            case '/setting':
                this.activeItem = 4;
                break;
        }
    },
    methods: {
        setActive: function (index) {
            this.activeItem = index;
            if (index === 0) {
                this.$router.push('/home');
            }
            if (index === 1) {
                this.$router.push('/cart');
            }
            if (index === 3) {
                this.$router.push('/notifications')
            }
            if (index === 4) {
                this.$router.push('/setting')
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
    bottom: 0px;
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