
window.Vue = require('vue');
const reportsTable = require('./components/reports-table')

const app = new Vue({
    el: '#mainContent',
    components: {
        'reports-table': reportsTable
    }
});
