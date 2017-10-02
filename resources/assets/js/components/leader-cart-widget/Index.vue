<template>
    <div class="finder__cart">
        <div class="finder__cart-image">
            <img src="storage/cart.png"/>
        </div>
        <div class="finder__cart-info">
            <a href="/cart">Корзина</a><br>
            У вас <span v-cloak>{{cart.count}}</span> товара на <span>{{cart.total}}</span> руб.
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            cartItem: Object,
        },
        data: function() {
            return {
                cart: {
                }
            }
        },
        created() {
          this.$eventBus.$on('change-count', this.changeCount);
          this.$eventBus.$on('change-total', this.changeTotal);
        },
        mounted() {
            this.cart = this.cartItem;
            let that = this;
            this.axios.get('/current-cart', {}).then(function (response) {
                let cartVal = response.data;
                that.cart.count =  cartVal.count;
                that.cart.total = cartVal.total;
            }).catch(function (error)
            {
                console.log(error);
            });
        },
        methods: {
            changeCount(count) {
                this.cart.count = count;
            },
            changeTotal(total) {
                this.cart.total = total;
            },
        }
    }
</script>
<style>
    [v-cloak] {
        display: none;
        width: 10px;
    }
</style>