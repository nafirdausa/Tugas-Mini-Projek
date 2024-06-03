@extends('layouts.master')

@section('content')
<div class="col-6">
    <form action="{{ route('editProfileRequest',['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mt-3">
            <div class="col-3 d-flex flex-column align-items-center">
                <label for="input-image-3" class="custom-file-label">
                    <img src="{{ $user->profile_image ?? asset('images/default_profile.png') }}" class="rounded-circle me-2 mt-2" width="125" height="125" alt="Profile Image" id="image-preview">
                </label>
                <input id="input-image-3" name="profile_image" type="file" class="custom-file-input" onchange="previewImage(event)" style="display: none;">
                <h5 class="mt-2">Edit Profile</h5>
                @error('profile_image')
                <div id="imageError" class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mt-5">
            <div class="row mb-3">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" id="username" value="{{ $user->username }}">
                    @error('username')
                    <div id="usernameError" class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
                    @error('name')
                    <div id="nameError" class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="bio" class="col-sm-2 col-form-label">Bio</label>
                <div class="col-sm-10">
                    <textarea name="bio" class="form-control" id="bio" cols="50" rows="6">{{ $user->bio }}</textarea>
                    @error('bio')
                    <div id="bioError" class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success">Edit</button>
        </div>
    </form>
</div>
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
    
        const reader = new FileReader();
        reader.onload = function() {
            preview.src = reader.result;
        };
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection