<div>
    <div>
        <div class="card card-statistics mb-30">
            <div class="card-body">
                <h5 class="card-title"> {{$data[$counter]->title}}</h5>

                @foreach(preg_split('/(-)/', $data[$counter]->answers) as $index=>$answer)
                    <div class="custom-control custom-radio" style="margin-bottom: 20px;">
                        <input type="radio" id="customRadio{{$index}}" name="customRadio" class="custom-control-input" >
                        <label class="custom-control-label" style="padding-right: 20px;" for="customRadio{{$index}}" wire:click="nextQuestion({{$data[$counter]->id}}, {{$data[$counter]->score}}, '{{$answer}}', '{{$data[$counter]->right_answer}}')"> {{$answer}}</label>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

</div>

{{--<div class="custom-control custom-radio" style="margin-bottom: 20px;">--}}
{{--    <input type="radio" id="radioButton1" name="radioGroup" class="custom-control-input">--}}
{{--    <label class="custom-control-label" for="radioButton1" style="padding-right: 20px;">{{$answer}}</label>--}}
{{--</div>--}}
