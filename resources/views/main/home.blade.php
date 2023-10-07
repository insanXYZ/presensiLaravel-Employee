@php
use Carbon\Carbon;
@endphp
@extends('templates.index')
@section('body')
    <div class="w-full relative flex flex-col items-center">
        @include("components.topBar" , [ "img" => "image/logo.png" , "name" => "Beranda" , "logout" => true])
        @include("components.bottomBar")
        <div class="my-24 w-2/4 max-w-5xl min-w-fit flex flex-col gap-8">
            <div class="flex items-center w-full  p-3 gap-10">
                <div class="w-16 h-16 bg-biru flex justify-center items-center rounded-full text-white font-semibold">
                    {{getInitials($user->name)}}
                </div>
                <div class="flex flex-col">
                    <div class="text-lg font-semibold">
                        Selamat datang di PT.Tunuh Wae
                    </div>
                    <div class="text-lg">
                        Jl.dukacita Kel.Tamanjaya Kec.redmi Kota Minanghaur Jawa Barat
                    </div>
                </div>
            </div>
            <div class="flex relative items-center w-full h-[160px] overflow-hidden bg-biru py-3 px-10 gap-3 rounded-md text-white">
                <div class="flex flex-col gap-2">
                    <div class="text-lg">{{$user->position}} </div>
                    <div class="text-3xl font-bold">{{$user->nk}} </div>
                    <div class="text-lg font-semibold">{{$user->name}}</div>
                </div>
                <img src="{{asset("image/logo.png")}}" class="w-50 opacity-50 h-w-50 absolute right-0">
            </div>
            @if (session()->has("success"))
                <div id="alert" class="w-full bg-biru py-3 px-10 gap-3 rounded-md text-white text-lg font-semibold">
                    {{session("success")}}
                </div>
            @endif
            <div class="flex justify-between items-center w-full bg-biru py-3 px-10 gap-3 rounded-md text-white">
                <div class="text-center">
                    <div class="text-lg font-semibold">Datang</div>
                    <div class="text-2xl font-bold">{{ optional($user->absent->where("date", Carbon::now()->toDateString())->first())->in_time ?? "-" }}</div>                </div>
                <span class="w-[1px] h-[50px] bg-white"></span>
                <div class="text-center">
                    <div class="text-lg font-semibold">Pulang</div>
                    <div class="text-2xl font-bold">{{ optional($user->absent->where("date", Carbon::now()->toDateString())->first())->out_time ?? "-" }}</div>                </div>
            </div>
            <div class="flex items-center justify-between ">
                <div class="font-semibold text-2xl">Presensi 3 hari terakhir</div>
                <a href="#" class="text-lg">Lihat semua...</a>
            </div>
            @forelse ($user->absent->skip(1)->take(3) as $history )
            <div class="flex items-center justify-between py-3 px-10 bg-gray-100 h-[145px] rounded-md">
                    <div class="flex flex-col gap-2 text-lg ">
                        <div>
                            <div class="font-semibold">datang</div>
                            <div>{{$history->in_time}} WIB</div>
                        </div>
                        <div>
                            <div class="font-semibold">pulang</div>
                            <div>{{$history->out_time}} WIB</div>
                        </div>
                    </div>
                    <div class="h-full flex flex-col justify-evenly items-center">
                        <div class="text-xl font-semibold">{{$history->date}} </div>
                        <img src="{{asset("image/check.png")}}" class="w-10">
                    </div>
                </div>
                @empty
                <div class="text-center">
                    Tidak ada presensi dalam 3 hari terakhir
                </div>
                @endforelse
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset("js/pageHome.js")}}"></script>
@endsection
