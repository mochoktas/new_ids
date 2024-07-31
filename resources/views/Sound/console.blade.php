@extends('Layouts/main')
@section('title_page','sse')
@section('title','console')
@section('css_custom')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card ">
    <div class="card-header">
        <h3>Antrian Loket</h3>
    </div>
    <div class="row">
        <!-- <div class="col-2">
                <h5>select voice:</h5>
            </div>
            <div class="col-4">
                <select name="" id="voiceList"></select>
                <br><br>
                <input type="text" id="txtInput">
                <br><br>
                <button id="btnSpeak">speak</button>
            </div> -->

        <form class="form1">
            <div class="row">
                <div class="col-2">

                </div>
                <div class="col-6">
                    <input type="number" class="txt2" value="{{$antri->nomor_antrian}}">



                    <!-- <div>
      <label for="rate">Rate</label><input type="range" min="0.5" max="2" value="1" step="0.1" id="rate">
      <div class="rate-value">1</div>
      <div class="clearfix"></div>
    </div>
    <div>
      <label for="pitch">Pitch</label><input type="range" min="0" max="2" value="1" step="0.1" id="pitch">
      <div class="pitch-value">1</div>
      <div class="clearfix"></div>
    </div> -->
                    <br><br>
                    <select>

                    </select>
                    <br><br>
                    <div class="controls">
                        <button id="play" type="submit" class="btn btn-primary me-1 mb-1">Play sound</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-2"></div>
        <div class="col-2">
            <form class="form2">
                <button type="submit" class="btn btn-primary me-1 mb-1 ">+1 antrian</button>
            </form>
        </div>
        <div class="col-2">
            <form class="form3">
                <button type="submit" class="btn btn-primary me-1 mb-1">reset</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js_custom')
<script>
    // var voiceList = document.querySelector('#voiceList');
    // var txtInput = document.querySelector('#txtInput');
    // var btnSpeak = document.querySelector('#btnSpeak');

    // var tts = window.speechSynthesis;
    // var voices = [];

    // GetVoices();
    // if(speechSynthesis !== undefined){
    //     speechSynthesis.onvoiceschanged = GetVoices;

    // }

    // btnSpeak.addEventListener('click',()=>{
    //     var toSpeak = new SpeechSynthesisUtterance(txtInput.value);
    //     var selectedVoiceName = voiceList.selectedOptions[0].getAttribute('data-name');
    //     voices.forEach((voice)=>{
    //         if(voice.name === selectedVoiceName){
    //             toSpeak.voice = voice;
    //         }
    //     });
    //     tts.speak(toSpeak);
    // });

    // function GetVoices(){
    //     voices = tts.GetVoices();
    //     voiceList.innerHTML = '';
    //     voices.forEach((voice)=>{
    //         var listItem = document.createElement('option');
    //         listItem.textContent = voice.name;
    //         listItem.setAttribute('data-lang', voice.lang);
    //         listItem.setAttribute('data-name', voice.name);
    //         voiceList.appendChild(listItem);
    //     });

    //     voiceList.selectedIndex = 0;
    // }
    var synth = window.speechSynthesis;

    var inputForm = document.querySelector('.form1');
    var inputForm2 = document.querySelector('.form2');
    var inputForm3 = document.querySelector('.form3');
    var inputTxt = document.querySelector('.txt');

    // var inputTxt = inputTxt2.value;
    var voiceSelect = document.querySelector('select');

    var pitch = document.querySelector('#pitch');
    var pitchValue = document.querySelector('.pitch-value');
    var rate = document.querySelector('#rate');
    var rateValue = document.querySelector('.rate-value');

    var voices = [];

    function populateVoiceList() {
        voices = synth.getVoices().sort(function(a, b) {
            const aname = a.name.toUpperCase(),
                bname = b.name.toUpperCase();
            if (aname < bname) return -1;
            else if (aname == bname) return 0;
            else return +1;
        });
        var selectedIndex = voiceSelect.selectedIndex < 0 ? 0 : voiceSelect.selectedIndex;
        voiceSelect.innerHTML = '';
        for (i = 0; i < voices.length; i++) {
            var option = document.createElement('option');
            option.textContent = voices[i].name + ' (' + voices[i].lang + ')';

            if (voices[i].default) {
                option.textContent += ' -- DEFAULT';
            }

            option.setAttribute('data-lang', voices[i].lang);
            option.setAttribute('data-name', voices[i].name);
            voiceSelect.appendChild(option);
        }
        voiceSelect.selectedIndex = selectedIndex;
    }

    populateVoiceList();
    if (speechSynthesis.onvoiceschanged !== undefined) {
        speechSynthesis.onvoiceschanged = populateVoiceList;
    }

    function speak() {
        // var inputTxt = document.querySelector('.txt');
        var ele = document.getElementsByName('gender');
        var loket = 3;
        // for(i = 0; i < ele.length; i++) {
        //               if(ele[i].checked)
        //               loket = ele[i].value;
        // }
        if (synth.speaking) {
            console.error('speechSynthesis.speaking');
            return;
        }
        if (inputTxt.value !== '') {

            var utterThis = new SpeechSynthesisUtterance("nomor antrian " + inputTxt.value + ",silahkan ke loket " + loket);
            utterThis.onend = function(event) {
                console.log('SpeechSynthesisUtterance.onend');
            }
            utterThis.onerror = function(event) {
                console.error('SpeechSynthesisUtterance.onerror');
            }
            var selectedOption = voiceSelect.selectedOptions[0].getAttribute('data-name');
            for (i = 0; i < voices.length; i++) {
                if (voices[i].name === selectedOption) {
                    utterThis.voice = voices[i];
                    break;
                }
            }
            utterThis.pitch = "1";
            utterThis.rate = "1";
            synth.speak(utterThis);

        }


    }

    function update_antrian() {
        // var ant = $antrian;
        $.ajax({
            url: "{{ url('/console/update-antrian') }}",
            type: "POST",
            data: {
                // an:ant,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(result) {
                console.log("result")
                $(".txt2").val(result.nomor_antrian)
            }

        });
    }

    function reset_antrian() {
        // var ant = $antrian;
        $.ajax({
            url: "{{ url('/console/reset-antrian') }}",
            type: "POST",
            data: {
                // an:ant,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(result) {
                console.log("result")
                $(".txt2").val(result.nomor_antrian)

            }

        });
    }
    inputForm.onsubmit = function(event) {
        // update_antrian();
        event.preventDefault();

        speak();

        inputTxt.blur();
    }
    inputForm2.onsubmit = function(event) {

        event.preventDefault();
        update_antrian();
    }
    inputForm3.onsubmit = function(event) {

        event.preventDefault();
        reset_antrian();
    }

    pitch.onchange = function() {
        pitchValue.textContent = pitch.value;
    }

    rate.onchange = function() {
        rateValue.textContent = rate.value;
    }

    voiceSelect.onchange = function() {
        speak();
    }
</script>

@endsection