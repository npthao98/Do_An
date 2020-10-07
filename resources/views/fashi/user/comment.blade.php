<div class="comment">
    <div class="comment-option">
        <div class="co-item">
            @foreach ($comments as $comment)
                <div class="avatar-pic">
                    <img src="{{ asset('bower_components/bower_fashi_shop/img/product-single/avatar-2.png') }}" alt="">
                </div>
                @if (auth()->id() == $comment->user_id)
                    <div class="dropdown">
                        <div class="float-right pointer" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            </svg>
                        </div>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalEditComment-{{ $comment->id }}">{{ trans('text.edit') }}</a>

                            <a class="dropdown-item" href="#">{{ trans('text.delete') }}</a>
                        </div>
                    </div>
                @endif

                <div class="modal fade" id="exampleModalEditComment-{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ trans('text.edit') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <textarea class="form-control edit-content-{{ $comment->id }}" name="edit-content" id="exampleFormControlTextarea1" rows="3">{{ $comment->content }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('text.close') }}</button>
                                <button type="button" class="btn btn-primary update-comment" data-dismiss="modal" data-comment-id="{{ $comment->id }}" data-product-comment-id="{{ $comment->product_id }}">{{ trans('text.save_change') }}</button>
                            </div>
                        </div>
                    </div>
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
                    <div class="at-reply-{{ $comment->id }}">{{ $comment->content }}</div>
                </div><br>
            @endforeach
        </div>
    </div>
</div>
{{ $comments->links() }}
