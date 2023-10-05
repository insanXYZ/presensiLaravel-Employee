@extends('templates.auth')
@section('card')
    <div class="w-[390px] rounded-md p-4 bg-white flex flex-col gap-6">
        <div class="text-2xl">Login</div>
        <form action="/signup" class="w-full flex flex-col gap-4" method="POST">
            @csrf
            <label for="username">Username</label>
            <input class="border p-2" type="text" name="name" id="username" required>
            <label for="position">Position</label>
            <input class="border p-2" type="text" name="position" id="position" required>
            <label for="email">Email</label>
            <input class="border p-2" type="text" name="email" id="email" required>
            <label for="password">Password</label>
            <input class="border p-2" type="password" name="password" id="password">
            <button class="bg-biru py-2 text-white rounded-sm
            ">SignUp</button>
        </form>
    </div>
@endsection
