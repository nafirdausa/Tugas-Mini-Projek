@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Main Content -->
        <div class="col-md-8">
            <div class="py-3">
                @foreach ($posts as $post)
                <div class="row d-flex justify-content-end mt-3">
                    <div class="card bg-transparent border" style="width: 25rem;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <img src="{{ $post->user->profile_image ?? asset('images/default_profile.png') }}" class="rounded-circle me-2" width="50" height="50" alt="img-profil">
                                </div>
                                <div class="flex-fill">
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
                                            <form action="{{ route('posts.unbookmark', $post) }}" method="POST">
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

        <!-- Sidebar for User Suggestions -->
        <div class="col-md-4">
            <div class="py-3">
                <h5>Suggestions</h5>
                <ul class="list-group">
                    @foreach ($suggestions as $suggestion)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <img src="{{ $suggestion->profile_image ?? asset('images/default_profile.png') }}" class="rounded-circle me-2" width="40" height="40" alt="img-profil">
                            <span>{{ $suggestion->username }}</span>
                        </div>
                        <a href="{{ route('follow', ['user' => $suggestion->id]) }}" class="btn btn-primary">Follow</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
