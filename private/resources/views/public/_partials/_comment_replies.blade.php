<?php
/**
 * @var \Illuminate\Database\Eloquent\Builder|\App\Comment[] $comments
 */
?>
@foreach($comments as $comment)
    <div id="comment-{{ $comment->id }}" class="display-comment">

        <div class="block-item-meta">
            <strong><i class="far fa-user"></i> {{ $comment->user->name }}</strong>
            -
            <small>
                <i class="far fa-clock"></i> {{ display_date_timezone($comment->created_at) }}
            </small>
            -
            <small><a class="reply-add" href="#">{{ __('Add Reply') }}</a></small>
        </div>

        <p><?= nl2br(e($comment->content)) ?></p>

        @guest
            <div class="reply-form">
                {{ __('You must be logged in to post a comment.') }}
            </div>
        @else
            <form class="reply-form" method="post" action="{{ route('reply.add') }}">
                @csrf
                <input type="hidden" name="data" value="<?= encrypt([
                    'article_id' => $article_id,
                    'parent_id' => $comment->id
                ]) ?>"/>

                <div class="form-group">
                    <textarea required name="content" class="form-control" placeholder="{{ __('Content') }}"></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-sm" value="Reply"/>
                </div>
            </form>
        @endguest

        @include('public._partials._comment_replies', ['comments' => $comment->activeReplies(), 'article_id' => $article_id])
    </div>
@endforeach
