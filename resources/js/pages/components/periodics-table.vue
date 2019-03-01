<template>
    <div class="container-fluid">
        <h4 class="c-grey-900 mT-10 mB-30">Quản lý các đợi khám sức khỏe</h4>
        <div style="display: inline-block;">
            <button type="button" class="btn btn-info mB-20" data-toggle="modal" data-target="#create-update-item" @click="action = 'create';resetTemp()">Thêm mới</button>
        </div>
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
                            <th scope="col">Tên đợi khám</th>
                            <th scope="col">Thời gian khám</th>
                            <th scope="col">Địa điểm khám</th>
                            <th scope="col">Nội dung khám</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-for="item in list">
                            <tr>
                                <th scope="row">{{item.id}}</th>
                                <td>{{item.name}}</td>
                                <td>{{item.time_start | formatDateTimeFilter}}</td>
                                <td>{{item.location}}</td>
                                <td>{{item.info}}</td>
                                <td>
                                    <button class="btn btn-info" @click="editItem(item.id)">Sửa</button>
                                    <button class="btn btn-danger" @click="deleteItem(item.id)">Xóa</button>
                                    <button class="btn btn-primary" @click="reportItem(item.id)">Báo cáo</button>
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
        <div class="modal fade" id="create-update-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{action == 'create' ? 'Thêm một sự cố' : 'Chỉnh sửa sự cố'}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" @submit.prevent="action == 'create' ? createItem(): updateItem()">
                        <div class="modal-body">
                            <div class="mT-30">
                                <div class="form-group">
                                    <label>Tên đợi khám</label>
                                    <input type="text" v-model="temp.name" required class="form-control" aria-describedby="emailHelp" placeholder="Điền tên đợi khám">
                                </div>
                                <div class="form-group">
                                    <label>Thời gian khám</label>
                                    <input type="datetime-local" v-model="temp.time_start" required class="form-control" aria-describedby="emailHelp" placeholder="Thời gian khám">
                                </div>
                                <div class="form-group">
                                    <label>Địa điểm khám</label>
                                    <input type="text" v-model="temp.location" class="form-control" placeholder="Nhập địa điểm khám">
                                </div>
                                <div class="form-group">
                                    <label>Nội dung khám</label>
                                    <input type="text" class="form-control" v-model="temp.info"  placeholder="Nội dung khám">
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="loading">
                            <div class="col-md-12">
                                <div class="loader">
                                    <div class="loader-inner"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" v-if="action == 'create'" class="btn btn-primary">Thêm mới</button>
                            <button type="submit" v-if="action == 'update'" class="btn btn-primary">Update thông tin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="remove-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Bạn đồng ý xóa chứ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Sau khi xóa, mọi thông tin sẽ không thể khôi phục!!!
                    </div>
                    <div class="row" v-if="loading">
                        <div class="col-md-12">
                            <div class="loader">
                                <div class="loader-inner"></div>
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="removeItem">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="report-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Báo cáo về thông tin đợt khám</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <canvas id="pie-chart" width="800" height="450"></canvas>
                    </div>
                    <div class="row" v-if="loading">
                        <div class="col-md-12">
                            <div class="loader">
                                <div class="loader-inner"></div>
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="removeItem">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Chart from 'chart.js'
    import moment from 'moment'
    export default {
        name: 'Periodics-Table',
        computed: {
          departmentName(){
              return this.departments.map(item => {
                  return item.name
              })
          }
        },
        data() {
            return {
                list: [

                ],
                temp: {
                    name:'',
                    time_start: '',
                    info: '',
                    location: '',
                },
                loading: false,
                page: 1,
                query: null,
                action: 'create',
                last_page: 1,
                departments: [],
                myChart: null
            }
        },
        mounted(){
            this.getInfo()
        },
        methods: {
            getInfo(page = 1,query = null){
                axios.get('/api/periodics',{
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
                  name:'',
                  time_start: '',
                  info: '',
                  location: ''
              }
            },
            createItem(){
                this.loading = true
                axios.post('/api/periodics',this.temp).then(response => {
                    this.loading = false
                    this.getInfo(this.page,this.query)
                    $('#create-update-item').modal('hide')
                }).catch(err => {
                    this.loading = false
                    console.log(err)
                })
            },
            updateItem(){
                this.loading = true
                axios.put('/api/periodics/'+this.temp.id,this.temp).then(response => {
                    this.loading = false
                    this.getInfo(this.page,this.query)
                    $('#create-update-item').modal('hide')
                }).catch(err => {
                    this.loading = false
                    console.log(err)
                })
            },
            editItem(id){
                this.temp = JSON.parse(JSON.stringify(this.list.find(item => {
                    return item.id == id
                })))
                this.temp.time_start = this.temp.time_start.replace(' ','T')
                this.action = 'update'
                $('#create-update-item').modal('show')
            },
            deleteItem(id){
                $('#remove-item').modal('show')
                this.temp = this.list.find(item => {
                    return item.id == id
                })
            },
            removeItem(){
                this.loading = true
                axios.delete('/api/periodics/'+this.temp.id).then(response => {
                    this.loading = false
                    this.getInfo(this.page,this.query)
                    $('#remove-item').modal('hide')
                }).catch(err => {
                    this.loading = false
                    console.log(err)
                })
            },
            reportItem(id){
                if(this.myChart != null){
                    this.myChart.destroy()
                }
                this.temp = JSON.parse(JSON.stringify(this.list.find(item => {
                    return item.id == id
                })))
                this.temp.time_start = this.temp.time_start.replace(' ','T')
                $('#report-item').modal('show')
                axios.post('/api/periodics/'+ this.temp.id +'/report').then(response => {
                    let result = response.data
                    let labels = result.labels
                    let data = result.data
                    this.myChart = new Chart(document.getElementById("pie-chart"), {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Population (millions)",
                                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                                data: data
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'Thống kê thông tin đợt khám'
                            }
                        }
                    });
                })

            }
        },
        filters:{
            formatDateTimeFilter(dateTime){
                return moment(dateTime).format('YYYY/MM/DD HH:mm:ss')
            }
        }
    }
</script>
