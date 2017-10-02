<template>
    <tr>
        <td>
            <img class="cart-img" :src="'storage/'+cartItem.options.filename" height="100px"/>
        </td>
        <td>
            <a :href="'catalog/'+cartItem.options.slug" class="table-td-title">{{cartItem.name}}</a><br>
            <span v-if="cartItem.options.article">арт. {{cartItem.options.article}}</span>
        </td>
        <td class="cart-table-counter">
            <div class="detail-counter">
                <div @click="downQty(cartItem.id)"  class="detail-counter__left"><img src="storage/detail-cart-arr-down.png"/></div>
                <div class="detail-counter__center">{{cartItem.qty}}</div>
                <div @click="upQty(cartItem.id)" class="detail-counter__right"><img src="/storage/detail-cart-arr-up.png"/></div>
            </div>
        </td>
        <td class="cart-table-td-price"><span class="cart-table-price"> {{cartItem.price}}</span><span class="cart-table-rub"> руб.</span></td>
        <td class="cart-table-del"><a href="#" @click.prevent="cartDelete(cartItem.rowId)"><img src="storage/cart-table-del.png"/></a></td>
    </tr>
</template>
<script>
    export default {
        props: {
            cartItem: Object,
        },
        data: function() {
            return {

            }
        },
        methods: {
            cartDelete(rowId) {
                this.$parent.cartDelete(rowId);
            },
            upQty(id) {
                this.$parent.upQty(id);
            },
            downQty(id) {
                this.$parent.downQty(id);
            }
        }
    }
</script>