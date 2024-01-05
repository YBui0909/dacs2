<h1 class="heading">Bình luận</h1>
<div class="comment_lv0">
    <div class="comment_container-lv0">
        <textarea style="display: block" id="comment_lv0-content" cols="100" rows="10" placeholder="Tham gia thảo luận"></textarea>
        <div>
            <input type="text" id="comment_lv0-name" placeholder="Tên của bạn">
            <button type="submit" onclick="comment({{ $detailNews->RowID }})">Bình luận</button>
        </div>
    </div>
</div>
@if (isset($comment_LV1))
    {{-- Comment container --}}
    <ul class="comment_container">
        {{-- Comment lv1 --}}
        @foreach ($comment_LV1 as $lv1)
            <li class="comment_container-lv1">
                <div class="user_reply">
                    <b>Tên: {!! $lv1->Name !!}</b>
                    <p>Thời gian: {!! $lv1->created_at !!}</p>
                </div>
                <div class="comment_container-lv-content">
                    <div class="content_comment">{!! $lv1->Contents !!}
                        <button>Trả lời</button>
                    </div>
                    <div class="reply_comment">
                        <textarea name="" id="reply_comment-content-lv1{{ $lv1->RowID }}" cols="100%" rows="6"
                            placeholder="Trả lời"></textarea>
                        <div>
                            <div>
                                <input type="text" id="reply_comment-name-lv1{{ $lv1->RowID }}"
                                    placeholder="Tên của bạn">
                                <button type="submit"
                                    onclick="reply_comment({{ $detailNews->RowID }},{{ $lv1->RowID }},1,0,{{ $lv1->RowID }})">Trả
                                    lời</button>
                            </div>
                        </div>
                    </div>
                </div>
                @if (isset($comment_LV2))
                    <ul class="comment_container-lv2">
                        {{-- Comment lv2 --}}
                        @foreach ($comment_LV2 as $lv2)
                            @if ($lv2->Reply_ID == $lv1->RowID)
                                <li>
                                    <div class="user_reply">
                                        <b>Tên: {!! $lv2->Name !!}</b>
                                        <p>Thời gian: {!! $lv2->created_at !!}</p>
                                    </div>
                                    <div class="comment_container-lv-content">
                                        <div class="content_comment">{!! $lv2->Contents !!}
                                            <button>Trả lời</button>
                                        </div>
                                        <div class="reply_comment">
                                            <textarea name="" id="reply_comment-content-lv2{{ $lv2->RowID }}" cols="100%" rows="6"
                                                placeholder="Trả lời"></textarea>
                                            <div>
                                                <div>
                                                    <input type="text" id="reply_comment-name-lv2{{ $lv2->RowID }}"
                                                        placeholder="Tên của bạn">
                                                    <button type="submit"
                                                        onclick="reply_comment({{ $detailNews->RowID }},{{ $lv2->RowID }},2,{{ $lv1->RowID }},{{ $lv2->RowID }})">Trả
                                                        lời</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (isset($comment_LV3))
                                        <ul class="comment_container-lv3">
                                            {{-- Comment lv3 --}}
                                            @foreach ($comment_LV3 as $lv3)
                                                @if ($lv3->Reply_ID == $lv2->RowID)
                                                    <li>
                                                        <div class="user_reply">
                                                            <b>Tên: {!! $lv3->Name !!}</b>
                                                            <p>Thời gian: {!! $lv3->created_at !!}</p>
                                                        </div>
                                                        <div class="comment_container-lv-content">
                                                            <div class="content_comment">{!! $lv3->Contents !!}
                                                                <button>Trả lời</button>
                                                            </div>
                                                            <div class="reply_comment">
                                                                <textarea name="" id="reply_comment-content-lv3{{ $lv3->RowID }}" cols="100%" rows="6"
                                                                    placeholder="Trả lời"></textarea>
                                                                <div>
                                                                    <div>
                                                                        <input type="text"
                                                                            id="reply_comment-name-lv3{{ $lv3->RowID }}"
                                                                            placeholder="Tên của bạn">
                                                                        <button type="submit"
                                                                            onclick="reply_comment({{ $detailNews->RowID }},{{ $lv3->RowID }},3,{{ $lv2->RowID }},{{ $lv3->RowID }})">Trả
                                                                            lời</button>
                                                                    </div>
                                                                    <input type="email"
                                                                        id="reply_comment-email-lv3{{ $lv3->RowID }}"
                                                                        placeholder="Email của bạn">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>

@endif

<script>
    // Comment 
    function comment(rowid) {
        var token = $('#_token').val();
        var content = $('#comment_lv0-content').val();
        var name = $('#comment_lv0-name').val();

        // Check if any of the required fields are empty
        if (!content || !name) {
            alert('Vui lòng điền đầy đủ thông tin.');
            return;
        }

        $.ajax({
            url: 'comment',
            type: 'POST',
            data: {
                RowID: rowid,
                Contents: content,
                Name: name,
                _token: token
            },
            success: function(response) {
                if (response.success) {
                    alert('Bình luận thành công.');
                    location.reload();
                } else {
                    alert('Có lỗi xảy ra khi lưu bình luận.');
                }
            },
            error: function() {
                alert('Gửi tin thất bại. Vui lòng thử lại.');
            }
        });
    }

    // Reply comment
    function reply_comment(newID, replyID, lv, pre_id, CurID) {
        var token = $('#_token').val();
        var content = $('#reply_comment-content-lv' + lv + CurID).val();
        var name = $('#reply_comment-name-lv' + lv + CurID).val();

        var level = (lv < 3) ? (lv + 1) : lv;

        if (lv == 1 || lv == 2) {
            reply_ID = replyID;
        } else {
            reply_ID = pre_id;
        }

        if (!content || !name ) {
            alert('Vui lòng điền đầy đủ thông tin.');
            return;
        }

        $.ajax({
            url: 'reply_comment',
            type: 'POST',
            data: {
                NewID: newID,
                ReplyID: reply_ID,
                Level: level,
                Contents: content,
                Name: name,
                _token: token
            },
            success: function(response) {
                if (response.success) {
                    alert('Bình luận thành công.');
                    location.reload();
                } else {
                    alert('Có lỗi xảy ra khi lưu bình luận.');
                }
            },
            error: function() {
                alert('Gửi tin thất bại. Vui lòng thử lại.');
            }
        });
    }

    $(document).ready(function() {
        $(".content_comment").click(function() {
            var replyComment = $(this).siblings(".reply_comment");

            if (replyComment.is(":visible")) {
                replyComment.hide();
            } else {
                $(".reply_comment").hide();
                replyComment.show();
            }
        });
    });
</script>
