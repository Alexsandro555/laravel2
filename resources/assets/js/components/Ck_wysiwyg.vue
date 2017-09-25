<template>
    <div class="app">
        <ckeditor v-model="content" :name="name" :config="config"></ckeditor>
    </div>
</template>

<script>
    import Ckeditor from 'vue-ckeditor2'

    export default {
        props: {
            name: {
                type: String
            }
        },
        data () {
            return {
                content: '',
                config: {
                    toolbar: [
                        [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                    ],
                    height: 300
                }
            }
        },
        components: { Ckeditor }
    }
</script>