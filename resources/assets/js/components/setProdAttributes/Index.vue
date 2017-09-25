<template>
    <div>
        <div class="form-group" >
            <label for="lineproducts">Тип продукции</label>
            <selectbox v-bind:nameelement="'lineproducts'"  v-bind:items="lineProduct" v-on:selectelement="selectelement" v-bind:placeholder="'Выбирите линейку продукции'" ></selectbox>
        </div>
        <select multiple @change="selectAttribute($event)" class="attr-sel">
            <option v-for="attribute in attributes" :value="attribute.id" :selected="existItem(attrVal, attribute.id)">
                {{attribute.title}}
            </option>
        </select><br><br>
        <button class="btn btn-sucess" v-bind:disabled="disabled" @click="save">Сохранить</button>
    </div>
</template>

<script>
    export default {
        props: {
            'arrProdtypeProducts': [Array, Object],
        },
        data: function() {
            return {
                lineProduct: [],
                attributes:[],
                attrVal: [],
                disabled: true,
                update: false,
                typeProdId: 1,
                curVal: 0
            }
        },
        mounted: function() {
            let that = this;
            this.arrProdtypeProducts.forEach(function (item) {
                var temp = {id: item.id, title: item.name_line};
                that.lineProduct.push(temp);
            });
            this.axios.get("/admin/product/getAllAttributes/", {}).then(function (response)
            {
                if(response.data.length > 0) {
                    response.data.forEach(function(item) {
                        var attribute = {id: item.id, title: item.title};
                        that.attributes.push(attribute);
                    });
                }
            }).catch(function (error)
            {
                console.log(error);
            });
            let line_product = document.getElementsByName('lineproducts')[0].value;
            if(line_product>0)
            {
                this.axios.get("/admin/product/getProdLineAttributes/"+line_product, {}).then(function (response)
                {
                    if(response.data.length > 0) {
                        that.update = true;
                        response.data.forEach(function(item) {
                            let attribute = {attribute_id: item.attribute_id, producer_type_product_id: item.producer_type_product_id};
                            that.attrVal.push(attribute);
                        });
                    }
                }).catch(function (error)
                {
                    console.log(error);
                });
            }

        },
        methods: {
            selectelement: function(id)
            {
                this.typeProdId = id;
                let that = this;
                this.attrVal = [];
                this.axios.get("/admin/product/getProdLineAttributes/"+id, {}).then(function (response)
                {
                    if(response.data.length > 0) {
                        that.update = true;
                        response.data.forEach(function(item) {
                            let attribute = {attribute_id: item.attribute_id, producer_type_prodcut_id: item.producer_type_product_id};
                            that.attrVal.push(attribute);
                        });
                    }
                }).catch(function (error)
                {
                    console.log(error);
                });
            },
            selectAttribute: function(event) {
                let line_product = document.getElementsByName('lineproducts')[0].value;
                this.attrVal = [];
                if(line_product>0)
                {
                    this.disabled = false;
                    let options = event.target.options;
                    for (let i=0, l = options.length; i<l; i++) {
                        if(options[i].selected) {
                            let attribute = {attribute_id: options[i].value, producer_type_product_id: line_product};
                            this.attrVal.push(attribute);
                        }
                    }
                }
                else
                {
                    alert('Выберите тип продукта');
                    location.reload();
                }
            },
            existItem: function(arr, val) {
                let result = false;
                arr.forEach(function(item) {
                    if(item.attribute_id == val)
                    {
                        result = true;
                    }
                });
                return result;
            },
            save: function () {
                if(this.update == true) {
                    this.disabled = true;
                    this.axios.post("/admin/product/bindLineProdAttributesUpdate", {data: JSON.stringify(this.attrVal), prodLine: this.typeProdId}).then(function (response)
                    {
                        location.reload();
                    }).catch(function (error)
                    {
                        console.log(error);
                    });
                }
                else
                {
                    this.disabled = true;
                    this.axios.post("/admin/product/bindLineProdAttributes/"+JSON.stringify(this.attrVal), {}).then(function (response)
                    {
                        location.reload();
                    }).catch(function (error)
                    {
                        console.log(error);
                    });
                }
            }
        }
    }
</script>