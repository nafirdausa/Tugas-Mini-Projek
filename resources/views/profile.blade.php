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
            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Launch demo modal
            </button> --}}
            {{-- <a href="#" class="nav-link text-white" id="edit-profile-link">
                <svg class="bi me-2" fill="#4B9494" width="16" height="16"><use xlink:href="#setting"></use></svg>
            </a> --}}
        </div>
        <!-- Modal -->
        
        <!-- Modal for password confirmation -->
        {{-- <div class="modal fade" tabindex="-1" id="passwordModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Confirm Password</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <input type="password" class="form-control" id="passwordInput" placeholder="Enter your password">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" id="confirmPasswordButton">Confirm</button>
                </div>
              </div>
            </div>
        </div> --}}
    @endauth
</div>

@endsection

@section('content')
{{-- <div class="col" style="width: 100%; height: 100%;">
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
                <p>Belum ada postingan yang dapat ditampilkan</p>
            @endforelse
        @else
            <div class="row d-flex justify-content-start"></div>
        @endauth
    </div>
</div> --}}

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



