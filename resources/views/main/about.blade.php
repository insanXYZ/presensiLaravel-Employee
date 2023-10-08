@extends('templates.index')
@section('body')
<div class="w-screen h-screen relative flex justify-center items-center">
    @include("components.topBar" , [ "img" => "image/back.png" , "attribute" => "id=back" , "class" => "cursor-pointer" , "name" => "About" ])
    <div class="my-24 w-2/4 max-w-5xl min-w-fit gap-8 flex flex-col items-center">
        <div class="flex w-full gap-2 items-center justify-between bg-biru rounded-md py-3 px-10">
            <div class="flex flex-col gap-5 text-white">
                <div class="text-5xl font-semibold">presensiLaravel</div>
                <div>laravel | tailwind</div>
            </div>
            <a href="https://github.com/insanXYZ/presensiLaravel-Employee" target="_blank">
                <img src="{{ asset("image/git.png") }}" class="w-14">
            </a>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset("js/pageAbout.js") }}"></script>
@endsection

