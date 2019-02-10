
window.Vue = require('vue');
const healthsTable = require('./components/healths-table')

const app = new Vue({
    el: '#mainContent',
    components: {
        'healths-table': healthsTable
    }
});
