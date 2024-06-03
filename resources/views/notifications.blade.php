@extends('layouts.master')

@section('navbar')
<div class="row mt-5">
    <div class="col-12">
        <div class="py-3">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('notifications') ? 'active' : '' }}" href="{{ route('notifications') }}">Semua</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('notifications/comments') ? 'active' : '' }}" href="{{ route('notifications.comments') }}">Komentar</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('notifications/likes') ? 'active' : '' }}" href="{{ route('notifications.likes') }}">Diskai</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Notifikasi</h5>
                <ul class="list-group">
                    @forelse($notifications as $notification)
                        <li class="list-group-item d-flex align-items-center">
                            <img src="{{ $notification->notifiable->profile_image ?? 'default_profile.png' }}" class="rounded-circle me-2" width="40" alt="">
                            <div>
                                <strong>{{ $notification->notifiable->username ?? 'Unknown' }}</strong> 
                                @if($notification->type == 'like')
                                    menyukai postingan anda.
                                @elseif($notification->type == 'comment')
                                    mengomentari postingan anda.
                                @else
                                    mengikuti anda.
                                @endif
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">Tidak ada notifikasi</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

