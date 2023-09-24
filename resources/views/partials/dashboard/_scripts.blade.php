<!-- Backend Bundle JavaScript -->
<script src="{{ asset('js/libs.min.js')}}"></script>
@if(in_array('data-table',$assets ?? []))
<script src="{{ asset('vendor/datatables/buttons.server-side.js')}}"></script>
@endif
@if(in_array('chart',$assets ?? []))
<!-- apexchart JavaScript -->
<script src="{{asset('js/charts/apexcharts.js') }}"></script>
<!-- widgetchart JavaScript -->
<script src="{{asset('js/charts/widgetcharts.js') }}"></script>
<script src="{{asset('js/charts/dashboard.js') }}"></script>
@endif

<!-- mapchart JavaScript -->
<script src="{{asset('vendor/Leaflet/leaflet.js') }} "></script>
<script src="{{asset('js/charts/vectore-chart.js') }}"></script>


<!-- fslightbox JavaScript -->
<script src="{{asset('js/plugins/fslightbox.js')}}"></script>
<script src="{{asset('js/plugins/slider-tabs.js') }}"></script>
<script src="{{asset('js/plugins/form-wizard.js')}}"></script>

<!-- settings JavaScript -->
<script src="{{asset('js/plugins/setting.js')}}"></script>

<script src="{{asset('js/plugins/circle-progress.js') }}"></script>
@if(in_array('animation',$assets ?? []))
<!--aos javascript-->
<script src="{{asset('vendor/aos/dist/aos.js')}}"></script>
@endif

@if(in_array('calender',$assets ?? []))
<!-- Fullcalender Javascript -->
<script src="{{asset('vendor/fullcalendar/core/main.js')}}"></script>
<script src="{{asset('vendor/fullcalendar/daygrid/main.js')}}"></script>
<script src="{{asset('vendor/fullcalendar/timegrid/main.js')}}"></script>
<script src="{{asset('vendor/fullcalendar/list/main.js')}}"></script>
<script src="{{asset('vendor/fullcalendar/interaction/main.js')}}"></script>
<script src="{{asset('vendor/moment.min.js')}}"></script>
<script src="{{asset('js/plugins/calender.js')}}"></script>
@endif

<script src="{{asset('vendor/vanillajs-datepicker/dist/js/datepicker-full.js')}}"></script>

@stack('scripts')

<script src="{{asset('js/plugins/prism.mini.js')}}"></script>

<!-- Custom JavaScript -->
<script src="{{asset('js/hope-ui.js') }}"></script>
<script src="{{asset('js/modelview.js')}}"></script>

<script>
    $(document).ready(function() {


        $(window).on("load", () => {
            filterChartPemilih(7);
        });

        setInterval(() => {
            filterChartPemilih(localStorage.getItem("interval"));
        }, 600000);
    });

    function getLastSevenDays() {
        let result = [];
        for (let i = 6; i >= 0; i--) {
            let d = new Date();
            d.setDate(d.getDate() - i);
            result.push(d.toISOString().split("T")[0]);
        }
        return result;
    }

    function filterChartPemilih(periode) {
        function updateDisplay(periode) {
            if (periode == 7) {
                $(".tujuh_hari").hide();
                $(".tigapuluh_hari").show();
                $(".sembilanpuluh_hari").show();
            } else if (periode == 30) {
                $(".tujuh_hari").show();
                $(".tigapuluh_hari").hide();
                $(".sembilanpuluh_hari").show();
            } else if (periode == 90) {
                $(".tujuh_hari").show();
                $(".tigapuluh_hari").show();
                $(".sembilanpuluh_hari").hide();
            }
            $(".jumlah_hari").text(periode);
        }

    }


    function formatDateToIndonesian(dateString) {
        const options = {
            weekday: 'long'
            , year: 'numeric'
            , month: 'long'
            , day: 'numeric'
        };
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', options); // 'id-ID' untuk Bahasa Indonesia
    }


    function filterChartPemilih(periode) {

        function updateDisplay(periode) {
            if (periode == 7) {
                $(".tujuh_hari").hide();
                $(".tigapuluh_hari").show();
                $(".sembilanpuluh_hari").show();
            } else if (periode == 30) {
                $(".tujuh_hari").show();
                $(".tigapuluh_hari").hide();
                $(".sembilanpuluh_hari").show();
            } else if (periode == 90) {
                $(".tujuh_hari").show();
                $(".tigapuluh_hari").show();
                $(".sembilanpuluh_hari").hide();
            }
            $(".jumlah_hari").text(periode + " hari"); // Update the text with the selected period
        }


        $.ajax({
            url: `/data-chart/${periode}`
            , method: "GET"
            , success: (response) => {
                let aggregatedDataKecamatan = {};
                response.forEach(pemilih => {
                    let kel = pemilih.koordinator && pemilih.koordinator.kelurahan ? pemilih.koordinator.kelurahan : null;
                    let kec = pemilih.koordinator && pemilih.koordinator.kecamatan ? pemilih.koordinator.kecamatan : null;


                    if (kel && kec) {
                        if (!aggregatedDataKecamatan[kec]) {
                            aggregatedDataKecamatan[kec] = {
                                total: Array(periode).fill(0)
                                , kelurahanDetail: {}
                            };
                        }
                        if (!aggregatedDataKecamatan[kec].kelurahanDetail[kel]) {
                            aggregatedDataKecamatan[kec].kelurahanDetail[kel] = Array(periode).fill(0);
                        }
                        let date = pemilih.created_at.split("T")[0];
                        let index = getLastSevenDays().indexOf(date);
                        if (index !== -1) {
                            aggregatedDataKecamatan[kec].total[index]++;
                            aggregatedDataKecamatan[kec].kelurahanDetail[kel][index]++;
                        }
                    }
                });

                const datasets = Object.keys(aggregatedDataKecamatan).map(kec => ({
                    label: kec
                    , data: aggregatedDataKecamatan[kec].total
                }));

                const ctx = document.getElementById("myChart").getContext("2d");

                if (window.myChart && typeof window.myChart.destroy === 'function') {
                    window.myChart.destroy();
                }

                window.myChart = new Chart(ctx, {
                    type: "line"
                    , data: {
                        labels: getLastSevenDays()
                        , datasets: datasets.map((dataset, index) => {
                            const baseStyles = [{
                                    backgroundColor: "rgba(78, 115, 223, 0.05)"
                                    , borderColor: "blue"
                                    , pointBackgroundColor: "rgba(78, 115, 223, 1)"
                                    , pointBorderColor: "rgba(78, 115, 223, 1)"
                                    , pointHoverBackgroundColor: "rgba(78, 115, 223, 1)"
                                    , pointHoverBorderColor: "rgba(78, 115, 223, 1)"
                                }
                                , {
                                    backgroundColor: "rgba(223, 78, 78, 0.05)"
                                    , borderColor: "red"
                                    , pointBackgroundColor: "rgb(223, 78, 78)"
                                    , pointBorderColor: "rgb(223, 97, 78)"
                                    , pointHoverBackgroundColor: "rgb(223, 78, 78)"
                                    , pointHoverBorderColor: "rgb(223, 78, 78)"
                                }
                            ];
                            return {
                                ...baseStyles[index % baseStyles.length]
                                , ...dataset
                                , lineTension: 0.3
                                , pointRadius: 3
                                , pointHoverRadius: 3
                                , pointHitRadius: 10
                                , pointBorderWidth: 2
                                , fill: false
                            };
                        })
                    }
                    , options: {
                        tooltips: {
                            backgroundColor: "#FAFAFA"
                            , bodyFontColor: "black"
                            , displayColors: false
                        }
                        , maintainAspectRatio: false
                        , layout: {
                            padding: {
                                left: 0
                                , right: 0
                                , top: 0
                                , bottom: 0
                            }
                        }
                        , scales: {
                            xAxes: [{
                                time: {
                                    unit: "date"
                                }
                                , gridLines: {
                                    display: false
                                    , drawBorder: false
                                }
                                , ticks: {
                                    display: false
                                }
                            }]
                            , yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                    , stepSize: 5
                                    , callback: value => Math.round(value)
                                }
                                , gridLines: {
                                    color: "rgb(234, 236, 244)"
                                    , zeroLineColor: "rgb(234, 236, 244)"
                                    , drawBorder: false
                                    , borderDash: [2]
                                    , zeroLineBorderDash: [2]
                                }
                            }]
                        }
                        , legend: {
                            labels: {
                                boxWidth: 12
                                , fontColor: "black"
                            }
                            , display: true
                            , position: "bottom"
                        }
                        , plugins: {
                            tooltip: {
                                callbacks: {
                                    title: (tooltipItems) => {
                                        const date = tooltipItems[0].label; // Anda mendapatkan tanggal dari label
                                        return formatDateToIndonesian(date);
                                    }
                                    , label: (context) => {
                                        const kecamatan = context.dataset.label;
                                        const dateIndex = context.dataIndex;
                                        const kelurahanDetails = aggregatedDataKecamatan[kecamatan].kelurahanDetail;
                                        const tooltipStr = [];
                                        for (let kel in kelurahanDetails) {
                                            tooltipStr.push(`${kel}: ${kelurahanDetails[kel][dateIndex]} data`);
                                        }
                                        return tooltipStr;
                                    }
                                }
                            }

                        }
                    }
                });

            }
        });
    }

</script>
