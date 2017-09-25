<template>
    <div>
        <br>
        <div v-if="isActive" class="alert alert-success">
            Успешно сохранено!
        </div>
        <div v-for="item in items" class="form-group" >
            <label v-bind:for="item.attribute_id">{{item.title}}</label>
            <input v-bind:name="item.attribute_id" type="text" v-model:value="item.value">
        </div>
        <div class="form-group">
            <!--<input v-bind:name="item.attribute_id" type="text" v-model:value="item.value">-->
        </div>
        <button v-bind:class="[{disabled: !items.length>0}]" class="btn btn-sucess"  @click="saveAttributes">Сохранить</button>
    </div>
</template>
<script>
    export default {
        props: {
            items: {
                type: [Object, Array],
                default: []
            },
            productId: Number,
            typeProductId: Number,
            producerTypeProductId: Number
        },
        data: function() {
            return {
                isActive: false,
                isDisable: true,
            }
        },
        mounted: function () {
            let that = this;
            if(this.producerTypeProductId) {
                this.axios.get("/admin/product/attributes/" + this.producerTypeProductId, {}).then(function (response) {
                    if (response.data.length > 0) {
                        response.data.forEach(function (item) {
                            let attribute = {attribute_id: item.id, title: item.title, value: ''};
                            that.items.push(attribute);
                        });
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
            if(this.typeProductId) {
                this.axios.get("/admin/product/attributesType/" + this.typeProductId, {}).then(function (response) {
                    if (response.data.length > 0) {
                        response.data.forEach(function (item) {
                            let attribute = {attribute_id: item.id, title: item.title, value: ''};
                            that.items.push(attribute);
                        });
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
            if(this.productId) {
                this.axios.get("/admin/product/existAttributes/"+this.productId, {}).then(function (response)
                {
                    if(response.data.length > 0)
                    {
                        response.data.forEach(function(item)
                        {
                            that.items.forEach((elem) => {
                            if(elem.attribute_id == item.id)
                            {
                                elem.value = item.value;
                            }
                            });
                            //let attribute = { attribute_id: item.id, title: item.title, value: item.value };
                            //that.items.push(attribute);
                        });
                    }
                }).catch(function (error)
                {
                    console.log(error);
                });
            }
        },
        methods: {
            saveAttributes: function () {
                let that = this;
                //console.log(this.productId);
                //console.log(JSON.stringify(this.items));
                this.axios.post("/admin/product/saveAttributes", {data: JSON.stringify(this.items), productId: this.productId}).then(function (response)
                {
                    that.isActive = true;
                }).catch(function (error)
                {
                    console.log(error);
                });
            }
        }
    }
</script>