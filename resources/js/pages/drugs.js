
window.Vue = require('vue');
const drugsTable = require('./components/drugs-table')

const app = new Vue({
    el: '#mainContent',
    components: {
        'drugs-table': drugsTable
    }
});
