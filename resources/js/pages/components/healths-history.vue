<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6" style="max-height: 500px;overflow-y: scroll">
                <h4>Lịch sử khám bệnh</h4>
                <ul class="timeline">
                    <template v-for="item in list">
                        <li>
                            <a :href="null"><b>{{item.result}}</b></a>
                            <a :href="null" class="float-right">{{item.created_at | filtersGetDate}}</a>
                            <p><b>Triệu chứng</b>: {{item.symptom}}</p>
                            <p><b>Chuẩn đoán</b>: {{item.diagnose}}</p>
                            <p><b>Kết quả</b>: {{item.result}}</p>
                            <p><b>Lưu ý</b>: {{item.note}}</p>
                            <p><b>Đơn thuốc</b>:</p>
                            <div v-for="drug_health in item.drugs_health">
                                <p>Tên thuốc: {{drug_health.drug.name}}</p>
                                <p>Liều  dùng: {{drug_health.uses}}</p>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
            <div class="col-md-6">
                <canvas id="pie-chart" width="800" height="450"></canvas>
            </div>
        </div>
    </div>
</template>
<script>
    import moment from 'moment'
    export default {
        mounted(){
            this.getHealHistory()
        },
        data(){
          return {
              list: []
          }
        },
        methods: {
            getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            },
            getHealHistory(){
                axios.post('/api/1/healing-history').then(response => {
                    this.list = response.data

                    let thang = []

                    for(let i = 1;i <= 12 ; i++){
                        thang.push('Tháng ' +i)
                    }
                    let mau = []
                    for(let i = 1;i <= 12 ; i++){
                        mau.push(this.getRandomColor())
                    }
                    let dataChart = []

                    for(let i = 1;i <= 12 ; i++){
                        let count = this.list.filter(item => {
                            return moment(item.created_at).format('M') == i
                        })
                        dataChart.push(count.length || 0)
                    }
                    new Chart(document.getElementById("pie-chart"), {
                        type: 'pie',
                        data: {
                            labels: thang,
                            datasets: [{
                                label: "Population (millions)",
                                backgroundColor: mau,
                                data: dataChart
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'Số lần đi khám trong năm'
                            }
                        }
                    });

                }).catch(err => {
                    console.log(err)
                })
            }
        },
        filters:{
            filtersGetDate(date){
                return moment(date).format('DD/MM/YYYY HH:mm') || ''
            }
        }
    }
</script>
