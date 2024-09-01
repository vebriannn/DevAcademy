@foreach($replies as $reply)
        <div class="profile d-flex">
            <a class="fw-semibold mb-0 text-black">
                {{ $reply->user->name }}
                @if($reply->user->role === 'mentor')
                    <img src="{{ asset('nemolab/member/img/reply-mentor.png') }}" width="20" height="20" alt="">
                @endif
            </a>
            <p class="ms-3 fw-light mb-0">{{ $reply->created_at->diffForHumans() }}</p>
        </div>
        <div class="question">
            {{ $reply->reply }}
        </div>
@endforeach
