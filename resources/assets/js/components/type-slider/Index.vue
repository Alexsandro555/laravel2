<template>
    <div>
        <carousel name="carousel2" style="width: 650px; height: 226px"  :pagination-enabled=false :navigation-enabled=true :per-page=perpage  :per-page-custom="[[480, perpage], [768, perpage]]">
            <slide v-for="item in items" :key="item.id">
                <div class="wam__spec-prod">
                    <div class="wam__spec-prod-img">
                        <img v-if="item.file" :src="'/storage/'+item.file" height="80px"/>
                        <img v-if="!item.file" :src="'/storage/no-image.png'" height="140px"/>
                    </div>
                    <div class="wam__spec-prod-title">
                        {{item.title.length>52?item.title.substr(0,50)+'...':item.title}}
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