<template>
    <div class="container-fluid">
        <h4 class="c-grey-900 mT-10 mB-30">Quản lý sự cố</h4>
        <div style="display: inline-block;">
            <button type="button" class="btn btn-info mB-20" data-toggle="modal" data-target="#create-update-item" @click="action = 'create';resetTemp()">Thêm mới</button>
        </div>
        <div class="row">
            <div class="col-12">
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
                            <th scope="col">Tên sự cố</th>
                            <th scope="col">Nội dung sự cố</th>
                            <th scope="col">Người tạo</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-for="item in list">
                            <tr>
                                <th scope="row">{{item.id}}</th>
                                <td>{{item.name}}</td>
                                <td>{{item.content}}</td>
                                <td>{{item.user.name}}</td>
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
                                <li :class="'page-item' + (page == i ? ' active': '') "><a class="page-link" @click="getInfo(i,query)" href="#">{{i}}</a></li>
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
                                    <label>Tên sự cố</label>
                                    <input type="text" v-model="temp.name" required class="form-control" aria-describedby="emailHelp" placeholder="Tên sự cố">
                                </div>
                                <div class="form-group">
                                    <label>Nội dung sự cố</label>
                                    <textarea class="form-control" v-model="temp.content"  rows="5">

                                    </textarea>
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
        props: {
            user_id: {
                required: true,
            }
        },
        data() {
            return {
                list: [

                ],
                temp: {
                    lecturer_id: '',
                    symptom: '',
                    diagnose: '',
                    result: '',
                    note: '',
                    drugs: [],
                    periodic_id: null
                },
                loading: false,
                page: 1,
                query: null,
                action: 'create',
                last_page: 1,
                drugs: [
                    {
                        drug_id: "",
                        quantum: "",
                        uses: ""
                    }
                ]
            }
        },
        mounted(){
            this.getInfo()
        },
        methods: {
            checkSelected(id) {
                return !this.temp.drugs_health.some(tempDrug => {
                    return tempDrug.drug_id == id
                })
            },
            getInfo(page = 1,query = null){
                axios.get('/api/troubles',{
                    params: {
                        page: page,
                        query: query
                    }
                }).then(response => {
                    this.list = response.data.data
                })
            },
            resetTemp(){
              this.temp = {
                  id: null,
                  name:'',
                  content: ''
              }
            },
            pushItem(){
              this.temp.drugs_health.push({
                  drug_id: "",
                  quantum: "",
                  uses: ""
              })
            },
            createItem(){
                this.loading = true
                this.temp.user_id = this.user_id
                axios.post('/api/troubles',this.temp).then(response => {
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
                this.temp.user_id = this.user_id
                axios.put('/api/troubles/'+this.temp.id,this.temp).then(response => {
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
                axios.delete('/api/troubles/'+this.temp.id).then(response => {
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
