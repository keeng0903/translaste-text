@extends('engkids.layout')
@section('content1')
    <div class="section-content">
        <h1 class="section-header"><span class="content-header wow fadeIn " data-wow-delay="0.2s"
                                         data-wow-duration="2s"> Translate</span> history</h1>
        @if(!empty(Session()->get('user')))
            <h3>Hello <b><?php echo Session()->get('name_user') ?></b></h3>
        @else
            <h3>Start camera <b>TRANSLATE</b></h3>
        @endif
    </div>
    <div class="content-camera" style="height: 1000px">
        <div class="content-main">
            @if($histories)
                <div id="scroll-history">
                    @foreach($histories as $history)
                        @if($history->type == TYPE_VIETNAMESE)
                            <div class="form-control">
                                <h4><i>Việt -> Anh</i></h4>
                            </div>
                        @else
                            <div class="form-control">
                                <h4><i>Anh -> Việt</i></h4>
                            </div>
                        @endif
                        <div class="form-control" style="display: table">
                            <p class="text-color" style="font-weight: bold">{{$history->input}}</p>
                            <i class="text-color">{{$history->output}}</i>
                        </div>
                        <br>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

@endsection
