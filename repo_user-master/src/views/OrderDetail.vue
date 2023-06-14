<template>
	<div class="order_detail" id="order_page">
		<template v-if="loading">
            <Loading />
        </template>

		<template>
			<!-- Header -->
			<div class="header">
				<BackButton :value="'Order information'"></BackButton>
			</div>
			<!-- Content -->
			<div class="content">
				<div class="content__box">
					<div class="content__box--ctn">
						<p class="text" v-if="item?.status == 0">Your order is being processed</p>
						<p class="text" v-if="item?.status == 1">Your order is being delivered to you</p>
						<p class="text" v-if="item?.status == 2">Your order cancelled</p>
						<p>Please pay attention to your phone. When the goods arrive, the shipper will call</p>
					</div>
					<font-awesome-icon :icon="['far', 'newspaper']" />
				</div>
				<div class="content__address">
					<div class="content__address--title">
						<font-awesome-icon :icon="['fas', 'location-crosshairs']" />
						<p>Delivery address</p>
					</div>
					<div class="content__address--info">
						<p>{{ item?.customer?.full_name }}</p>
						<p>{{ item?.customer?.phone }}</p>
						<p>{{ item?.shipping_address?.details }}</p>
					</div>
				</div>
				<div class="order--product">
					<div class="content__product" v-for="(product, index) in item?.order_items" :key="index">
						<img :src="getCurrentImage(product?.variant?.product?.images[0].src)" alt="">
						<div class="content__product--info">
							<p>{{ product?.variant?.product?.name }}</p>
							<div class="product--des">
								<span>Size: {{ product?.variant?.size }}</span>
								<p>x{{ product?.quantity }}</p>
							</div>
							<p class="price">${{ (product?.variant?.product?.price *
								product?.quantity).toLocaleString("en-IN") }}</p>
						</div>
					</div>
					<div class="content__fee">
						<div class="content__fee--products">
							<p>Total cost of goods</p>
							<p>${{ total(item.order_items).toLocaleString("en-IN") }}</p>
						</div>
						<div class="content__fee--shipping">
							<p>Shipping fee</p>
							<p>${{ (item?.shipping?.price)?.toLocaleString("en-IN") }}</p>
						</div>
						<div class="content__fee--code">
							<p>Discount</p>
							<p>- ${{ discount(item.order_items).toLocaleString("en-IN") }}</p>
						</div>
						<div class="content__fee--total">
							<p>Into money</p>
							<p>${{ pay(item.order_items).toLocaleString("en-IN") }}</p>
						</div>
					</div>
				</div>
				<div class="content__address">
					<div class="content__address--title">
						<font-awesome-icon :icon="['fas', 'user-shield']" />
						<p>Payment methods</p>
					</div>
					<div class="content__address--info">
						<p>Payment on delivery</p>
					</div>
				</div>
				<div class="content__code">
					<div class="content__code--title">
						<p>Order code</p>
						<p>{{ item.code }}</p>
					</div>
					<div class="content__code--date">
						<p>Order date</p>
						<p>{{ item.created_at }}</p>
					</div>
				</div>
				<div class="content__action" v-if="item.status == 0">
					<button class="btn-outline-cancel" @click="cancel()">Cancel</button>
				</div>
			</div>
		</template>
	</div>
</template>

<script>
import BackButton from '@/components/BackButton'
import Loading from '@/components/Loading'

import { getOrdertById, cancelOrder } from "@/api";
import { mixin } from '@/mixin'

export default {
	mixins: [mixin],
	components: {
		BackButton,
		Loading
	},
	data() {
		return {
            loading: true,
			item: {},
			price: '',
			intoMoney: ''
		}
	},
	created() {
		let orderId = this.$route.params.id;

		getOrdertById(orderId).then((response) => {
			this.item = response.data.data;
		}).catch((error) => {
			this.item = {};
		}).finally(() => {
			// Ẩn loading
			this.loading = false;
		})
	},
	methods: {
		total: function (data) {
			if (data && data.length > 0) {
				return data.reduce((total, item) => total + (item.variant.product.price * item.quantity), 0);
			} else {
				return 0;
			}
		},
		discount: function (data) {
			if (data && data.length > 0) {
				let x = 0;
				x += data.reduce((total, item) => total + (item.variant.product.price * item.quantity), 0);
				if (this.item.promo) {
					return x * (this.item.promo.percentage / 100);
				}
				return 0;
			} else {
				return 0;
			}

		},
		pay: function (data) {
			if (data && data.length > 0) {
				let total = 0;
				let discount = 0;
				let shipping = 0;

				total += data.reduce((total, item) => total + (item.variant.product.price * item.quantity), 0);
				if (this.item.promo) {
					discount += total * this.item.promo.percentage / 100;
				}
				shipping += this.item.shipping.price;

				return total + shipping - discount;
			} else {
				return 0;
			}

		},

		cancel: function () {
			cancelOrder(this.item.id).then((response) => {
				this.item = response.data.data;
			}).catch((error) => { }).finally(() => {
				const element = document.getElementById("order_page");
				element.scrollIntoView();
			})
		}
	}
}
</script>

<style lang="scss" scoped>
.order_detail {
	background-color: #f5f5f5a6;
	height: 100vh;
	position: relative;

	.header {
		height: 7vh;
		display: flex;
		align-items: center;
		padding: 0 5%;
		background-color: #fff;
	}

	.content {
		height: calc(100% - 7vh);
		overflow: auto;

		&__address {
			padding: 15px 5%;
			margin-bottom: 10px;
			background-color: #fff;

			&--title {
				display: flex;
				gap: 10px;

				svg {
					width: 20px;
					height: 20px;
					color: #2bb78c;
				}

				p {
					font-size: 18px;
					font-weight: 500;
				}
			}

			&--info {
				padding-left: calc(5% + 10px);
				padding-top: 10px;

				p {
					padding-bottom: 5px;
					color: #6b6b6b;
				}
			}
		}

		&__action {
			text-align: center;
			margin-bottom: 20px;
		}

		.order--product {
			padding: 15px 5%;
			background-color: #fff;
			margin-bottom: 10px;

			.content__product {
				display: flex;
				gap: 10px;
				padding-bottom: 10px;

				img {
					width: 20vw;
					height: 9.5vh;
					border-radius: 10px;
				}

				&--info {
					height: calc(9.5vh + 10px);
					display: flex;
					width: calc(100vw - (20vw + 10px + 10%));
					flex-direction: column;
					justify-content: space-around;
					padding-bottom: 10px;
					border-bottom: 0.5px solid #6b666657;

					p {
						font-size: 18px;
						font-weight: 500;
					}

					.product--des {
						display: flex;
						justify-content: space-between;

						span {
							font-size: 14px;
							color: #6b6b6b;
						}

						p {
							font-size: 15px;
						}
					}

					.price {
						text-align: right;
						color: #6b6b6b;
						font-weight: 400;
					}
				}
			}

			.content__fee {
				&--products {
					display: flex;
					justify-content: space-between;
					color: #6b6b6b;
					margin-bottom: 15px;
				}

				&--shipping {
					display: flex;
					justify-content: space-between;
					margin-bottom: 15px;
					color: #6b6b6b;
				}

				&--code {
					display: flex;
					margin-bottom: 15px;
					color: #6b6b6b;
					justify-content: space-between;
				}

				&--total {
					display: flex;
					margin-bottom: 15px;
					justify-content: space-between;
					font-weight: 500;
				}
			}
		}

		&__code {
			padding: 15px 5%;
			margin-bottom: 20px;
			background-color: #fff;

			&--title {
				display: flex;
				justify-content: space-between;
				font-size: 18px;
				font-weight: 500;
				margin-bottom: 10px;
			}

			&--date {
				display: flex;
				justify-content: space-between;
				color: #6b6b6b;
			}
		}

		&__box {
			background-color: #2fa392;
			color: #fff;
			margin-bottom: 10px;
			padding: 25px 5%;
			display: flex;
			align-items: center;
			justify-content: space-between;

			&--ctn {
				width: 75vw;

				.text {
					font-size: 17px;
					font-weight: 500;
					padding-bottom: 10px;
				}

				p {
					font-size: 14px;
					line-height: normal;
				}
			}

			svg {
				width: 10vw;
				height: 10vh;
			}
		}
	}

	.btn-outline-cancel {
		padding: 10px 20px;
		background-color: #EA2027;
		border-radius: 20px;
		font-size: 14px;
		color: #fff;
		border: 1px solid #EA2027;
	}
}
</style>