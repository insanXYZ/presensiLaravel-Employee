@extends('templates.auth')
@section('card')
    <div class="w-[390px] flex flex-col items-center gap-8">
        <img src="{{asset("image/logo.png")}}" alt="logo" class="w-20">
        <form action="/login" class="w-[390px] rounded-md p-4 bg-white flex flex-col gap-6" method="POST">
            @csrf
            <label for="email" class="font-semibold">Email</label>
            <input class="border p-2" type="text" name="email" id="email" placeholder="johndoe@gmail.com" required>
            <label for="password" class="font-semibold">Password</label>
            <input class="border p-2" type="password" name="password" id="password">
            <hr>
            <button class="bg-[#ee5684] py-2 text-white rounded-sm
            ">Login</button>
        </form>
    </div>
@endsection
