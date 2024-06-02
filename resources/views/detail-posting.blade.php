@extends('layouts.master')

@section('navbar')
<!-- Header -->
<div class="col-12">
    <div class="py-3">
        <ul class="nav justify-content-start">
            <li class="nav-item inline-block">
                <a class="nav-link active" aria-current="page" href="#">
                    <svg class="bi me-2" fill="#4B9494" width="32" height="32"><use xlink:href="#arrow-left"></use></svg>
                    Back</a>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('content')
<!-- Main Content Left -->
<div class="col border rounded" style="width: 100%; height: 100%; margin: 10px">
    <div class="p-3">
        <div class="row d-flex justify-content-between">
            {{-- Postingan --}}
            <div class="col-8 bg-transparent p-2">
                <div class="d-flex justify-content-between align-middle">
                    <div class="">
                        <img src="{{asset('images/default_profile.png')}}" class="rounded-circle me-2" width="30" alt="" srcset="">
                    </div>
                    <div class="flex-fill align-middle">
                        <h6>{{ $post->user ? $post->user->username : 'Unknown' }}</h6>
                    </div>
                </div>
                <p>{{ $post->caption }}</p>
                <img src="{{ Storage::url($post->image) }}" alt="gambar postingan" class="rounded-3 post-image" width="100%">
            </div>
            {{-- Comment --}}
            <div class="col-4 bg-transparent p-2">
                <h6>Komentar</h6>
                <div></div>
                <hr>
                <div class="d-flex justify-content-between">
                    <div>
                        <svg class="bi me-2" fill="white" width="18" height="18"><use xlink:href="#like"></use></svg>
                        <svg class="bi me-2" fill="white" width="18" height="18"><use xlink:href="#comment"></use></svg>
                        <svg class="bi me-2" fill="white" width="18" height="18"><use xlink:href="#send"></use></svg>
                    </div>
                    <div class="px-4">
                        <svg class="bi me-2" fill="white" width="18" height="18"><use xlink:href="#bookmark"></use></svg>
                    </div>
                </div>
                <p>{{ $post->created_at->diffForHumans() }}</p>

                <form action="{{ route('comments.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="text" class="input-group-text bg-transparent p-0 text-light" name="text_comment" id="text_comment" placeholder="Masukkan komentar">
                    <button type="submit" class="btn bg-transparent p-0 text-light">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
