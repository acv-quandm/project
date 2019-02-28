<template>
    <div class="container-fluid">
        <h4 class="c-grey-900 mT-10 mB-30">Quản lý sức khỏe giảng viên</h4>
        <div style="display: inline-block;">
            <button type="button" class="btn btn-info mB-20" data-toggle="modal" data-target="#create-update-item" @click="action = 'create';resetTemp()">Thêm mới</button>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Tìm kiếm</label>
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
                            <th scope="col">Thời gian khám</th>
                            <th scope="col">Người được khám</th>
                            <th scope="col">Chuẩn đoán</th>
                            <th scope="col">Kết quả</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-for="item in list">
                            <tr>
                                <th scope="row">{{item.id}}</th>
                                <td>{{item.created_at}}</td>
                                <td>{{item.lecturer != null ? item.lecturer.name: ''}}</td>
                                <td>{{item.diagnose}}</td>
                                <td>{{item.result}}</td>
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
                        <h5 class="modal-title" id="exampleModalLabel">{{action == 'create' ? 'Thêm một đợt khám' : 'Chỉnh sửa hồ sơ'}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" @submit.prevent="action == 'create' ? createItem(): updateItem()">
                        <div class="modal-body">
                            <div class="mT-30">
                                <div class="form-group">
                                    <label>Triệu chứng</label>
                                    <input type="text" v-model="temp.symptom" required class="form-control" aria-describedby="emailHelp" placeholder="Điền triệu chứng">
                                </div>
                                <div class="form-group">
                                    <label>Chuẩn đoán</label>
                                    <input type="text" v-model="temp.diagnose" class="form-control" placeholder="Chuẩn đoán">
                                </div>
                                <div class="form-group">
                                    <label>Kết quả</label>
                                    <input type="text" class="form-control" v-model="temp.result"  placeholder="Nhập kết quả">
                                </div>
                                <div class="form-group">
                                    <label>Lưu ý</label>
                                    <input type="text" class="form-control" v-model="temp.note"  placeholder="Nhập các lưu ý/ hẹn khám lại">
                                </div>
                               <div class="row" v-for="(heath_drug,index) in temp.drugs_health">
                                   <div class="col-4">
                                       <div class="form-group">
                                           <label>Thuốc chữa bệnh</label>
                                           <select name="" v-model="heath_drug.drug_id" class="form-control" id="">
                                               <template v-for="drug in drugs">
                                                   <option :value="drug.id">{{drug.name}}</option>
                                               </template>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-4">
                                       <div class="form-group">
                                           <label>Cách sử dụng</label>
                                           <input v-model="heath_drug.uses" type="text" class="form-control">
                                       </div>
                                   </div>
                                   <div class="col-3">
                                       <div class="form-group">
                                           <label>Số lượng</label>
                                           <input v-model="heath_drug.quantum" type="number" :max="getMax(heath_drug.drug_id)" class="form-control">
                                       </div>
                                   </div>
                                   <div class="col-1">
                                       <div class="form-group">
                                           <button type="button" class="btn btn-default" @click="unsetDrug(index)"><i class="icon icon-stop"></i></button>
                                       </div>
                                   </div>
                               </div>
                                <div class="form-group" v-if="action == 'create'">
                                    <button class="btn btn-info" type="button" @click="pushItem">Thêm 1 loại thuốc</button>
                                </div>
                                <div class="form-group" v-if="action == 'create'">
                                    <label>Nhập ID người bệnh</label>
                                    <input type="text" required class="form-control" v-model="temp.lecturer_id"  placeholder="Điền ID người bệnh">
                                </div>
                                <div class="form-group" v-if="action == 'create'">
                                    <label>Nhập ID đợt khám bệnh (nếu có)</label>
                                    <input type="text" class="form-control" v-model="temp.periodic_id"  placeholder="Điền ID đợt khám bệnh (nếu có)">
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
            this.getDrugs()
        },
        methods: {
            checkSelected(id) {
                return !this.temp.drugs_health.some(tempDrug => {
                    return tempDrug.drug_id == id
                })
            },
            getInfo(page = 1,query = null){
                axios.get('/api/healths',{
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
                  lecturer_id: '',
                  symptom: '',
                  diagnose: '',
                  result: '',
                  note: '',
                  drugs_health: [
                      {
                          drug_id: "",
                          quantum: "",
                          uses: ""
                      }
                  ],
                  periodic_id: null
              }
            },
            pushItem(){
              this.temp.drugs_health.push({
                  drug_id: "",
                  quantum: "",
                  uses: ""
              })
            },
            getDrugs(){
                axios.get('/api/drugs',{
                    params: {
                        page: 1,
                        limit: 1000000
                    }
                }).then(response => {
                    this.drugs = response.data.data
                })
            },
            createItem(){
                this.loading = true
                axios.post('/api/healths',this.temp).then(response => {
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
                axios.put('/api/healths/'+this.temp.id,this.temp).then(response => {
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
                if(this.temp.drugs_health.length == 0){
                    this.temp.drugs_health = [
                        {
                            drug_id: "",
                            quantum: "",
                            uses: ""
                        }
                    ]
                }
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
                axios.delete('/api/healths/'+this.temp.id).then(response => {
                    this.loading = false
                    this.getInfo(this.page,this.query)
                    $('#remove-item').modal('hide')
                }).catch(err => {
                    this.loading = false
                    console.log(err)
                })
            },
            unsetDrug(index){
                this.temp.drugs_health = this.temp.drugs_health.filter((item,indexItem) => {
                    return index != indexItem
                })
            },
            getMax(id){
                if(id == undefined || id == null){
                    return null
                }
                else{
                    let drug = this.drugs.find(item => {
                        return item.id == id
                    })
                    if(drug == undefined){
                        return null
                    }
                    return drug.amount
                }
            }
        }
    }
</script>
