@extends('layouts.app')

@section('content')

    <body>
    @foreach($HomeTemp as $HomeTemps)
    <div class="container">
        <label for="customRange3" class="form-label"><h1>Температура</h1></label>
    </div>
    <div class="border container">
        <div class="row">
            <div class="col">
                Температура 1 этаж
            </div>
            <div class="col">

                <b>{{$HomeTemps->T1}}C</b>

            </div>
            <div class="col">
                Влажность
            </div>
            <div class="col">
                <b>{{$HomeTemps->H1}}%</b>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Температура улица
            </div>
            <div class="col">
                <b>{{$HomeTemps->T2}}C</b>

            </div>
            <div class="col">
                Влажность
            </div>
            <div class="col">
                <b>{{$HomeTemps->H2}}%</b>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Температура прогноз
            </div>
            <div class="col">
                <b>25 C</b>

            </div>
            <div class="col">
                Влажность
            </div>
            <div class="col">
                <b>25%</b>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <b>Углекислый газ ppm</b>
            </div>
            <div class="col">
                <b>{{$HomeTemps->PPM}}</b>
            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>

        </div>
    </div>
    @foreach($referenceTemp as $referenceTemps)

    <div class="container">
        <label for="customRange3" class="form-label"><h1>Состояние отопления</h1></label>
    </div>
    <div class="border container">
        <div class="row">
            <div class="col">
                Подачи города
            </div>
            <div class="col">
                <b>{{$referenceTemps->CityInTemp}}C</b>

            </div>
            <div class="col">
              Обратка города
            </div>
            <div class="col">
                <b>{{$referenceTemps->CityOutTemp}}C</b>
            </div>
            <div class="col">
               Целевая в доме
            </div>
            <div class="col">
                <div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
                    <input type="text" name="quant[2]" class="form-control input-number" value="{{$referenceTemps->FloorInTemp}}" min="1" max="30">
                    <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
                </div>
            </div>


            <div class="col">
               Теплый пола
            </div>
            <div class="col">
                <b>{{$HomeTemps->T_pola_1}}C</b>

            </div>
        </div>

        <div class="row">
            <div class="col">
                <b>Насос</b>
            </div>
            <div class="col bg-success">


            </div>
            <div class="col-9">

            </div>
            <div class="col">

            </div>
        </div>
        @endforeach

        <div class="row">
            <div class="col">
                <b>Сотояние термоголовок</b>
            </div>

        </div>
        <div class="row">
        @foreach($TermHeadStatus as $TermHeadStatuses)

            @if($TermHeadStatuses->Status ==1)
            <div class="col border bg-success text-white text-center">
                @else
                    <div class="col border bg-secondary text-white text-center">
                 @endif
                <center><b>Контур {{$TermHeadStatuses->HeadNomber}}</b>
            </div>

                    @endforeach
            </div>
        <div class="row">
            <div class="col">
                <b>Активность обогрева</b>
            </div>

        </div>

        <div class="row">
            @foreach($DutyCircleStatus as $DutyCircleStatuses)
            <div class="col border bg-secondary text-white text-center">
                <b>{{$DutyCircleStatuses->WorkOnCircle}} минут открыта из 10</b>
            </div>
            @endforeach
        </div>
            <div class="row">
            смена цикла в {{$DutyRoundOff}}                текущее время сервера - {{$time}}
            </div>

    </div>
    <div class="container">
        <label for="customRange3" class="form-label"><h1>Настройка системы</h1></label>
    </div>

        @foreach($durtyCircleUserStatus as $durtyCircleUserStatuses )

            <div class="border container">
            <label for="customRange3" class="form-label"><h3>{{$durtyCircleUserStatuses->room['name']}}</h3></label>

                 <div class="row gy-5">

                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 50%" aria-valuenow=10 aria-valuemin="0" aria-valuemax="10"></div>
                        </div>
                        <input type="range" class="form-range" min="0" max="10" step="1" value="{{$durtyCircleUserStatuses->WorkOnCircle}}" data-namerange="{{$durtyCircleUserStatuses->id}}" id="customRange3">
                    </div>

                </div>

            </div>
        @endforeach




@endforeach




    </div>


@section('custom_js')
    <script>

        $( document ).ready(function() {
          $('.form-range').change(function () {
              var RangeId = $(this).data('namerange')
              var RangeVal = $(this).val()
              $.ajax({
                  url:"{{route('home')}}",
                  method: 'GET',
                  data: {
                      RangeId: RangeId,
                      RangeVal: RangeVal
                  },
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  success: function(data){
                      console.log(data);
                  }
              });



          })


        });


        $('.btn-number').click(function(e){
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type      = $(this).attr('data-type');
            var input = $("input[name='"+fieldName+"']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if(type == 'minus') {

                    if(currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if(type == 'plus') {

                    if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function(){
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {

            minValue =  parseInt($(this).attr('min'));
            maxValue =  parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if(valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


            $.ajax({
                url:"{{route('home')}}",
                method: 'GET',
                data: {
                    changeTargetTemp : valueCurrent
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data){
                    console.log(data);
                }
            })



        });
        $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

    </script>
@endsection



@endsection
