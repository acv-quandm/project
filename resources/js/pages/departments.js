
window.Vue = require('vue');
const departmentsTable = require('./components/departments-table')

const app = new Vue({
    el: '#mainContent',
    components: {
        'departments-table': departmentsTable
    }
});
