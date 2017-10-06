<template>
    <div>
        <div class="form-group" >
            <label for="typeproducts">Тип продукции</label><br>
            <select name="typeproducts" v-model="selectedTypeProduct" @change="selectTypeProduct" class="sel">
                <option disabled value="">Выбирите тип продукта</option>
                <option v-for="typeProduct in arrTypeProducts" :value="typeProduct.id">
                    {{typeProduct.title}}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="lineproducts">Линейка продукции</label><br>
            <select name="lineproducts" v-model="selectedLineProduct" @change="selectLineProduct" class="sel">
                <option disabled value="">Выбирите линейку продукции</option>
                <option v-for="lineProduct in arrLineProducts" :value="lineProduct.id">
                    {{lineProduct.title}}
                </option>
            </select>
        </div>
        <select multiple @change="selectAttribute($event)" class="attr-sel">
            <option v-for="attribute in attrFiltr" :value="attribute.id" :selected="existItem(attrVal, attribute.id)">
                {{attribute.title}}
            </option>
        </select><br><br>
        <button class="btn btn-sucess" v-bind:disabled="disabled" @click="save">Сохранить</button>
        <p>
            <br>
            Аттрибуты типа продукции<br>
            <select multiple v-model="selectedAttrTypeProduct" @change="selectAttributeTypeProduct($event)" class="attr-sel">
                <option v-for="attribute in attrTypeProducts" :value="attribute.id">
                    {{attribute.title}}
                </option>
            </select><br><br>
            <button class="btn btn-sucess"  @click="saveTypeProd">Исключить атрибут</button>
        </p>
        <p>
            Аттрибуты линейки продукции<br>
            <select multiple v-model="selectedAttrLineProduct" @change="selectAttributeLineProduct($event)" class="attr-sel">
                <option v-for="attribute in attrLineProducts" :value="attribute.id" >
                    {{attribute.title}}
                </option>
            </select><br><br>
            <button class="btn btn-sucess"  @click="saveLineProd">Исключить атрибут</button>
        </p>

    </div>
</template>
<script>
    export default {
        data: function() {
            return {
                arrTypeProducts: [],
                arrLineProducts: [],
                attributes:[],
                attrVal: [],
                disabled: true,
                typeProductId: 0,
                lineProductId: 0,
                selectedTypeProduct: "",
                selectedLineProduct: "",
                attrTypeProducts: [],
                attrLineProducts: [],
                attrFiltr: [],
                attrResp: [],
                attrTypeProd: [],
                attrLineProd: [],
                selectedAttrTypeProduct: [],
                selectedAttrLineProduct: []
            }
        },
        created: function () {
            let that = this;
            // получение списка всех атрибутов
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
            // получение списка всех типов продукции
            this.axios.get("/admin/product/getTypeProducts", {}).then(function (response)
            {
                let typeProdId;
                if(response.data.length > 0) {
                    response.data.forEach(function(item) {
                        if(typeProdId === undefined) typeProdId = item.id;
                        var typeProd = {id: item.id, title: item.title};
                        that.arrTypeProducts.push(typeProd);
                    });
                    //that.selectTypeProduct(typeProdId);
                }
            }).catch(function (error)
            {
                console.log(error);
            });

        },
        methods: {
            selectTypeProduct(event) {
                this.typeProductId = this.selectedTypeProduct;
                let id = this.selectedTypeProduct;
                let that = this;
                this.arrLineProducts = [];
                this.selectedLineProduct = "";
                this.attrLineProducts = [];
                // получение линейки продукции заданного типа продукции
                this.axios.get("/admin/product/getLineProduct/"+id, {}).then(function (response)
                {
                    if(response.data.length > 0) {
                        response.data.forEach(function(item) {
                            var prodLine = {id: item.id, title: item.name_line};
                            that.arrLineProducts.push(prodLine);
                        });
                    }
                }).catch(function (error)
                {
                    console.log(error);
                });
                this.attrVal = [];
                // получение атрибутов заданного типа продукции
                this.axios.get("/admin/product/getAttributesTypeProduct/"+id, {}).then(function (response)
                {
                    that.attrVals = response.data;
                    that.attrTypeProducts = response.data;
                }).catch(function (error)
                {
                    console.log(error);
                });
                this.axios.get("/admin/product/getNAttributesTypeProduct/"+id, {}).then(function (response)
                {
                    console.log(response.data);
                    that.attrFiltr = response.data;
                }).catch(function (error)
                {
                    console.log(error);
                });
            },
            selectLineProduct(event) {
                let id = this.selectedLineProduct;
                this.lineProductId = id;
                this.attrVal = [];
                let that = this;
                // получение атрибутов линейки продукции
                this.axios.get("/admin/product/getAttributesLineProduct/"+id, {}).then(function (response)
                {
                    that.attrVals = response.data;
                    that.attrLineProducts = response.data;
                }).catch(function (error)
                {
                    console.log(error);
                });
                this.axios.get("/admin/product/getNAttributesLineProduct/"+id, {}).then(function (response)
                {
                    that.attrFiltr = response.data;
                }).catch(function (error)
                {
                    console.log(error);
                });
            },
            selectAttribute: function(event) {
                let type_product = document.getElementsByName('typeproducts')[0].value;
                this.attrVal = [];
                this.attrResp = [];
                if(type_product>0)
                {
                    this.disabled = false;
                    let options = event.target.options;
                    for (let i=0, l = options.length; i<l; i++) {
                        if(options[i].selected) {
                            let attribute = {id: options[i].value};
                            this.attrResp.push(attribute);
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
            selectAttributeTypeProduct: function(event) {
                this.attrTypeProd = [];
                    //this.disabled = false;
                    let options = event.target.options;
                    for (let i=0, l = options.length; i<l; i++) {
                        if(options[i].selected) {
                            let attribute = {id: options[i].value};
                            this.attrTypeProd.push(attribute);
                        }
                    }
            },
            selectAttributeLineProduct: function(event) {
                this.attrLineProd = [];
                //this.disabled = false;
                let options = event.target.options;
                for (let i=0, l = options.length; i<l; i++) {
                    if(options[i].selected) {
                        let attribute = {id: options[i].value};
                        this.attrLineProd.push(attribute);
                    }
                }
            },
            existItem(arr, val) {
                let result = false;
                arr.forEach(function(item) {
                    if(item.id == val)
                    {
                        result = true;
                    }
                });
                return result;
            },
            save() {
                this.axios.post("/admin/product/bindAttributes", {attr: this.attrResp, typeProductId: this.typeProductId, lineProductId: this.lineProductId}).then(function (response)
                {
                    location.reload();
                }).catch(function (error)
                {
                    console.log(error);
                });
            },
            saveTypeProd() {
                this.axios.post("/admin/product/remAttrTypeProd", {attr: this.selectedAttrTypeProduct}).then(function (response)
                {
                    location.reload();
                }).catch(function (error)
                {
                    console.log(error);
                });
            },
            saveLineProd() {
                this.axios.post("/admin/product/remAttrLineProd", {attr: this.selectedAttrLineProduct}).then(function (response)
                {
                    location.reload();
                }).catch(function (error)
                {
                    console.log(error);
                });
            }
        }
     }
</script>
<style scoped>
    .sel {
        width:300px;
    }
    .attr-sel {
        width: 300px;
        heigth: 50%;
    }
</style>