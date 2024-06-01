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
<!-- Main Content Left -->
<div class="col" style="width: 100%; height: 100%;">
    <div class="p-3 px-5">
        @auth
            @forelse ($posts as $post)
                <div class="row d-flex justify-content-start">
                    <div class="col-3 card border-light bg-transparent p-2">
                        <div class="d-flex justify-content-start">
                            <div class="">
                                <img src="{{asset('images/default_profile.png')}}" class="rounded-circle me-2" width="40" alt="" srcset="">
                            </div>
                            <div class="flex-fill">
                                <h6>{{ $post->user ? $post->user->username : 'Unknown' }}</h6>
                                <p style="margin-top: -10px;">{{ $post->created_at->diffForHumans() }}</p>
                            </div> 
                        </div>
                        <div>
                            <a href="{{route('detail_posting')}}">
                                <img src="{{ Storage::url($post->image) }}" alt="gambar postingan" class="rounded-3 mw-100">
                            </a>
                        </div>
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
 