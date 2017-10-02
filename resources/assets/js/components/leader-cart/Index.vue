<template>
    <div class="cart-layout">
        <h2>Корзина</h2>
        <div class="cart">
            <table class="cart-table">
                <thead>
                <th class="cart-table__head-center">фото</th>
                <th>наименование</th>
                <th class="cart-table__head-center">кол-во</th>
                <th>цена</th>
                <th class="cart-table__head-center">удалить</th>
                </thead>
                <tbody>
                    <leader-cart-element v-for="cartItem in cartItems" :key="cartElements.rowId" :cart-item="cartItem"></leader-cart-element>
                    <tr class="cart-table__total">
                        <td colspan="2"></td>
                        <td colspan="3"><span>Итого: <span>{{totalCart()}}</span> руб.</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="cart-order">
                <a href="#">Оформить заказ</a>
            </div>
        </div>
        <div class="cart-arrow"></div>
    </div>
</template>
<script>
    import leaderCartElement from '../../components/leader-cart-element/Index.vue';
    export default {
        props: {
            cartItems: Array,
        },
        data: function() {
            return {
                cartElements: this.cartItems,
                subQty: 0
            }
        },
        components: {
            'leader-cart-element': leaderCartElement
        },
        computed: {

        },
        mounted() {
            //console.log(JSON.stringify(this.cartElements));
        },
        methods: {
            totalCart() {
                let sum = 0;
                this.cartElements.forEach(function(cartItem) {
                    sum = sum + cartItem.price*cartItem.qty;
                });
                return sum;
            },
            QtyCart() {
                let qty = 0;
                this.cartElements.forEach(function(cartItem) {
                    qty = qty + cartItem.qty;
                });
                return qty;
            },
            cartDelete(rowId) {
                this.cartElements.forEach(function(cartItem, i, arr) {
                    if(cartItem.rowId == rowId ) {
                        arr.splice(i,1);
                    }
                });
                this.axios.post('/cart-delete', {rowId: rowId}).then(function (response) {
                }).catch(function (error)
                {
                    console.log(error);
                });
                this.$eventBus.$emit('change-count', this.QtyCart());
                this.$eventBus.$emit('change-total', this.totalCart());
            },
            upQty(id) {
                let rowId = 0;
                let qty = 1;
                let that = this;
                this.cartElements.forEach(function(cartItem) {
                   if(cartItem.id == id) {
                       cartItem.qty++;
                       rowId = cartItem.rowId;
                       qty = cartItem.qty;
                       //that.subQty++;
                   }
                });
                this.axios.get('/cart-qty-up/'+rowId+'/'+qty, {}).then(function (response) {
                }).catch(function (error)
                {
                    console.log(error);
                });
                this.$eventBus.$emit('change-count', this.QtyCart());
                //this.$eventBus.$emit('change-count', this.subQty);
                this.$eventBus.$emit('change-total', this.totalCart());
            },
            downQty(id) {
                let that = this;
                this.cartElements.forEach(function(cartItem) {
                    if(cartItem.id == id) {
                        if(cartItem.qty>1)
                        {
                            cartItem.qty--;
                            //that.subQty--;
                            that.axios.get('/cart-qty-down/'+cartItem.rowId+'/'+cartItem.qty, {}).then(function (response) {

                            }).catch(function (error)
                            {
                                console.log(error);
                            });
                        }
                    }
                });
                this.$eventBus.$emit('change-total', this.totalCart());
                //this.$eventBus.$emit('change-count', this.subQty);
                this.$eventBus.$emit('change-count', this.QtyCart());
            }
        }
    }
</script>