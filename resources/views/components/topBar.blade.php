<div class="fixed top-0 left-0 flex justify-center items-center w-full bg-biru shadow-lg z-50">
    <div class="flex justify-between items-center w-2/4 py-3">
        <img src="{{asset( $img )}}" @isset($attribute)
            {{$attribute}}
        @endisset class="w-10 @isset($class)
            {{$class}}
        @endisset" >
        <div class="font-semibold text-white text-2xl">{{$name}} </div>
        <span></span>
    </div>
</div>

