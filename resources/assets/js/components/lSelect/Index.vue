<template>
    <div v-if="!!items">
        <input type="text" v-model="input" class="selectbox" readonly v-bind:placeholder="placeholder" @focus="isVisible=true" v-on-click-outside="close">&nbsp;
        <i class="fa fa-caret-down arrow" aria-hidden="true"  @click="isVisible=true"></i>
        <input type="hidden" v-bind:name="nameelement" v-bind:value="val">
        <div class="items" v-if="isVisible">
            <ul>
                <li v-for="elem in elems" @click="selectElement(elem.title,elem.id)">
                    {{elem.title}}
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    import {mixin as onClickOutside} from 'vue-on-click-outside'

    let traverse = require('traverse');
    export default {
        props:
        {
            elementsVal:
            {
                type: [Object, Array],
                default:[]
            },
            nameelement: String,
            placeholder: String,
            defaultId: Number
        },
        mixins: [onClickOutside],
        data: function()
        {
            return {
                isVisible:false,
                elementVal: _.cloneDeep(this.elementsVal),
                items:[],
                input: "",
                val: "",
            }
        },
        /*watch: {
            elementsVal: { handler:function(newVal) {
                //console.log('New Val: '+JSON.stringify(newVal));
                //console.log('watch: '+JSON.stringify(newVal));
                this.elementVal = _.cloneDeep(newVal); //Object.assign({},newVal);
                this.items = [];
                let name = this.nameelement;
                let that = this;
                let elems = [];
                var scrubbed = traverse(this.elementVal).map(function(obj) {
                    if(typeof obj == "object")
                    {
                        let arrObj = Object.keys(obj);
                        arrObj.forEach(function (item)
                        {
                            if (item == that.nameelement)
                            {
                                elems.push(obj[item]);
                                return obj[item];
                            }
                        });
                    }
                },[]);
                elems.forEach(function(item) {
                    item.forEach(function (item) {
                        that.items.push({'id': item.id, 'title': item.title, 'sort': item.sort});
                    });
                });
                if(this.items.length>0) {
                    this.items.sort(this.asc('sort'));
                    this.input = this.items[0].title;
                    this.val = this.items[0].id;
                }
            },
                deep:false
            }
        },*/
        computed:
        {
            elems: function()
            {
                //console.log('elems: '+this.nameelement);
                //console.log('Item: '+JSON.stringify(this.elementsVal))
                console.log('computed');
                this.items = [];
                let name = this.nameelement;
                let that = this;
                let elems = [];
                var scrubbed = traverse(this.elementVal).map(function(obj) {
                    if(typeof obj == "object")
                    {
                        let arrObj = Object.keys(obj);
                        arrObj.forEach(function (item)
                        {
                            if (item == that.nameelement)
                            {
                                elems.push(obj[item]);
                                return obj[item];
                            }
                        });
                    }
                },[]);
                elems.forEach(function(item) {
                    item.forEach(function (item) {
                        that.items.push({'id': item.id, 'title': item.title, 'sort': item.sort});
                    });
                });
                if(this.items.length>0) {
                    //console.log("пусто");
                    this.items.sort(this.asc('sort'));
                    this.input = this.items[0].title;
                    this.val = this.items[0].id;
                    return this.items;
                }
                else {
                    return "";
                }
            },
        },
        methods: {
            asc: function(field) {
                return function (x, y) {
                    return x[field] > y[field];
                }
            },
            selectElement: function(title,id)
            {
                this.input = title;
                this.val = id;
                this.$emit('input', id);
                //this.$emit('selectelement', id);
                this.isVisible=false;
            },
            close: function() {
                this.isVisible=false;
            },
        },
    }
</script>
<style>
    .stealth {
        visibility: hidden;
    }
    input.selectbox {
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