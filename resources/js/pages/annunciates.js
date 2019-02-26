
window.Vue = require('vue');
const annunciatesTable = require('./components/annunciates-table')

const app = new Vue({
    el: '#mainContent',
    components: {
        'annunciates-table': annunciatesTable
    }
});
