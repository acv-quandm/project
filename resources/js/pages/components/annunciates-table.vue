<template>
    <div class="container-fluid">
        <h4 class="c-grey-900 mT-10 mB-30">Danh sách báo cáo</h4>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Tìm kiếm</label>
                    <input type="text" class="form-control" @keydown.enter="getInfo(page,query)" v-model="query">
                </div>
                <div class="row" v-if="loading">
                    <div class="col-md-12">
                        <div class="loader">
                            <div class="loader-inner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Người tạo</th>
                            <th scope="col">Thời gian tạo</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-for="item in list">
                            <tr>
                                <th scope="row">{{item.id}}</th>
                                <td>{{item.title}}</td>
                                <td>{{item.user.name }}</td>
                                <td>{{item.created_at | formatDateTimeFilter}}</td>
                                <td>
                                    <button class="btn btn-info" @click="showItem(item.id)">Chi tiết</button>
                                </td>
                            </tr>
                        </template>

                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item">
                                <a class="page-link" href="#" @click="getInfo(page-1,query)" v-if="page > 1" tabindex="-1">Previous</a>
                            </li>
                            <template v-for="i in last_page">
                                <li v-if="(i <= page + 2 && i >= page - 2) || i > last_page - 3" :class="'page-item' + (page == i ? ' active': '') "><a class="page-link" @click="getInfo(i,query)" href="#">{{i}}</a></li>
                                <li v-if="i == page+5"><a class="page-link" href="#">.....</a></li>
                            </template>

                            <li class="page-item">
                                <a class="page-link" @click="getInfo(page+1,query)" href="#" v-if="page < last_page">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="modal fade" id="show-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chi tiết báo cáo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3>{{temp.title}}</h3>
                        <div v-html="temp.content">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
     </div>
</template>
<script>
    import moment from 'moment'
    export default {
        name: 'Reports-Table',
        props: {
            user_id: {
                type: String,
                required: true
            }
        },
        computed: {
        },
        components: {
        },
        data() {
            return {
                list: [

                ],
                temp: {
                    title:'',
                    content: '',
                },
                loading: false,
                page: 1,
                query: null,
                action: 'create',
                last_page: 1,
            }
        },
        mounted(){
            this.getInfo()
        },
        methods: {
            getInfo(page = 1,query = null){
                axios.get('/api/reports',{
                    params: {
                        page: page,
                        query: query
                    }
                }).then(response => {
                    this.list = response.data.data
                    this.last_page = response.data.last_page
                    this.page = response.data.current_page
                })
            },
            resetTemp(){
              this.temp = {
                  title:'',
                  content: '',
              }
            },
            showItem(id){
                this.temp = JSON.parse(JSON.stringify(this.list.find(item => {
                    return item.id == id
                })))
                $('#show-item').modal('show')
            },
        },
        filters:{
            formatDateTimeFilter(dateTime){
                return moment(dateTime).format('YYYY/MM/DD HH:mm:ss')
            }
        }
    }
</script>
