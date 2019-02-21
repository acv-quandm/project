
window.Vue = require('vue');
const troublesTable = require('./components/troubles-table')

const app = new Vue({
    el: '#mainContent',
    components: {
        'troubles-table': troublesTable
    }
});
