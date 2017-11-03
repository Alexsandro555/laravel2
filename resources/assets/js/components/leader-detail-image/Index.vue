<template>
    <div>
        <div class="detail__images">
            <div class="detail-images-center">
                <img :src="curImage" width="280px"/>
            </div>
        </div>
        <div class="clear"></div>
        <div>
            <carousel name="carousel4" style="width: 270px; height: 100px; margin-left: 20px;"  :pagination-enabled=false :navigation-enabled=true :per-page=3  :per-page-custom="[[480, 3], [768, 3]]">
                <slide v-for="item in items" :key="item.id">
                    <div class="carousel-slide" @click="selectSlide(item.id)">
                        <img :src="'/storage/'+item.file" width="100%"/>
                    </div>
                </slide>
            </carousel>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            url: String,
        },
        data: function() {
            return {
                elements: [],
                items:[],
                curImage: '',
            }
        },
        mounted() {
            let that = this;
            this.axios.get(this.url, {}).then(function (response)
            {
                if(response.data.length > 0) {
                    that.elements = response.data;
                    that.elements.forEach(function (element) {
                        let obj = {'id': element.id, 'file': element.config.filename};
                        that.items.push(obj);
                    });
                    that.curImage = '/storage/' + that.elements[0].config.filename;
                }
            }).catch(function (error)
            {
                console.log(error);
            });
        },
        methods: {
            selectSlide: function (id, event) {
                let that = this;
                this.elements.forEach(function(element) {
                    if(element.id === id) {
                        that.curImage = '/storage/'+element.config.filename;
                    }
                });
            }
        }
    }
</script>