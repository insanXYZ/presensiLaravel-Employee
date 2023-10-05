@extends('templates.index')
@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
@endsection
@section('onload')
    onload="openCam()"
@endsection
@section('body')
<div class="w-full relative flex flex-col items-center">
    @include("components.topBar" , [ "img" => "image/back.png" , "attribute" => "id=back" , "class" => "cursor-pointer" , "name" => "Absen" ])
    <div class="my-24 w-2/4 max-w-5xl min-w-fit gap-8 flex flex-col items-center">
        <form action="/absent" method="POST" class="w-full flex flex-col items-center gap-8">
            @csrf
            <div id="cameraZone" class="w-full flex flex-col items-center gap-8">
                <div id="camera" class="w-1/2"></div>
                <input type="button" class="w-1/2 py-2 rounded-md text-white bg-biru cursor-pointer" value="Take picture" onclick="take_snapshot()">
                <input type="hidden" name="image" id="image_tag">
                <input type="hidden" name="location" id="location_input">
            </div>
            <div id="resultZone" class="w-full hidden flex flex-col items-center gap-8">
                <div id="results"></div>
                <div class="flex w-1/2 justify-between items-center gap-2">
                    <button type="submit" class="w-full bg-berem p-2 rounded-md text-white cursor-pointer">Kirim</button>
                    <img src="{{asset("image/restart.png")}}" id="restart" class="w-10 bg-biru p-2 rounded-md cursor-pointer">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset("js/jquery.min.js")}}"></script>
 <script src="{{asset("js/pageAbsent.js")}}"></script>
@endsection
