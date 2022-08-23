@extends('layouts.main')

@section('content')
{{--    <!-- <div>--}}
{{--        <canvas id="tags_most_posts" class="inline-block my-0 mx-auto w-1/3"></canvas>--}}

{{--        <script>--}}

{{--            Chart.register(ChartDataLabels);--}}

{{--            const data = {--}}
{{--                labels: @json($tags_array),--}}
{{--                datasets: [{--}}
{{--                    data: @json($tags_number),--}}
{{--                    backgroundColor: [--}}
{{--                        'rgb(255, 99, 132)',--}}
{{--                        'rgb(54, 162, 235)',--}}
{{--                        'rgb(225,181,75)',--}}
{{--                        'rgb(115,224,76)',--}}
{{--                        'rgb(162,86,255)',--}}
{{--                        'rgb(154,59,79)',--}}
{{--                        'rgb(33,100,145)',--}}
{{--                        'rgb(148,119,50)',--}}
{{--                        'rgb(76,147,50)',--}}
{{--                        'rgb(94,50,147)'--}}
{{--                    ],--}}
{{--                    datalabels: {--}}
{{--                        // labels:{--}}
{{--                        //     title:{--}}
{{--                        //         font: {--}}
{{--                        //             weight: 'bold',--}}
{{--                        //             size: 25,--}}
{{--                        //         },--}}
{{--                        //     },--}}
{{--                        //     value:{--}}
{{--                        //         font: {--}}
{{--                        //             size: 20,--}}
{{--                        //         },--}}
{{--                        //     }--}}
{{--                        // },--}}
{{--                        font: {--}}
{{--                            weight: 'bold',--}}
{{--                            size: 15,--}}
{{--                        },--}}
{{--                        anchor: 'center',--}}
{{--                        color: 'white',--}}
{{--                        textStrokeColor: 'black',--}}
{{--                        textStrokeWidth: 1,--}}
{{--                        padding: 6,--}}
{{--                        formatter: (val, ctx) => {--}}
{{--                            // Grab the label for this value--}}
{{--                            const label = ctx.chart.data.labels[ctx.dataIndex];--}}

{{--                            // Format the number with 2 decimal places--}}
{{--                            const formattedVal = Intl.NumberFormat('en-US', {--}}
{{--                            }).format(val);--}}

{{--                            // Put them together--}}
{{--                            return `${label}\n${formattedVal}`;--}}
{{--                        }--}}
{{--                    },--}}
{{--                    responsive: true--}}
{{--                }],--}}

{{--            };--}}

{{--            const config = {--}}
{{--                type: 'doughnut',--}}
{{--                data: data,--}}
{{--                options: {--}}
{{--                    plugins: {--}}
{{--                        legend: {--}}
{{--                            display: false,--}}
{{--                        },--}}
{{--                        tooltips: {--}}
{{--                            enabled: false,--}}
{{--                        },--}}
{{--                        title: {--}}
{{--                            text: "Posts created this month",--}}
{{--                            display: true,--}}
{{--                            font: {--}}
{{--                                size: 25--}}
{{--                            }--}}
{{--                        },--}}
{{--                        subtitle: {--}}
{{--                            text: "sorted by tags",--}}
{{--                            display: true,--}}
{{--                            font: {--}}
{{--                                size: 15--}}
{{--                            },--}}
{{--                            padding: {--}}
{{--                                bottom: 10--}}
{{--                            }--}}
{{--                        },--}}
{{--                    }--}}

{{--                }--}}
{{--            };--}}

{{--            var ctx = document.getElementById('tags_most_posts').getContext('2d');--}}


{{--            const tags_most_posts = new Chart(--}}
{{--                ctx,--}}
{{--                config--}}
{{--            );--}}
{{--        </script> -->--}}
    </div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1>Laravel 9 ChartJS Chart Example - ItSolutionStuff.com</h1>
                        <canvas id="myChart" height="100px"></canvas>

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <script type="text/javascript">

                            var labels =  {{ Js::from($labels) }};
                            var users =  {{ Js::from($data) }};

                            const data = {
                                labels: labels,
                                datasets: [{
                                    label: 'หมวดหมู่ทั้งหมด',
                                    backgroundColor: 'rgb(255, 99, 132)',
                                    borderColor: 'rgb(255, 99, 132)',
                                    data: users,
                                }, {
                                    label: 'หมวดหมี่',
                                    backgroundColor: 'rgb(99,112,255)',
                                    borderColor: 'rgb(99,112,255)',
                                    data: users,
                                }
                                ]
                            };

                            const config = {
                                type: 'line',
                                data: data,
                                options: {}
                            };

                            const myChart = new Chart(
                                document.getElementById('myChart'),
                                config
                            );

                        </script>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endsection
