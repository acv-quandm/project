
window.Vue = require('vue');
const lecturersTable = require('./components/lecturers-table')

const app = new Vue({
    el: '#mainContent',
    components: {
        'lecturers-table': lecturersTable
    }
});
