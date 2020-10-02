<div class="comment">
    <div class="comment-option">
        <div class="co-item">
            @foreach ($comments as $comment)
                <div class="avatar-pic">
                    <img src="{{ asset('bower_components/bower_fashi_shop/img/product-single/avatar-2.png') }}" alt="">
                </div>
                <div class="avatar-text">
                    <div class="at-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <h5>{{ $comment->user->name ?? '' }}<span>{{ $comment->created_at }}</span></h5>
                    <div class="at-reply">{{ $comment->content }}</div>
                </div><br>
            @endforeach
        </div>
    </div>
</div>
{{ $comments->links() }}
