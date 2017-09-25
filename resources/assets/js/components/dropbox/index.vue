<template>
    <div>
        <input type="text" v-model="input" class="dropbox" readonly v-bind:placeholder="placeholder" @focus="isVisible=true" v-on-click-outside="close">&nbsp;
        <i class="fa fa-caret-down arrow" aria-hidden="true"  @click="isVisible=true"></i>
        <input type="hidden" v-bind:name="nameelement" v-bind:value="val">
        <div class="items" v-if="isVisible">
            <ul>
                <li v-for="item in items" @click="selectElement(item.title,item.id)">
                    {{item.title}}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {mixin as onClickOutside} from 'vue-on-click-outside'
    export default {
        props: {
            nameelement: String,
            parent: Number,
            placeholder: String,
            url: String,
            value: Number,
        },
        mixins: [onClickOutside],
        data: function() {
            return {
                items:null,
                isVisible:false,
                input:"",
                val:"",
                parent_id:0
            }
        },
        mounted: function (){
            let that = this;
            this.axios.get(this.url, {}).then(function (response)
            {
                that.items = response.data;
                if(that.parent) {
                    that.items.forEach(function(item) {
                        if(item.id == that.parent) {
                            that.input = item.title;
                            that.val = item.id;
                        }
                    });
                }
            }).catch(function (error)
            {
                console.log(error);
            });
        },
        methods: {
            selectElement: function(title,id) {
                this.input = title;
                this.val = id;
                this.$emit('input', id);
                this.$emit('id', id);
                this.$emit('title',title);
                this.isVisible=false;
            },
            close: function() {
                this.isVisible=false;
            }
        }
    }
</script>
<style>
    .stealth {
        visibility: hidden;
    }
    input.dropbox {
        width:98%;
        padding-left: 10px;
    }
    .items {
        background-color: white;
        width: 98%;
        padding-left: 10px;
        border: 1px solid #fff0ff;
        border-top: none;
    }
    .items ul {
        margin: 0;
        padding: 0;
    }
    .items ul li {
        display: list-item;
        list-style: none;
    }
    .items ul li:hover  {
        background-color: rgba(200,200,200,0.5);
    }
</style>