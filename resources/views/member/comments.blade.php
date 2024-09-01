@foreach($comments as $comment)
    <div class="card card-diskusi p-3 mx-auto mt-5">
        <div class="profile d-flex">
            <a class="fw-semibold mb-0 text-black">
                {{ $comment->user->name }}
                @if($comment->user->role === 'mentor')
                @endif
            </a>
            <p class="ms-3 fw-light mb-0">{{ $comment->created_at->diffForHumans() }}</p>
        </div>
        @if($comment->user->role === 'mentor' || $comment->replies->contains(function ($reply) {
            return $reply->user->role === 'mentor';
        }))
            <div class="reply-mentor d-flex mt-2">
                <img src="{{ asset('nemolab/member/img/reply-mentor.png') }}" width="25" height="25" alt="">
                <p class="ms-2">Dijawab Mentor</p>
            </div>
        @endif
        <div class="question">
            {{ $comment->comment }}
        </div>
        <div class="action-balas">
            <p class="d-inline-flex gap-1 mb-0">
                <a class="text-black fw-semibold" data-bs-toggle="collapse" href="#collapsecomment{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="collapseExample" onclick="toggleChevron('chevron{{ $comment->id }}')">
                    <img class="my-auto" id="chevron{{ $comment->id }}" src="{{ asset('nemolab/member/img/chevron-down-orange.png') }}" width="20" height="20" alt="">
                    Balasan
                </a>
            </p>
            <p class="d-inline-flex gap-1 mb-0">
                <a class="text-black ms-3" data-bs-toggle="collapse" href="#collapsereply{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Balas
                </a>
            </p>
        </div>
        <div class="collapse" id="collapsereply{{ $comment->id }}">
            <div class="card card-body ps-4 pe-0 py-1">
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control reply-input" placeholder="Balas" aria-label="Reply" aria-describedby="addon-wrapping" value="">
                    <button class="btn-send-reply" data-comment-id="{{ $comment->id }}">
                        <img src="{{ asset('nemolab/member/img/send.png') }}" width="20" height="20" alt="Kirim">
                    </button>
                </div>
            </div>
        </div>
        <div class="collapse" id="collapsecomment{{ $comment->id }}">
            <div class="card card-body ps-4 pe-0 py-1">
                @include('member.replies', ['replies' => $comment->replies])
            </div>
        </div>
    </div>
@endforeach
