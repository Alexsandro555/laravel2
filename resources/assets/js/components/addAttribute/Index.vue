<template>
    <div>
        <div class="form-group" >
            <label for="typeproducts">Тип продукции</label>
            <selectbox v-bind:nameelement="'typeproducts'"  v-bind:items="arrTypeProducts" v-on:selectelement="selectelement" v-bind:placeholder="'Выбирите тип продукции'"></selectbox>
        </div>
        <div v-if="!!attributes">
            <div class="new-attribute" v-for="attribute of attributes">
                <div class="form-group">
                    <label for="attribute_id">Аттрибут</label>
                    <dropbox v-bind:nameelement="'attribute_id'" v-bind:parent="attribute.id" v-bind:placeholder="'Выберите атрибут'" v-bind:url="'/admin/product/getAllAttributes'"></dropbox>
                </div>
                <div class="form-group">
                    <label for="value">Значение</label>
                    <input name="value" v-bind:value="attribute.value" class="attr-val"  type="text" value="attribute.value">
                </div>
            </div>
        </div>
        <div v-else></div>
        <div class="form-group" >
            <label for="attribute_id">Аттрибут</label>
            <dropbox v-bind:nameelement="'attribute_id'"  v-model="newAttribute.id" v-bind:placeholder="'Выберите атрибут'" v-bind:url="'/admin/product/getAllAttributes'"></dropbox>
        </div>
        <div class="form-group">
            <label for="value">Значение</label>
            <input name="value" class="attr-val"  type="text" v-model="newAttribute.value">
        </div>
        <button class="btn btn-sucess" @click="addAttribute">Добавить атрибут</button>
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
                newAttribute: {
                    id: 0,
                    value: ""
                },
                attributes: [],
                disabled: true,
                typeProdId: 0
            }
        },
        methods: {
            addAttribute: function() {
                var attribute = {id: this.newAttribute.id, value: this.newAttribute.value,  type_product_id: this.typeProdId };
                this.attributes.push(attribute);
                this.newAttribute.id = null;
                this.newAttribute.value = null;

            },
            selectelement: function(id) {
                this.typeProdId = id;
                this.disabled = false;
                this.attributes = [];
                var that = this; this.axios.get("/admin/product/getAttributes/"+id, {}).then(function (response)
                {
                    if(response.data.length > 0) {
                        response.data.forEach(function(item) {
                            var attribute = {id: item.attribute_id, value: item.value, type_prodcut_id: item.type_product_id};
                            that.attributes.push(attribute);
                        });
                    }
                }).catch(function (error)
                {
                    console.log(error);
                });

            },
            save: function () {
                let type_product = document.getElementsByName('typeproducts').value;
                this.axios.post("/admin/product/addAttributeValue/"+JSON.stringify(this.attributes), {}).then(function (response)
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
<style>
    .new-attribute {
        margin-top: 50px;
        margin-bottom: 30px;
        overflow: hidden;
    }
    .attr-val {
        width: 100%;

    }
</style>