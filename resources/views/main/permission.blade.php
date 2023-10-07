@extends('templates.index')
@section('body')
    <div class="w-full relative flex flex-col items-center">
        @include("components.topBar" , [ "img" => "image/back.png" , "attribute" => "id=back" , "class" => "cursor-pointer" , "name" => "Izin & sakit" ])
        <form method="POST" enctype="multipart/form-data" action="/permission" class="my-24 w-2/4 max-w-5xl min-w-fit gap-8 flex flex-col">
          @csrf
          <label class="font-semibold" for="img">Bukti gambar</label>
          <input class="border p-2" type="file" name="img" id="img" required accept="image/*">
          <label class="font-semibold" for="status">Status</label>
          <select name="status" id="status" class="border p-2" required>
            <option value="dinas luar">Dinas luar</option>
            <option value="izin">izin</option>
            <option value="sakit">sakit</option>
          </select>
          <label class="font-semibold" for="information">Keterangan</label>
          <textarea name="information" id="information" rows="5" class="border p-2" required></textarea>
          <button class="bg-berem py-2 text-white rounded-sm
          ">kirim</button>
      </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset("js/pagePermission.js") }}"></script>
@endsection