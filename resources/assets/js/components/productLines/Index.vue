<template>
    <div>
        <div class="form-group" >
            <label for="typeproducts">Тип продукции</label>
            <selectbox v-bind:nameelement="'typeproducts'"  v-bind:items="typeProducts"  v-on:selectelement="selectelement" v-bind:placeholder="'Выбирите тип продукции'"></selectbox>
        </div>
        <div class="form-group">
            <label for="producers">Производители</label>
            <selectbox v-bind:nameelement="'producers'" v-bind:items="producers"  v-bind:defaultId="getDefProducers" v-bind:placeholder="''"></selectbox>
        </div>
        <div class="form-group" >
            <label for="producertypeproducts">Линейка продукции</label>
            <selectbox v-bind:nameelement="'producertypeproducts'" v-bind:defaultId="getDefProducerTypeProduct" v-bind:items=producerTypeProducts v-bind:placeholder="''"></selectbox>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            arrProducers: [Array, Object],
            arrTypeProducts: [Array, Object],
            arrProducerTypeProducts: [Array, Object]
        },
        data: function()
        {
            return {
                items: [],
                typeProducts: this.normalizeForSelectBox(this.arrTypeProducts),
                producers: this.normalizeForSelectBox(this.arrProducers[this.getDefTypeProduct()]),
                producerTypeProducts: this.normalizeForSelectBox(this.arrProducerTypeProducts[this.getDefTypeProduct()]),
            };
        },
        computed: {
            getDefProducers: function() {
                let obj = null;
                if(this.typeProducts.length)
                {
                    obj = this.arrProducers[this.typeProducts[0].id];
                }
                let sort = 14294967295;
                let id;
                for (let key in obj) {
                    if(obj[key]['sort']< sort) sort = obj[key]['sort'];
                }
                for (let key in obj) {
                    if(obj[key]['sort'] == sort) return obj[key]['id'];
                }
                return null;
            },
            getDefProducerTypeProduct: function() {
                let obj = null;
                if(this.typeProducts.length)
                {
                    obj = this.arrProducerTypeProducts[this.typeProducts[0].id];
                }
                let sort = 14294967295;
                let id;
                for (let key in obj) {
                    if(obj[key]['sort']< sort) sort = obj[key]['sort'];
                }
                for (let key in obj) {
                    if(obj[key]['sort'] == sort) return obj[key]['id'];
                }
                return null;
            },
        },
        methods: {
            asc: function(field) {
                return function (x, y) {
                    return x[field] > y[field];
                }
            },
            normalizeForSelectBox: function(obj) {
                if(obj) {
                    let result = [];
                    for(let key in obj) {
                        result.push({id: obj[key]['id'], title: obj[key]['title'], sort: obj[key]['sort']});
                    }
                    result.sort(this.asc('sort'));
                    return result;
                }
                else {
                    return [];
                }
            },
            selectelement: function(id) {
                console.log('work');
                this.producers = this.normalizeForSelectBox(this.arrProducers[id]);
                this.producerTypeProducts = this.normalizeForSelectBox(this.arrProducerTypeProducts[id]);
            },
            getDefTypeProduct: function() {
                let obj = this.arrTypeProducts;
                let sort = 14294967295;
                let id;
                for (let key in obj) {
                    if(obj[key]['sort']< sort) sort = obj[key]['sort'];
                }
                for (let key in obj) {
                    if(obj[key]['sort'] == sort) return obj[key]['id'];
                }
                return null;
            }
        }
    }
</script>