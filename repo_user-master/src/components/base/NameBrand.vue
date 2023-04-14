<template>
    <div class="brandName">
        <div class="brandName__item" v-for="(item, index) in items" :key="index" :class="{ active: activeItem == index }"
            @click="setActive(index)">
            <p>{{ item.name }}</p>
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
                    name: "All",
                    value: 0
                },
                {
                    name: "Nike",
                    value: 1
                },
                {
                    name: "Puma",
                    value: 2
                },
                {
                    name: "Adidas",
                    value: 3
                },
                {
                    name: "New Balance",
                    value: 4
                },
                {
                    name: "Reebok",
                    value: 5
                },
                {
                    name: "Converse",
                    value: 6
                }
            ]
        }
    },
    methods: {
        setActive: function (index) {
            this.activeItem = index;
        },
    }
}
</script>
  
<style lang="scss" scoped>
.brandName {
    display: flex;
    overflow-x: scroll;
    gap: 12px;
    margin-bottom: 20px;
    padding-bottom: 15px;

    &__item {
        padding: 12px;
        border: 2px solid #000;
        border-radius: 30px;

        p {
            font-size: 16px;
            font-weight: 500;
            white-space: nowrap;
        }
    }

    .active {
        background-color: #000;

        p {
            color: #fff;
        }
    }
}
</style>