<template>
    <div class="container-fluid">
        <h4 class="c-grey-900 mT-10 mB-30">Danh sách giảng viên</h4>
        <div style="display: inline-block;">
            <button type="button" class="btn btn-info mB-20" data-toggle="modal" data-target="#create-update-item" @click="action = 'create';resetTemp()">Thêm mới</button>
            <button type="button" data-toggle="modal" data-target="#create-update-item-excel" class="btn btn-success mB-20" >Tải lên excel</button>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Họ tên</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Email</th>
                            <th scope="col">Chuyên ngành</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-for="item in list">
                            <tr>
                                <th scope="row">{{item.id}}</th>
                                <td>{{item.name}}</td>
                                <td>{{item.address}}</td>
                                <td>{{item.phone_number}}</td>
                                <td>{{item.email}}</td>
                                <td>{{item.department != undefined ? item.department.name : '' }}</td>
                                <td>
                                    <button class="btn btn-info" @click="editItem(item.id)">Sửa</button>
                                    <button class="btn btn-danger" @click="deleteItem(item.id)">Xóa</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Thêm một giảng viên</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" @submit.prevent="action == 'create' ? createItem(): updateItem()">
                        <div class="modal-body">
                            <div class="mT-30">
                                <div class="form-group">
                                    <label>Điền tên giảng viên</label>
                                    <input type="text" v-model="temp.name" required class="form-control" name="name" aria-describedby="emailHelp" placeholder="Tên giảng viên">
                                </div>
                                <div class="form-group">
                                    <label>Điền địa chỉ</label>
                                    <input type="text" v-model="temp.address" class="form-control" name="address" placeholder="Điền địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label>Điền số điện thoại</label>
                                    <input type="text" class="form-control" v-model="temp.phone_number" name="phone_number" placeholder="Nhập số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label>Điền ngày tháng năm sinh</label>
                                    <input type="date" class="form-control" v-model="temp.birthday" name="birthday" placeholder="Chọn ngày tháng năm sinh">
                                </div>
                                <div class="form-group">
                                    <label>Điền email</label>
                                    <input type="email" class="form-control" v-model="temp.email" name="email" placeholder="Điền email">
                                </div>
                                <div class="form-group">
                                    <label>Chọn chuyên ngành</label>
                                    <select name="" class="form-control" v-model="temp.department_id" id="">
                                        <template v-for="item in departments">
                                            <option :value="item.id">{{item.name}}</option>
                                        </template>
                                    </select>
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
        <div class="modal fade" id="create-update-item-excel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm bằng Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data" @submit.prevent="uploadFile">
                        <div class="modal-body">
                            <div class="mT-30">
                                <div class="form-group">
                                    <label>Chọn file</label>
                                    <input type="file" required @change="setFile">
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
    </div>
</template>
<script>
    export default {
        name: 'Lecturers-Table',
        data() {
            return {
                list: [

                ],
                temp: {
                    name: '',
                    address: '',
                    phone_number: '',
                    department_id: '',
                    birthday: '',
                    email: ''
                },
                loading: false,
                page: 1,
                query: null,
                action: 'create',
                last_page: 1,
                file: null,
                departments: [],
            }
        },
        mounted(){
            this.getInfo()
            this.getDepartments()
        },
        methods: {
            setFile(e){
                this.file = e.target.files[0]
            },
            getInfo(page = 1,query = null){
                axios.get('/api/lecturers',{
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
            uploadFile(){

                let formData = new FormData()
                formData.append('file',this.file)
                this.loading = true
                axios.post('/api/lecturers/excel',formData).then(response => {
                    this.loading = false
                    this.getInfo(this.page,this.query)
                    $('#create-update-item-excel').modal('hide')
                }).catch(err => {
                    this.loading = false
                    console.log(err)
                })
            },
            resetTemp(){
              this.temp = {
                  name: '',
                  address: '',
                  phone_number: '',
                  department_id: '',
                  birthday: '',
                  email: ''
              }
            },
            getDepartments(){
                axios.get('/api/departments',{
                    params: {
                        page: 1,
                        limit: 1000000
                    }
                }).then(response => {
                    this.departments = response.data.data
                })
            },
            createItem(){
                this.loading = true
                axios.post('/api/lecturers',this.temp).then(response => {
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
                axios.put('/api/lecturers/'+this.temp.id,this.temp).then(response => {
                    this.loading = false
                    this.getInfo(this.page,this.query)
                    $('#create-update-item').modal('hide')
                }).catch(err => {
                    this.loading = false
                    console.log(err)
                })
            },
            editItem(id){
                this.temp = this.list.find(item => {
                    return item.id == id
                })
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
                axios.delete('/api/lecturers/'+this.temp.id).then(response => {
                    this.loading = false
                    this.getInfo(this.page,this.query)
                    $('#remove-item').modal('hide')
                }).catch(err => {
                    this.loading = false
                    console.log(err)
                })
            },
        }
    }
</script>
