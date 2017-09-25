<template>
    <div>
        <carousel name="carousel2" style="width: perpage*200px; height: 326px"  :pagination-enabled=false :navigation-enabled=true :per-page=perpage  :per-page-custom="[[480, perpage], [768, perpage]]">
            <slide v-for="item in items" :key="item.id">
                <div class="product-wrapper">
                    <div class="product">
                        <div class="product-image">
                            <img v-if="item.file" :src="'/storage/'+item.file" height="100px"/>
                            <img v-if="!item.file" :src="'/storage/no-image.png'" height="200px"/>
                        </div>
                        <div class="product-name"><a :href="'/catalog/'+item.slug">{{item.title.length>52?item.title.substr(0,50)+'...':item.title}}</a></div>
                        <div class="product-desc">
                            Сделан на заказ из стандартных компонентов
                            <hr class="product-hr">
                            <div>
                                <span class="product-price">{{item.price}}</span> <span class="product-rub">руб.</span>
                                <img src="/storage/product-cart.png"/>
                            </div>
                        </div>
                    </div>
                </div>
            </slide>
        </carousel>
    </div>
</template>
<script>
    export default {
        props: {
            url: String,
            perpage: {
                type: Number,
                default: 3
            }
        },
        data: function() {
            return {
                items:[],
            }
        },
        created() {
            let that = this;
            this.axios.get(this.url, {}).then(function (response)
            {
                if(response.data.length > 0) {
                    let elements = response.data;
                    elements.forEach(function (element) {
                        let obj = {
                            'id': element.id,
                            'title': element.title,
                            'price': element.price,
                            'file': element.files.length>0?element.files.shift().filename:null,
                            'slug': element.url_key
                        };
                        that.items.push(obj);
                    });
                }
            }).catch(function (error)
            {
                console.log(error);
            });
        }
    }
</script>