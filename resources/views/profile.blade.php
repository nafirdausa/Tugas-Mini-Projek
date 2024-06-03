@extends('layouts.master')

@section('navbar')
<div class="row mt-5">
    @auth
        <div class="col-3 d-flex justify-content-end">
            <img src="{{ $user->profil_image ?? asset('images/default_profile.png') }}" class="rounded-circle me-2" width="125" height="125" alt="" srcset="">
        </div>
        <div class="col-7">
            <h6>{{ $user->username }}</h6>
            <span>{{ $user->posts->count() }} {{ Str::plural('post', $user->posts->count()) }}</span>
            <span>{{ $user->followers->count() }} Followers</span>
            <span>{{ $user->following->count() }} Following</span>
            <p>{{ $user->name }}</p>
            <p>{{ $user->bio }}</p>
        </div>
        <div class="col">
            <button type="button" class="btn bg-transparent p-0" id="edit-profile-link" data-bs-toggle="modal" data-bs-target="#passwordModal">
                <svg class="bi me-2" fill="#4B9494" width="16" height="16"><use xlink:href="#setting"></use></svg>
            </button>
        </div>
    @endauth
</div>

@endsection

@section('content')
<div class="row mt-4" tabindex="-1">
    @auth
    @forelse ($posts as $post)
        <div class="col-3 card border-light bg-transparent p-2 ms-2">
            <div class="d-flex justify-content-start">
                <div class="">
                    <img src="{{ $user->profil_image ?? asset('images/default_profile.png') }}" class="rounded-circle me-2" width="40" alt="">
                </div>
                <div class="flex-fill">
                    <h6>{{ $user->username }}</h6>
                    <p style="margin-top: -10px;">{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <div>
                <a href="{{route('detail_posting', ['id' => $post->id])}}">
                    <img src="{{ Storage::url($post->image) }}" alt="gambar postingan" class="rounded-3 mw-100">
                </a>
            </div>
        </div>
    @empty
        <p>No posts to display.</p>
    @endforelse
    @endauth
</div>
@endsection



