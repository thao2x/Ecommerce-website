<template>
	<div class="order">
		<!-- Hiển thị loading khi đang xử lý -->
		<template v-if="loading">
			<Loading />
		</template>

		<template v-else>
            <!-- Header -->
            <div class="header">
                <div class="header__title">
                    <img src="@/assets/picwish.png" alt="picwish">
                    <p>My Orders</p>
                </div>
            </div>

			
		</template>
	</div>
</template>

<script>
import Loading from '@/components/Loading'

export default {
	components: {
        Loading
    },
}
</script>

<style lang="scss" scoped>
.order {
    background-color: #f5f5f5a6;
    height: calc(100vh - 70px);

    .header {
        height: 9vh;
        display: flex;
        align-items: center;
        padding: 0 5%;

        &__title {
            display: flex;
            gap: 20px;

            img {
                width: 25px;
                height: 25px;
            }

            p {
                font-size: 22px;
                font-weight: 500;
            }
        }

        svg {
            width: 25px;
            height: 25px;
        }
    }
}
</style>