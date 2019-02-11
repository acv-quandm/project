@extends("layout")
@section('main-content')
    <div id='mainContent'>
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-sizer col-md-6"></div>
            <div class="masonry-item  w-100">
                <div class="row gap-20">
                    <!-- #Toatl Visits ==================== -->
                    <div class='col-md-4'>
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1">Tổng số giảng viên</h6>
                            </div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer peer-greed">
                                        <span id="sparklinedash"></span>
                                    </div>
                                    <div class="peer">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">{{\App\Lecturer::count()}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- #Total Page Views ==================== -->
                    <div class='col-md-4'>
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1">Tổng số loại thuốc còn trong kho</h6>
                            </div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer peer-greed">
                                        <span id="sparklinedash2"></span>
                                    </div>
                                    <div class="peer">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">{{\App\Drug::count()}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- #Unique Visitors ==================== -->
                    <div class='col-md-4'>
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1">Tổng số đợt khám bệnh</h6>
                            </div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer peer-greed">
                                        <span id="sparklinedash3"></span>
                                    </div>
                                    <div class="peer">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500">{{\App\Periodic::count()}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="masonry-item col-12">
                <!-- #Site Visits ==================== -->
                <div class="bd bgc-white">
                    <div class="peers fxw-nw@lg+ ai-s">
                        <div class="peer peer-greed w-70p@lg+ w-100@lg- p-20">
                            <div class="layers">
                                <div class="layer w-100 mB-10">
                                    <h6 class="lh-1">Site Visits</h6>
                                </div>
                                <div class="layer w-100">
                                    <div id="world-map-marker"></div>
                                </div>
                            </div>
                        </div>
                        <div class="peer bdL p-20 w-30p@lg+ w-100p@lg-">
                            <div class="layers">
                                <div class="layer w-100">
                                    <!-- Progress Bars -->
                                    <div class="layers">
                                        <div class="layer w-100">
                                            <h5 class="mB-5">100k</h5>
                                            <small class="fw-600 c-grey-700">Visitors From VN</small>
                                            <span class="pull-right c-grey-600 fsz-sm">50%</span>
                                            <div class="progress mT-10">
                                                <div class="progress-bar bgc-deep-purple-500" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span></div>
                                            </div>
                                        </div>
                                        <div class="layer w-100 mT-15">
                                            <h5 class="mB-5">1M</h5>
                                            <small class="fw-600 c-grey-700">Visitors From Europe</small>
                                            <span class="pull-right c-grey-600 fsz-sm">80%</span>
                                            <div class="progress mT-10">
                                                <div class="progress-bar bgc-green-500" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">80% Complete</span></div>
                                            </div>
                                        </div>
                                        <div class="layer w-100 mT-15">
                                            <h5 class="mB-5">450k</h5>
                                            <small class="fw-600 c-grey-700">Visitors From Australia</small>
                                            <span class="pull-right c-grey-600 fsz-sm">40%</span>
                                            <div class="progress mT-10">
                                                <div class="progress-bar bgc-light-blue-500" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:40%;"> <span class="sr-only">40% Complete</span></div>
                                            </div>
                                        </div>
                                        <div class="layer w-100 mT-15">
                                            <h5 class="mB-5">1B</h5>
                                            <small class="fw-600 c-grey-700">Visitors From India</small>
                                            <span class="pull-right c-grey-600 fsz-sm">90%</span>
                                            <div class="progress mT-10">
                                                <div class="progress-bar bgc-blue-grey-500" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:90%;"> <span class="sr-only">90% Complete</span></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pie Charts -->
                                    <div class="peers pT-20 mT-20 bdT fxw-nw@lg+ jc-sb ta-c gap-10">
                                        <div class="peer">
                                            <div class="easy-pie-chart" data-size='80' data-percent="75" data-bar-color='#f44336'>
                                                <span></span>
                                            </div>
                                            <h6 class="fsz-sm">New Users</h6>
                                        </div>
                                        <div class="peer">
                                            <div class="easy-pie-chart" data-size='80' data-percent="50" data-bar-color='#2196f3'>
                                                <span></span>
                                            </div>
                                            <h6 class="fsz-sm">New Purchases</h6>
                                        </div>
                                        <div class="peer">
                                            <div class="easy-pie-chart" data-size='80' data-percent="90" data-bar-color='#ff9800'>
                                                <span></span>
                                            </div>
                                            <h6 class="fsz-sm">Bounce Rate</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="masonry-item col-md-6">
                <!-- #Monthly Stats ==================== -->
                <div class="bd bgc-white">
                    <div class="layers">
                        <div class="layer w-100 pX-20 pT-20">
                            <h6 class="lh-1">Tình trạng khám bệnh</h6>
                        </div>
                        <div class="layer w-100 p-20">
                            <canvas id="line-chart" height="220"></canvas>
                        </div>
                        <div class="layer bdT p-20 w-100">
                            <div class="peers ai-c jc-c gapX-20">
                                <div class="peer">
                                    <span class="fsz-def fw-600 mR-10 c-grey-800">10% <i class="fa fa-level-up c-green-500"></i></span>
                                    <small class="c-grey-500 fw-600">APPL</small>
                                </div>
                                <div class="peer fw-600">
                                    <span class="fsz-def fw-600 mR-10 c-grey-800">2% <i class="fa fa-level-down c-red-500"></i></span>
                                    <small class="c-grey-500 fw-600">Average</small>
                                </div>
                                <div class="peer fw-600">
                                    <span class="fsz-def fw-600 mR-10 c-grey-800">15% <i class="fa fa-level-up c-green-500"></i></span>
                                    <small class="c-grey-500 fw-600">Sales</small>
                                </div>
                                <div class="peer fw-600">
                                    <span class="fsz-def fw-600 mR-10 c-grey-800">8% <i class="fa fa-level-down c-red-500"></i></span>
                                    <small class="c-grey-500 fw-600">Profit</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="masonry-item col-md-6">
                <!-- #Todo ==================== -->
                <div class="bd bgc-white p-20">
                    <div class="layers">
                        <div class="layer w-100 mB-10">
                            <h6 class="lh-1">Các đợt khám bệnh sắp tới</h6>
                        </div>
                        <div class="layer w-100">
                            <ul class="list-task list-group" data-role="tasklist">
                                <?php
                                $periodics = \App\Periodic::orderBy('time_start','desc')->limit(10)->get();
                                ?>
                                @foreach($periodics as $periodic)
                                        <li class="list-group-item bdw-0" data-role="task">
                                            <div class="checkbox checkbox-circle checkbox-info peers ai-c">
                                                <input type="checkbox" id="inputCall2" name="inputCheckboxesCall" class="peer">
                                                <label for="inputCall2" class=" peers peer-greed js-sb ai-c">
                                                    <span class="peer peer-greed">{{$periodic->name}}</span>
                                                    <span class="peer">
                                <span class="badge badge-pill fl-r badge-success lh-0 p-10">{{$periodic->time_start}}</span>
                              </span>
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="masonry-item col-md-12">
                <!-- #Weather ==================== -->
                <div class="bd bgc-white p-20">
                    <div class="layers">
                        <!-- Widget Title -->
                        <div class="layer w-100 mB-20">
                            <h6 class="lh-1">Thời tiết</h6>
                        </div>

                        <!-- Today Weather -->
                        <div class="layer w-100">
                            <div class="peers ai-c jc-sb fxw-nw">
                                <div class="peer peer-greed">
                                    <div class="layers">
                                        <!-- Temprature -->
                                        <div class="layer w-100">
                                            <div class="peers fxw-nw ai-c">
                                                <div class="peer mR-20">
                                                    <h3>32<sup>°C</sup></h3>
                                                </div>
                                                <div class="peer">
                                                    <canvas class="sleet" width="44" height="44"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Condition -->
                                        <div class="layer w-100">
                                            <span class="fw-600 c-grey-600">Có mây</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="peer">
                                    <div class="layers ai-fe">
                                        <?php $now = \Illuminate\Support\Carbon::now();
                                        $weekMap = [
                                            0 => 'Chủ nhật',
                                            1 => 'Thứ 2',
                                            2 => 'Thứ 3',
                                            3 => 'Thứ 4',
                                            4 => 'Thứ 5',
                                            5 => 'Thứ 6',
                                            6 => 'Thứ 7',
                                        ];
                                        ?>
                                        <div class="layer">
                                            <h5 class="mB-5">{{$weekMap[$now->dayOfWeek]}}</h5>
                                        </div>
                                        <div class="layer">
                                            <span class="fw-600 c-grey-600">{{$now->format('d/m/Y')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Today Weather Extended -->
                        <div class="layer w-100 mY-30">
                            <div class="layers bdB">
                                <div class="layer w-100 bdT pY-5">
                                    <div class="peers ai-c jc-sb fxw-nw">
                                        <div class="peer">
                                            <span>Gió</span>
                                        </div>
                                        <div class="peer ta-r">
                                            <span class="fw-600 c-grey-800">10km/h</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="layer w-100 bdT pY-5">
                                    <div class="peers ai-c jc-sb fxw-nw">
                                        <div class="peer">
                                            <span>Mặt trời mọc</span>
                                        </div>
                                        <div class="peer ta-r">
                                            <span class="fw-600 c-grey-800">05:00 Sáng</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="layer w-100 bdT pY-5">
                                    <div class="peers ai-c jc-sb fxw-nw">
                                        <div class="peer">
                                            <span>Mặt trời lặn</span>
                                        </div>
                                        <div class="peer ta-r">
                                            <span class="fw-600 c-grey-800">07:00 Chiều</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Week Forecast -->
                        <div class="layer w-100">
                            <div class="peers peers-greed ai-fs ta-c">
                                <div class="peer">
                                    <h6 class="mB-10">Thứ 2</h6>
                                    <canvas class="sleet" width="30" height="30"></canvas>
                                    <span class="d-b fw-600">32<sup>°C</sup></span>
                                </div>
                                <div class="peer">
                                    <h6 class="mB-10">Thứ 3</h6>
                                    <canvas class="clear-day" width="30" height="30"></canvas>
                                    <span class="d-b fw-600">30<sup>°C</sup></span>
                                </div>
                                <div class="peer">
                                    <h6 class="mB-10">Thứ 4</h6>
                                    <canvas class="partly-cloudy-day" width="30" height="30"></canvas>
                                    <span class="d-b fw-600">28<sup>°C</sup></span>
                                </div>
                                <div class="peer">
                                    <h6 class="mB-10">Thứ 5</h6>
                                    <canvas class="cloudy" width="30" height="30"></canvas>
                                    <span class="d-b fw-600">32<sup>°C</sup></span>
                                </div>
                                <div class="peer">
                                    <h6 class="mB-10">Thứ 6</h6>
                                    <canvas class="snow" width="30" height="30"></canvas>
                                    <span class="d-b fw-600">24<sup>°C</sup></span>
                                </div>
                                <div class="peer">
                                    <h6 class="mB-10">Thứ 7</h6>
                                    <canvas class="wind" width="30" height="30"></canvas>
                                    <span class="d-b fw-600">28<sup>°C</sup></span>
                                </div>
                                <div class="peer">
                                    <h6 class="mB-10">Chủ nhật</h6>
                                    <canvas class="sleet" width="30" height="30"></canvas>
                                    <span class="d-b fw-600">32<sup>°C</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
