@extends('components.layouts.member.navback')

@section('title', 'Forum Konsultasi')

@section('content')
<div class="container mb-5" id="content" style="margin-top: 4rem;">
    <div class="row mt-4">
        <div class="col-12">
            <div class="text-center mb-4">
                <h3 class="mb-2">Forum Diskusi</h3>
                <h1>{{ $forum->tittle }}</h1>
            </div>
            <div class="comments-section">
                <div class="mb-4">
                    <h5>Tambah Topik Pembicaraan:</h5>
                    <form action="{{ route('member.comment.add', ['forum_id' => $forum->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea name="comment" placeholder="Tulis Topik Pembicaraan" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                @forelse ($comments as $comment)
                    <div class="comment mb-4 p-3 border rounded">
                        <p class="mb-2"><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
                        <a class="btn btn-outline-secondary" data-bs-toggle="collapse" href="#replies-{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="replies-{{ $comment->id }}">
                            Show Replies
                        </a>
                        <div class="collapse mt-3" id="replies-{{ $comment->id }}">
                            <form action="{{ route('member.comment.reply', ['comment_id' => $comment->id]) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="reply" placeholder="Tulis Balasan" class="form-control" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Reply</button>
                            </form>
                            @foreach ($comment->replies as $reply)
                                <div class="reply ms-3 mb-2 p-2 border rounded">
                                    <p class="mb-1"><strong>{{ $reply->user->name }}:</strong> {{ $reply->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <p class="text-center">No comments yet. Be the first to comment!</p>
                @endforelse

                <div class="d-flex justify-content-between mt-4">
                    {!! $comments->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- short polling --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
<script>
    $(document).ready(function() {
        let lastCommentId = {{ $comments->last() ? $comments->last()->id : 0 }};
        let processedComments = JSON.parse(localStorage.getItem('processedComments')) || {};

        function fetchNewComments() {
            $.ajax({
                url: "{{ route('member.comment.polling', $forum->id) }}",
                method: "GET",
                data: { last_comment_id: lastCommentId },
                success: function(data) {
                    data.forEach(function(comment) {
                        if (!processedComments[comment.id]) {
                            processedComments[comment.id] = true;
                            localStorage.setItem('processedComments', JSON.stringify(processedComments));

                            if (comment.parent_id === null) {
                                $('#content').append(`
                                    <div class="comment mb-4 p-3 border rounded" id="comment-${comment.id}">
                                        <p class="mb-2"><strong>${comment.user.name}:</strong> ${comment.comment}</p>
                                        <a class="btn btn-outline-secondary" data-bs-toggle="collapse" href="#replies-${comment.id}" role="button" aria-expanded="false" aria-controls="replies-${comment.id}">
                                            Show Replies
                                        </a>
                                        <div class="collapse mt-3" id="replies-${comment.id}">
                                            <form action="/member/comment/${comment.id}/reply" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <textarea name="reply" placeholder="Tulis Balasan" class="form-control" rows="3" required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Reply</button>
                                            </form>
                                        </div>
                                    </div>
                                `);
                            } else {
                                let repliesSection = $(`#replies-${comment.parent_id}`);
                                if (repliesSection.length > 0) {
                                    repliesSection.append(`
                                        <div class="reply reply-${comment.id} ms-3 mb-2 p-2 border rounded">
                                            <p class="mb-1"><strong>${comment.user.name}:</strong> ${comment.comment}</p>
                                        </div>
                                    `);
                                }
                            }
                            lastCommentId = Math.max(lastCommentId, comment.id);
                        }
                    });
                },
                error: function() {
                    console.error('Failed to fetch new comments');
                }
            });
        }
        const throttledFetchNewComments = _.throttle(fetchNewComments, 5000);

        setInterval(throttledFetchNewComments, 5000);
    });
</script>


@endsection
