
window.Vue = require('vue');
const periodicsTable = require('./components/periodics-table')

const app = new Vue({
    el: '#mainContent',
    components: {
        'periodics-table': periodicsTable
    }
});
