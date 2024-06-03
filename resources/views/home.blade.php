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
<!-- Main Content Left -->
<div class="col-6">
    <div class="py-3">
        @foreach ($posts as $post)
        <div class="row d-flex justify-content-end mt-3">
            <div class="card bg-transparent border" style="width: 25rem;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <img src="{{asset('images/default_profile.png')}}" class="rounded-circle me-2" width="50" alt="" srcset="">
                        </div>
                        <div class="flex-fill">
                            {{-- <h6>{{Auth::user()->username}}</h6> --}}
                            <h6>{{ $post->user ? $post->user->username : 'Unknown' }}</h6>
                            <p>{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="">
                            @auth
                                @if(!$post->bookmarkBy(auth()->user()))
                                    <form action="{{ route('posts.bookmark', $post) }}" method="POST">
                                        @csrf
                                        <button class="btn bg-transparent p-0 text-decoration-none" type="submit">
                                            <svg class="bi me-2" fill="white" width="18" height="18"><use xlink:href="#bookmark-fill"></use></svg>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('posts.bookmark', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn bg-transparent p-0" type="submit">
                                            <svg class="bi me-2" fill="white" width="18" height="18"><use xlink:href="#bookmark"></use></svg>
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{route('login')}}">
                                    <svg class="bi me-2" fill="white" width="18" height="18"><use xlink:href="#bookmark"></use></svg>
                                </a>
                            @endauth
                        </div>
                    </div>
                    <p>{{$post->caption}}</p>
                    <a href="{{route('detail_posting', ['id' => $post->id])}}">
                        <img src="{{ Storage::url($post->image) }}" alt="gambar postingan" class="rounded-3" width="100%">
                    </a>
                    <hr>
                    <div class="d-flex">
                        <div>
                            @auth
                                @if(!$post->likedBy(auth()->user()))
                                    <form action="{{ route('posts.likes', $post) }}" method="POST">
                                        @csrf
                                        <button class="btn bg-transparent p-0 text-decoration-none" type="submit">
                                            <svg class="bi me-2" fill="red" width="18" height="18"><use xlink:href="#like"></use></svg>
                                        </button>
                                        <span class="fs-8">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                                    </form>
                                @else
                                    <form action="{{ route('posts.likes', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn bg-transparent p-0" type="submit">
                                            <svg class="bi me-2" fill="white" width="18" height="18"><use xlink:href="#like"></use></svg>
                                        </button>
                                        <span class="fs-8">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                                    </form>
                                @endif
                            @else
                                <a href="{{route('login')}}">
                                    <svg class="bi me-2" fill="white" width="18" height="18"><use xlink:href="#like"></use></svg>
                                </a>
                                <span class="fs-8">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                            @endauth
                        </div>
                        <div class="px-4">
                            <svg class="bi me-2" fill="white" width="18" height="18"><use xlink:href="#comment"></use></svg>
                            <span class="fs-8">3 Comments</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- RIght Konten --}}
<div class="col-6">
    <div class="py-3 sticky-container">
        <div class="row justify-content-center align-items-center mx-auto" style="width: 60%;">
            <h4>Siapa yang harus diikuti</h4>
            <p>Orang yang mungkin anda kenal</p>

            @auth
            @forelse ($suggestions as $usr)
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img src="{{ asset('images/default_profile.png') }}" class="rounded-circle me-2" width="50" alt="">
                        </div>
                        <div class="flex-fill">
                            <h6>{{ $usr->username }}</h6>
                            <p>{{ $usr->name }}</p>
                        </div>
                        <div>
                            @if(!$usr->followBy(auth()->user()))
                                <form action="{{ route('users.follow', $usr) }}" method="POST" class="follow-unfollow">
                                    @csrf
                                    <button type="submit" class="btn text-light bg-transparent">Follow</button>
                                </form>
                            @else
                                <form action="{{ route('users.unfollow', $usr) }}" method="POST" class="follow-unfollow">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn text-light bg-transparent">Unfollow</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p>No Suggestion yet.</p>
            @endforelse
            @endauth

            <hr>
            <p>Term of Service Privacy Policy Cookie Policy Accessability Ads Info More 2024 Sosmed</p>
        </div>
    </div>
</div>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection

