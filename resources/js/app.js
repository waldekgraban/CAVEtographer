require('./bootstrap');

window.Vue = require('vue');

//Register external packages
    import Fragment from 'vue-fragment'
    Vue.use(Fragment.Plugin)

//Register custom components
    // Vue.component('example-component', require('./components/Path/to/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});
