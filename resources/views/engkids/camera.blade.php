@extends('engkids.layout')
@section('content1')
    <div class="section-content">
        <h1 class="section-header"><span class="content-header wow fadeIn " data-wow-delay="0.2s"
                                         data-wow-duration="2s"> Translate</span> your camera</h1>
        @if(!empty(Session()->get('user')))
            <h3>Hello <b><?php echo Session()->get('name_user') ?></b></h3>
        @else
            <h3>Start camera <b>TRANSLATE</b></h3>
        @endif
    </div>
    <div class="content-camera" style="height: 1000px">
        <div class="content-main">
            <div class="content-left">
                <div class="shadow" style="height: 800px;width: 100%">
                    <div class="box" id="webcam-container">
                        <button type="button" onclick="init()" class="button-start" id="button-start">Start</button>
                        <form class="form-seach-detect" id="form-camera">
                            <div class="form-group">
                                <input type="text" class="form-control" name="word" id="label-container"
                                       aria-describedby="helpId" placeholder="" value="" readonly>
                                <button class="button-search" id="button-search" value=""><i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-main form-group" style="padding-top: 20px" id="detail-camera">

        </div>
    </div>

@endsection
