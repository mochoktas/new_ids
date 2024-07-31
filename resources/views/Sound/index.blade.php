@extends('Layouts/main')
@section('title_page','sse')
@section('title','antrian loket')
@section('css_custom')
<style>
    @import url('https://fonts.googleapis.com/css?family=Orbitron');

    #digit_clock_time {
        font-family: 'Work Sans', sans-serif;
        color: #66ff99;
        font-size: 35px;
        text-align: center;
        padding-top: 20px;
    }

    #digit_clock_date {
        font-family: 'Work Sans', sans-serif;
        color: #66ff99;
        font-size: 20px;
        text-align: center;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .digital_clock_wrapper {
        background-color: #333;
        padding: 25px;
        max-width: 500px;
        width: 100%;
        text-align: center;
        border-radius: 5px;
        margin: 0 auto;
    }
</style>
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card">
    <div class="card-header">

    </div>
    <div class="row">


        <div class="col-2">
        </div>
        <div class="col-8">

            <div class="container p-3 my-3 bg-primary">
                <div class="row">


                    <div class="col-6">
                        <h1 class="text-white">Nomor Antrian :</h1>

                        <br><br>
                        <br>
                        <h1 class="text-white">Loket :</h1>

                    </div>
                    <div class="col-4">
                        <!-- <input class="score" type="number" id="antrian" width="20" disabled/> -->
                        <div class="home-score" style="color:yellow; font-size:40px; " id="antrians">99</div>
                        <br><br>

                        <div class="home-score" style="color:yellow; font-size:40px; " id="lokets">99</div>

                    </div>

                </div>
                <br><br>
                <h1 class="text-white">


                    <div class="digital_clock_wrapper">
                        <div id="digit_clock_time"></div>
                        <div id="digit_clock_date"></div>
                </h1>
            </div>

        </div>
    </div>

</div>
@endsection

@section('js_custom')
<script>
    //     if(typeof(EventSource) !== "undefined") {
    //     var source = new EventSource("/sse");
    //     source.onmessage = function(event) {
    //     console.log(event.data);
    //     $val = JSON.parse(event.data);
    //     console.log($val.status);
    //     document.getElementById("no").value= $val.nomor_antrian;
    //     document.getElementById("loket").value= $val.loket;

    //         }


    // } else {
    // document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
    // }
    //---------------------
    window.onload = function() {
        var sse = new EventSource('/stream');
        sse.onmessage = function(e) {
            console.log(e);
            var data_json = JSON.parse(e.data);
            //   console.log(data_json);
            //   console.log(data_json[0].musik);
            document.getElementById("antrians").innerHTML = data_json.nomor_antrian;
            document.getElementById("lokets").innerHTML = data_json.loket;

            // document.getElementById('timer').innerHTML = data_json[0].menit + ":" + data_json[0].detik;





            //   tutup-sse
        }
    }
</script>
<script type="text/javascript">
    function currentTime() {
        var date = new Date(); /* creating object of Date class */
        var hour = date.getHours();
        var min = date.getMinutes();
        var sec = date.getSeconds();
        var midday = "AM";
        midday = (hour >= 12) ? "PM" : "AM"; /* assigning AM/PM */
        hour = (hour == 0) ? 12 : ((hour > 12) ? (hour - 12) : hour); /* assigning hour in 12-hour format */
        hour = changeTime(hour);
        min = changeTime(min);
        sec = changeTime(sec);
        document.getElementById("digit_clock_time").innerText = hour + " : " + min + " : " + sec + " " + midday; /* adding time to the div */

        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        var curWeekDay = days[date.getDay()]; // get day
        var curDay = date.getDate(); // get date
        var curMonth = months[date.getMonth()]; // get month
        var curYear = date.getFullYear(); // get year
        var date = curWeekDay + ", " + curDay + " " + curMonth + " " + curYear; // get full date
        document.getElementById("digit_clock_date").innerHTML = date;

        var t = setTimeout(currentTime, 1000); /* setting timer */
    }

    function changeTime(k) {
        /* appending 0 before time elements if less than 10 */
        if (k < 10) {
            return "0" + k;
        } else {
            return k;
        }
    }

    currentTime();
</script>

@endsection