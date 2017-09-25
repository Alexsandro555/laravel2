<template>
    <div>
        <div class="form-group" >
            <label for="typeproducts">Тип продукции</label>
            <lselect v-bind:nameelement="'type_product_id'" v-bind:elements-val="elementsArr"  v-bind:defaultId="1" v-on:selectelement="selectelement" v-bind:placeholder="'Выбирите тип продукции'"></lselect>
        </div>
        <div class="form-group">
            <label for="producers">Производители</label>
            <lselect v-bind:nameelement="'producers_id'" v-bind:elements-val="mutableElementsArr" v-bind:default-id="defaultId" v-bind:placeholder="''"></lselect>
        </div>
        <div class="form-group" >
            <label for="lines">Линейка продукции</label>
            <lselect v-bind:nameelement="'producer_type_product_id'" v-bind:elements-val ="mutableElementsArr" v-bind:placeholder="''"></lselect>
        </div>
    </div>
</template>
<script>
    export default {
        props:
        {
            elementsArr: Object,
        },
        data: function()
        {
            return {
                mutableElementsArr: this.startVal(this.elementsArr),
                defaultId: 1
            };
        },
        methods: {
            startVal: function(elementsVal) {
                let filteredVal = [];
                let id = 1;
                elementsVal.type_product_id.forEach(function(item, i, arr)
                {
                    if(item.id === id)
                    {
                        filteredVal = arr.slice(id-1,id);
                    }
                });
                let resFilteredVal = {"type_product_id":filteredVal};
                return resFilteredVal;
            },
            selectelement: function(id) {
                let that = this;
                let filteredVal = [];
                this.elementsArr.type_product_id.forEach(function(item, i, arr)
                {
                    if(item.id === id)
                    {
                        filteredVal = arr.slice(id-1,id);
                    }
                });
                let resFilteredVal = {"type_product_id":filteredVal};
                this.$set(this, 'mutableElementsArr', resFilteredVal);
                this.defaultId = 1;
                this.$parent.selectProductLine(id);
            }
        }
    }
</script>