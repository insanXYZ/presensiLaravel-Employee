@extends('templates.index')
@section('body')
    <div class="w-full relative flex flex-col items-center">
        @include("components.topBar" , [ "img" => "image/back.png" , "attribute" => "id=back" , "class" => "cursor-pointer" , "name" => "Profil" ])
        <div class="my-24 w-2/4 max-w-5xl min-w-fit gap-8 flex flex-col items-center">
            <div class="w-36 h-36 rounded-full shadow-2xl flex justify-center items-center">
                {{getInitials(Auth::user()->name)}}
            </div>
            <div class="flex flex-col items-center">
                <div class="text-2xl font-semibold">{{Auth::user()->name}} </div>
                <div>{{Auth::user()->position}} </div>
            </div>

        </div>
    </div>
@endsection
@section("script")
<script src="{{asset("js/pageProfil.js")}}"></script>
@endsection
