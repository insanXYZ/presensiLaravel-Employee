<div class="fixed top-0 left-0 flex justify-center items-center w-full bg-biru shadow-lg z-50">
    <div class="flex justify-between items-center w-2/4 py-3">
        <img src="{{asset( $img )}}" @isset($attribute)
            {{$attribute}}
        @endisset class="w-10 @isset($class)
            {{$class}}
        @endisset" >
        <div class="font-semibold text-white text-2xl">{{$name}} </div>
        @if (isset($logout))
            <form action="/logout" method="POST" class="w-10">
                @csrf
                <button type="submit">
                    <img src="{{ asset("image/logout.png") }}" alt="logout">
                </button>
            </form>
        @else
            <span></span>
        @endif
    </div>
</div>
