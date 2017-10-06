
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.CKEDITOR_BASEPATH = '/js/ckeditor/';
require('ckeditor');
window.Vue = require('vue');
import VeeValidate from 'vee-validate';
import VeeValidateMessagesRU from "vee-validate/dist/locale/ru";
import VueAxios from 'vue-axios';
import Autocomplete from 'v-autocomplete'
import 'v-autocomplete/dist/v-autocomplete.css'
import ToggleButton from 'vue-js-toggle-button'
import VueCarousel from 'vue-carousel';
import MaskedInput from 'vue-masked-input';

//import wysiwyg from "vue-wysiwyg";

/*Vue.use(wysiwyg, {
    hideModules: ["bold"],
    image: {
        uploadURL: "../storage/app/img"
    }
});*/

VeeValidate.Validator.addLocale(VeeValidateMessagesRU);
Vue.use(VeeValidate, {locale: 'ru'});
Vue.use(VueAxios, axios);
Vue.use(Autocomplete)

Vue.use(ToggleButton)
Vue.use(VueCarousel);

// Коммент
//window.Vue.use(wysiwyg, {});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));
//Vue.component('textarea-wysiwyg', require('./components/Textarea_wysiwyg.vue'));
//Vue.component('ck-wysiwyg', require('./Components/Ck_wysiwyg.vue'));
//Vue.component('table-generator', require('./Components/generatorTables/index.vue'));
//Vue.component('my-autocomplete', require('./components/My-autocomplete.vue'));
Vue.component('uploader', require('./components/Uploader.vue'));
Vue.component('dropbox', require('./components/dropbox/index.vue'));
Vue.component('add-attribute', require('./components/addAttribute/Index.vue'));
Vue.component('set-attribute', require('./components/setAttributes/Index.vue'));
Vue.component('set-attributes', require('./components/setLineProdAttributes/Index.vue'));
Vue.component('set-prodline-attribute', require('./components/setProdAttributes/Index.vue'));
Vue.component('product-line', require('./components/productLine/Index.vue'));
Vue.component('product-line2', require('./components/productLine2/Index.vue'));
Vue.component('product-lines', require('./components/productLines/Index.vue'));
Vue.component('selectbox', require('./components/selectbox/Index.vue'));
Vue.component('attributes-product', require('./components/attributesProduct/Index.vue'));
Vue.component('lselect', require('./components/lSelect/Index.vue'));
Vue.component('Tselect', require('./components/TSelect/Index.vue'));
Vue.component('leader-slider', require('./components/leader-slider/Index.vue'));
Vue.component('leader-detail-image', require('./components/leader-detail-image/Index.vue'));
Vue.component('alex-carousel', require('./components/alex-carousel/index'));
Vue.component('leader-cart-widget', require('./components/leader-cart-widget/index'));
Vue.component('type-slider', require('./components/type-slider/index'));
Vue.component('leader-cart', require('./components/leader-cart/index'));
Vue.component('leader-tabs', require('./components/leader-tabs/index'));
Vue.component('leader-set-attribute', require('./components/leader-set-attribute/index'));
import AlexVueCarousel from './components/alex-carousel/index.js';
Vue.use(AlexVueCarousel);
Vue.prototype.$eventBus = new Vue();

/*axios.interceptors.request.use(function (config) {
    config.headers['X-CSRF-TOKEN'] = Laravel.csrfToken;
    return config;
});*/

window.bus = new Vue();

// create a root instance
new Vue({
    el: '#app',
    data: {
        myHTML: '',
        attrProd: [],
        CharacteristicActive: true,
        DescriptionActive: false,
        DetailActive: false,
        cart: {
            count:0,
            total:0
        },
        selectTypeProd: 0,
        selectLineProd: 0
    },
    components: {
      MaskedInput
    },
    methods: {
        addCart: function (id) {
            let that = this;
            this.axios.get('/add-cart/'+id, {}).then(function (response) {
                let cartVal = response.data;
                that.cart.count =  cartVal.count;
                that.cart.total = cartVal.total;
            }).catch(function (error)
            {
                console.log(error);
            });
        },
        selectProductLine: function(id) {
            let that = this;
            this.attrProd = [];
            this.axios.get("/admin/product/attributes/" + this.selectTypeProd +"/"+id, {}).then(function (response) {
                if (response.data.length > 0) {
                    response.data.forEach(function (item) {
                        let attribute = {attribute_id: item.id, title: item.title, value: ''};
                        that.attrProd.push(attribute);
                    });
                }
            }).catch(function (error) {
                console.log(error);
            });
        },
        selectType: function(id) {
            let that = this;
            this.attrProd = [];
            this.axios.get("/admin/product/attributes/" + id +"/"+0, {}).then(function (response) {
                if (response.data.length > 0) {
                    response.data.forEach(function (item) {
                        let attribute = {attribute_id: item.id, title: item.title, value: ''};
                        that.attrProd.push(attribute);
                    });
                }
            }).catch(function (error) {
                console.log(error);
            });
        },
        tabActive(state)
        {
            if(state == 'CharacteristicActive')
            {
                this.CharacteristicActive = true;
                this.DescriptionActive = false;
                this.DetailActive = false;
            }
            if(state == 'DescriptionActive')
            {
                this.CharacteristicActive = false;
                this.DescriptionActive = true;
                this.DetailActive = false;
            }
            if(state == 'DetailActive')
            {
                this.CharacteristicActive = false;
                this.DescriptionActive = false;
                this.DetailActive = true;
            }
        }
    }
});





