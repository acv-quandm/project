
window.Vue = require('vue');
const healthsHistory = require('./components/healths-history')

const app = new Vue({
    el: '#mainContent',
    components: {
        'healths-history': healthsHistory
    }
});
