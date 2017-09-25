<template>
    <div>
        <div class="form-group" >
            <label for="typeproducts">Тип продукции</label>
            <selectbox v-bind:nameelement="'typeproducts'"  v-bind:items="arrTypeProducts" v-on:selectelement="selectelement" v-bind:placeholder="'Выбирите тип продукции'" ></selectbox>
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
            'arrTypeProducts': [Array, Object],
        },
        data: function() {
            return {
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
            let type_product = document.getElementsByName('typeproducts')[0].value;
            this.axios.get("/admin/product/getAttributes/"+type_product, {}).then(function (response)
            {
                if(response.data.length > 0) {
                    that.update = true;
                    response.data.forEach(function(item) {
                        let attribute = {attribute_id: item.attribute_id, type_prodcut_id: item.type_product_id};
                        that.attrVal.push(attribute);
                    });
                }
            }).catch(function (error)
            {
                console.log(error);
            });
        },
        methods: {
            selectelement: function(id)
            {
                this.typeProdId = id;
                let that = this;
                this.attrVal = [];
                this.axios.get("/admin/product/getAttributes/"+id, {}).then(function (response)
                 {
                     if(response.data.length > 0) {
                         that.update = true;
                         response.data.forEach(function(item) {
                             let attribute = {attribute_id: item.attribute_id, type_prodcut_id: item.type_product_id};
                             that.attrVal.push(attribute);
                         });
                     }
                 }).catch(function (error)
                 {
                    console.log(error);
                 });
            },
            selectAttribute: function(event) {
                let type_product = document.getElementsByName('typeproducts')[0].value;
                this.attrVal = [];
                if(type_product)
                {
                    this.disabled = false;
                    let options = event.target.options;
                    for (let i=0, l = options.length; i<l; i++) {
                        if(options[i].selected) {
                            let attribute = {attribute_id: options[i].value, type_product_id: type_product};
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
                    this.axios.post("/admin/product/bindAttributesUpdate", {data: JSON.stringify(this.attrVal), typeProdId: this.typeProdId}).then(function (response)
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
                    this.axios.post("/admin/product/bindAttributes/"+JSON.stringify(this.attrVal), {}).then(function (response)
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