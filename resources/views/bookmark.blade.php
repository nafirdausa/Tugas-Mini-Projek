@extends('layouts.master')

@section('navbar')
<!-- Header -->
<div class="col-12">
    <div class="mt-5">
        <h5>All Bookmarks</h5>
    </div>
</div>
@endsection

@section('content')
<div class="col" style="width: 100%; height: 100%;">
    <div class="p-3 px-5 d-flex flex-wrap">
        @auth
            @forelse ($posts as $post)
                <div class="card border-light bg-transparent p-2 m-2" style="width: 18rem;">
                    <div class="d-flex justify-content-start">
                        <div class="">
                            <img src="{{ $post->user->profile_image ?? asset('images/default_profile.png') }}" class="rounded-circle me-2" width="40" height="40" alt="">
                        </div>
                        <div class="flex-fill">
                            <h6>{{ $post->user ? $post->user->username : 'Unknown' }}</h6>
                            <p style="margin-top: -10px;">{{ $post->created_at->diffForHumans() }}</p>
                        </div> 
                    </div>
                    <div>
                        <a href="{{ route('detail_posting', $post->id) }}">
                            <img src="{{ Storage::url($post->image) }}" alt="gambar postingan" class="rounded-3 mw-100">
                        </a>
                    </div>
                </div>
            @empty
                <p>No bookmarks yet.</p>
            @endforelse
        @else
            <div class="row d-flex justify-content-start"></div>
        @endauth
    </div>
</div>
@endsection


 