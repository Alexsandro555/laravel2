<template>
    <div>
       <div>
            <div class="order__tab-contact" v-bind:class="{tabactive: active}" @click="active=true">Контактная информация</div>
            <div class="order__tab-delivry" v-bind:class="{tabactive: !active}" @click="active=false">Способ доставки</div>
        </div>
        <slot name="tab-1" v-if="active"></slot>
        <slot name="tab-2" v-if="!active"></slot>
    </div>
</template>
<script>
    export default {
        data: function()
        {
            return {
                active: true
            };
        },
    }
</script>
<style>
   .tabactive {
       background-color: #FFCA00;
       color: #0F2E5D;
   }
</style>