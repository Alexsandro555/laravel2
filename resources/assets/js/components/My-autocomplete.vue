<template>
    <v-autocomplete :items="items" v-model="item" v-on:onblur="ChangeAutocomplete" :get-label="getLabel" :component-item='template' @update-items="updateItems">
    </v-autocomplete>
</template>


<script>
    import ItemTemplate from './ItemTemplate.vue'
    export default {
        data () {
            return {
                item: {id: 0, name: '', description: ''},
                items: [],
                template: ItemTemplate
            }
        },
        methods: {
            getLabel (item) {
                return item.name
            },
            updateItems (text) {
                var that = this;
                that.items = [];
                this.axios.get('/admin/page/autocoplete/'+text, {
                    headers: {
                        'Content-type': 'application/json'
                    }
                }).then(function (response)
                {
                    ///that.items = null;
                    response.data.forEach(function(a)
                    {
                        //console.log(a.content);
                        that.items.push(a);
                    })
                }).catch(function (error)
                {
                    console.log(error);
                });
            },
            ChangeAutocomplete ()
            {
                alert('work');
                this.$emit("autocomplate-update",this.item);
            }
        }
    }
</script>



<style lang="stylus">
    .v-autocomplete
     .v-autocomplete-input-group
      .v-autocomplete-input
       font-size 1.1 em
       padding 6px 6px
       box-shadow none
       border 1px solid #d2d6de
       width calc(100% - 32px)
       outline none
       background-color white
    &.v-autocomplete-selected
     .v-autocomplete-input
      color green
      backgroud-color #f2fff2
    .v-autocomplete-list
     width 100%
     z-index: 10
     text-align left
     border none
     border-top none
     max-height 400px
     overflow-y auto
     border-bottom 1px solid #157977
    .v-autocomplete-list-item
     cursor pointer
     background-color #fff
     padding 10px
     border-top 1px solid #157977
     border-buttom 1px solid #157977
     border-left 1px solid #157977
     border-right 1px solid #157877
     &:last-child
      border-buttom none
     &:hover
      background-color #eee
     abbr
      opacity 0.8
      font-size 0.8em
      display block
      font-family sans-serif
    pre
     text-align left
     white-space pre-wrap
     background-color #eee
     border 1px solid silver
     padding 20px !important
     border-radius 10px
     font-family monospace !important
    .left
     text-align left
    .note
     border-left 5px solid #ccc
     padding 10px
</style>