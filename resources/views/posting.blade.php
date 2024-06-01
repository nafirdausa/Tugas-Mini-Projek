@extends('layouts.master')

@section('navbar')
<!-- Header -->
<div class="col-12">
    <div class="py-3">
        <ul class="nav justify-content-center">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">For You</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Following</a>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('content')
  <div class="d-flex justify-content-center align-items-center">
    @if (Session::get('error'))
        <div class="row">
            <div class="col-md-4 offset-4 mt-2 py-2 rounded bg-danger text-white fw-bold">
                {{ Session::get('error') }}
            </div>
        </div>
    @endif
      <div class="card bg-transparent border p-3" style="width: 25rem;">
          <div class="d-flex justify-content-between">
              <div>
                  <img src="{{ asset('images/default_profile.png') }}" class="rounded-circle me-2" width="50" alt="">
              </div>
              <div>
                  <h5>{{ Auth::user()->username }}</h5>
              </div>
              <div>
                  <svg class="bi me-2" fill="#4B9494" width="20" height="20"><use xlink:href="#three-dots"></use></svg>
              </div>
          </div>
          <form action="{{ route('postRequest') }}" method="POST" enctype="multipart/form-data">
            @csrf()
            <input class="bg-transparent custom-text-input text-light" type="text" name="caption" placeholder="Deskripsi Postingan" id="caption" value="{{old('caption')}}">
            @error('caption')
              <div id="caption" class="text-danger">{{ $message }}</div>
            @enderror
            <div class="card bg-transparent border" style="height: 300px">
                <label for="input-image-3" class="custom-file-input-label">
                    <input id="input-image-3" name="image" type="file" class="custom-file-input" value="{{ old('image') }}" class="custom-file-input" onchange="previewImage(event)">
                    <img id="image-preview" />
                </label>
                @error('image')
                  <div id="imageError" class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <hr>
            <div>
                <button class="btn btn-success" type="submit">Posting</button>
            </div>
          </form>  
      </div>
  </div>

  <script>
    function previewImage(event) {
        const input = event.target;
        const label = input.closest('.custom-file-input-label');
        const preview = label.querySelector('#image-preview');
    
        const reader = new FileReader();
        reader.onload = function() {
            preview.src = reader.result;
            preview.style.display = 'block';
            label.querySelector('::before').style.display = 'none'; // Hide the 'Choose Image' text
        };
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>    
@endsection