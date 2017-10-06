<template>
    <div>
        <div class="form-group">
            <label for="typeproducts">Тип продукции</label>
            <Tselect v-bind:nameelement="'type_product_id'" v-bind:items="type_product_el" v-on:selectelement="selectelement" v-bind:defaultId="defaultTypeProduct"  v-bind:placeholder="'Выбирите тип продукции'"></Tselect>
        </div>
        <div class="form-group">
            <label for="producers">Производители</label>
            <Tselect v-bind:nameelement="'producer_id'"  v-bind:items="normalizeForSelectBox(this.elements, 'producer_id')" v-bind:defaultId="defaultProducer"  v-bind:placeholder="''"></Tselect>
        </div>
        <div class="form-group" >
            <label for="lines">Линейка продукции</label>
            <Tselect v-bind:nameelement="'producer_type_product_id'" v-on:selectelement="selectline" v-bind:items="normalizeForSelectBox(this.elements, 'producer_type_product_id')" v-bind:defaultId="defaultLine" v-bind:placeholder="''"></Tselect>
        </div>
    </div>
</template>
<script>
    let traverse = require('traverse');
    export default {
        props: {
            elementsArr: [Object,Array],
            defaultTypeProduct: Number,
            defaultProducer: Number,
            defaultLine: Number
        },
        data: function() {
            return {
                elements: this.startVal(this.elementsArr),
                type_product_el: this.normalizeForSelectBox(this.elementsArr, 'type_product_id'),
            }
        },
        methods: {
            startVal: function(elementsVal) {
                if(elementsVal.type_product_id.length > 0 ) {
                    let def = this.defaultTypeProduct;
                    let filteredVal = [];
                    let id = 1;
                    let minItem =[];
                    if(def) {
                        elementsVal.type_product_id.forEach(function(item, i, arr) {
                            if (item.id == def) {
                                minItem = item;
                                return 1;
                            }
                        });
                    }
                    else
                    {
                        let sort = elementsVal.type_product_id[0].sort;
                        minItem = elementsVal.type_product_id[0];
                        elementsVal.type_product_id.forEach(function(item, i, arr)
                        {
                            if(item.sort < sort)
                            {
                                minItem = item;
                            }
                        });
                    }
                    let resFilteredVal = {"type_product_id":minItem};
                    return resFilteredVal;
                }
                else return [];
            },
            selectelement: function(id) {
                let that = this;
                let filteredVal = [];
                this.elementsArr.type_product_id.forEach(function(item, i, arr)
                {
                    if(item.id === id)
                    {
                        filteredVal = arr.slice(i,i+1);
                    }
                });
                let resFilteredVal = {"type_product_id":filteredVal};
                this.$set(this, 'elements', resFilteredVal);
                this.defaultId = 1;
                this.$parent.selectType(id);
                this.$parent.selectTypeProd = id;
            },
            selectline: function (id) {
                this.$parent.selectProductLine(id);
                this.$parent.selectLineProd = id;
            },
            normalizeForSelectBox(elements, name) {
                let items = [];
                let elems = [];
                var scrubbed = traverse(elements).map(function(obj) {
                    if(typeof obj == "object")
                    {
                        let arrObj = Object.keys(obj);
                        arrObj.forEach(function (item)
                        {
                            if (item == name)
                            {
                                elems.push(obj[item]);
                                return obj[item];
                            }
                        });
                    }
                },[]);
                elems.forEach(function(item) {
                    item.forEach(function (item) {
                        items.push({'id': item.id, 'title': item.title, 'sort': item.sort});
                    });
                });
                items.sort(this.asc('sort'));
                if(name === "type_product_id") {
                    if(items>0) this.$parent.selectTypeProd = items[0].id;
                }
                if(name === "producer_type_product_id") {
                    if(items>0) this.$parent.selectLineProd = items[0].id;
                }
                return items;
            },
            asc: function(field) {
                return function (x, y) {
                    return x[field] > y[field];
                }
            },
        }
    }
</script>