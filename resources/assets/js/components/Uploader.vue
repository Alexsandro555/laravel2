<template>
    <div>
        <p>Загрузчик файлов</p>

        <dropzone id="myVueDropzone" acceptedFileTypes="image/*" :url="url" v-on:vdropzone-success="showSuccess" v-on:vdropzone-error="showError"  v-on:vdropzone-mounted="dropzoneMounted"  v-bind:useFontAwesome=true v-bind:language=dzOptions ref="myVueDropzone" v-on:vdropzone-removed-file="fileRemoved" v-bind:maxNumberOfFiles="10">
            <!-- Optional parameters if any! -->
            <input type="hidden" name="_token" :value="csrfToken">
        </dropzone>
    </div>
</template>

<script>
    import Dropzone from 'vue2-dropzone'

    export default {
        name: 'Uploader',
        props: {
            'url': String,
            'elementId': {
                type: Number,
                default: 0
            }
            },
        data: function() {
            return {
                csrfToken: Laravel.csrfToken,
                dzOptions: {
                    dictDefaultMessage: '<br>Переместите файлы для загрузки ',
                },
            }
        },
        components: {
            Dropzone
        },
        mounted: function () {
            //var $element = document.getElementById("files-id");
            //$element.value = "";
        },
        methods: {
            'showSuccess': function (file,data) {
                //console.log('work');
                var $element = document.getElementById("files-id");
                var ids = JSON.parse($element.value);
                ids.push(data.id);
                $element.value = JSON.stringify(ids);
            },
            'showError': function (file) {
                console.log(file);
            },
            'fileRemoved': function(file)  {
                //console.log('Deleting: '+file.id);
                let id = file.id;
                this.axios.get('/deleteFile/'+id, {}).then(function (response) {
                }).catch(function (error)
                {
                    console.log(error);
                });
                console.log(file);
            },
            'dropzoneMounted': function () {
                let that = this;
                let dropzone = this.$refs.myVueDropzone;
                this.axios.get('/getFiles/'+that.elementId, {}).then(function (response)
                {
                    let data = response.data;
                    for(let key in data) {
                        let image = data[key];
                        let id = image.id;
                        let filename = image.filename;
                        let size = image.size;
                        let mockFile = {id: id, name: filename, size: size};
                        dropzone.manuallyAddFile(mockFile,"/storage/"+filename,null,null,{dontSubstractMaxFiles: false, addToFiles: true});
                    }
                }).catch(function (error)
                {
                    console.log(error);
                });
            }
        }
    }
</script>

