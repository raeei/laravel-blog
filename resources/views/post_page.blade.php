@extends('layouts.app_layout')
@section('page_title')
@foreach ($singlePost as $post)
@endforeach
Myblog.com | {{$singlePost->post_title}}
@endsection
@section('content')

<section class="read-post-sect-1">
    <div class="read-post">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 read-post-side">
                <div class="read-post-side-con">
                    <h1 class="read-post-title">
                        <strong> {{$singlePost->post_title}} </strong>
                    </h1>
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-12 col-sm-12 col-xs-12 read-post-author-container" >

                            <div class=""> <img class="read-post-author-picture" src="../images/{{$singlePost->picture}}" alt="{{$singlePost->first_name}} {{$singlePost->last_name}}"/>
                                <h6 class="read-post-author-name">  {{$singlePost->first_name}} {{$singlePost->last_name}}</h6>
                                <h6 class="read-post-date">Posted on  {{date('F j, Y', strtotime($singlePost->created_at))}}</h6>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-5 col-md-12 col-sm-12 col-xs-12 read-post-share-container">
                            <h6>{{ $singlePost->category }}</h6>
                        </div>
                    </div>
                    <div class="">
                        <img class="read-post-image" src="../images/{{$singlePost->featured_picture}}"/>
                    </div>
                    <div>
                        <h5 class="read-post-body">  {!! $singlePost->body !!}
                        </h5>
                    </div>
                    <div class="read-post-page-icons">
                        <div class="row">
                            <div class="col-6 text-left">
                                <span style="">
                                    @guest
                                    <i class="fas fa-heart fa-lg" id="read-post-count-likes" data-toggle="modal" data-target="#loginSignUp"></i> 
                                    @else
                                    <i class="fas fa-heart fa-lg" id="read-post-count-likes" onclick="likePost()"> </i> 
                                    @endguest
                                    <i class="fas fa-comment fa-lg" onclick="countComment()" id="read-post-count-comment"> </i></span>
                            </div>
                            <div class="col-6 text-right">
                                <span>
                                    <i class="fas fa-square-share-nodes fa-lg" id="read-post-count-share"> 460</i> 
                                    @guest
                                    <i class="fa-solid fa-bookmark fa-lg" id="read-post-count-favorite" data-toggle="modal" data-target="#loginSignUp"></i>
                                    @else
                                    <i class="fa-solid fa-bookmark fa-lg" id="read-post-count-favorite" onclick="savePost()"></i>
                                    @endguest
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (Auth::check()) {
                        $user_name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                    } else {
                        $user_name = "0";
                    }
                    ?>
                    <div class="container" >
                        <div class="read-post-declaimer-container">
                            <h4><strong>Disclaimer</strong></h4>
                            <h5>
                                Comments expressed here do not reflect the opinions of myBlog.com or any employee thereof.
                            </h5>
                        </div>

                    </div>
                    <div>
                        <h4 class="read-post-comment-header"><strong>Add a comment</strong></h4>
                        @guest
                        <div>
                            <textarea class="form-control read-post-not-signedIn-textarea" data-toggle="modal" data-target="#loginSignUp" rows="3" readonly  placeholder="Post comment here..."></textarea>
                            <button class="btn btn-dark read-post-not-signedIn-button">Submit</button>
                        </div>
                        @else
                        <div>
                            <form id="createCommentForm" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <input type="hidden" name="id" id="id" value="{{$singlePost->id}}">
                                <textarea class="form-control post-comment" id="post-comment" maxlength="1000" name="post_comment" rows="6"></textarea>
                                <span class="d-none text-danger" id="comment-alert">
                                </span>
                                <div class="text-right">
                                    <span id="current"></span>
                                </div>

                                <div class="text-center read-post-success-message">
                                    <p class="" id="success-alert">
                                        <strong>Comment created</strong></p>
                                </div>
                                <button type="submit" id="create-comment-button" class="btn btn-dark">Submit</button>
                            </form>
                        </div>
                        @endguest

                    </div>
                    <div  class="read-post-comment-container" style="">
                        <div class="p-4" id="read-post-comment-preloader"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 read-post-side-bar">
                <div class="recent-post-container">
                    <h3>- Trending News-</h3>
                    @foreach ($related_post as $related_post)
                    <a href="{{ url (Str::replace([' ','?'], '-', Str::limit($related_post->post_title, 50))) }} {{$related_post->id}}"> 
                        <div class="read-post-side-bar-title-container">
                            <h5>{!! Str::limit($related_post->post_title, 50) !!}</h5> 
                        </div>

                    </a>
                    @endforeach 
                </div>
                <div class="container-fluid post-side-bar-advert">
                    <img src="../images/image2.jpg" alt="..." height="300px" width="100%"/>
                </div>
            </div>
        </div>  
    </div>

</section>

<section class="sect2">
    <div class="container-fluid home-post-with-slider-container bg-white">
        <div class="home-header">
            <hr>
            <h3 class="text-black">More from us</h3>
        </div>
        <div class="my-slider">
            @foreach ($bottom_post as $bottom_post)
            <div class="slide" >
                <a href="{{ url (Str::replace([' '], '-', Str::limit($bottom_post->post_title, 50))) }} {{$bottom_post->id}}"> 
                    <div class="col">
                        <div class="col-md-12 shortlet-listing-image-container">
                            <img src="images/{{$bottom_post->featured_picture}}">
                            <div class="col-12  ">
                                <h4>{{Str::limit($bottom_post->post_title, 100)}}</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div id="controls">
            <button class="previous"><i class="fas fa-angle-left"></i></button>
            <button class="next"><i class="fas fa-angle-right"></i></button>
        </div>
        <div class="see-more">
            <a href="">See more</a> 
        </div>
    </div>
</section>
<?php
if (Auth::check()) {
    $user_id = Auth::user()->id;
} else {
    $user_id = 0;
}
?>


<script>
    $(document).ready(function () {
 var dd = .value = window.location;
   console.log(dd);
    // get all likes code goes here
    $.ajax({
    url: "{{ url('likes') }}/{{$singlePost->id}}",
            method: "get",
            dataType: 'json',
            success: function (response) {
            document.getElementById("read-post-count-likes").innerHTML = ' ' + response.data;
            if (response.auth_check > 0) {
            document.getElementById("read-post-count-likes").style.color = 'red';
            }
            }
    });
    
    // count comments for comment icon
    count_comments();
    function count_comments () {
    $.ajax({
    url: "{{ url('countComment') }}/{{$singlePost->id}}",
            method: "get",
            dataType: 'json',
            success: function (response) {
            document.getElementById("read-post-count-comment").innerHTML = ' ' + response.data;
            if (response.auth_check > 0) {
            document.getElementById("read-post-count-comment").style.color = 'red';
            }
            }
    });
    }

    // to add summernote wysiwyg to the text-area of comment
    $('.post-comment').summernote({
    toolbar: [
    ['style', ['style']],
    ['font', ['bold', 'underline', 'clear']],
    ['para', ['ul', 'ol']],
    ['insert', ['link', ]],
    ['view', [ 'help']],
    ],
            placeholder: 'Comment as {{$user_name}}',
            callbacks: {
            onKeydown: function (e){
            var t = e.currentTarget.innerText;
            var totalCharacters = t.trim().length;
            if (totalCharacters >= 1000){
            if (e.keyCode != 8 && !(e.keyCode >= 37 && e.keyCode <= 40) && e.keyCode != 46 && !(e.keyCode == 88 && e.ctrlKey) && !(e.keyCode == 67 && e.ctrlKey)) e.preventDefault();
            }
            },
                    onKeyup: function (e){
                    var t = e.currentTarget.innerText;
                    var totalCharacters = t.trim().length;
                    current = $('#current');
                    current.text(1000 - totalCharacters);
                    if (totalCharacters < 200) {
                    current.css('color', '#666');
                    }
                    if (totalCharacters > 200 && totalCharacters < 400) {
                    current.css('color', '#6d5555');
                    }
                    if (totalCharacters > 400 && totalCharacters < 600) {
                    current.css('color', '#841c1c');
                    }
                    if (totalCharacters > 600 && totalCharacters < 800) {
                    current.css('color', '#8f0001');
                    }
                    if (totalCharacters > 800 && totalCharacters < 999) {
                    current.css('color', '#8e0001');
                    }

                    if (totalCharacters >= 1000) {
                    current.css("color", "red");
                    e.preventDefault();
                    }
                    },
                    onFocus: function (e){
                    var t = e.currentTarget.innerText;
                    var totalCharacters = t.trim().length;
                    current = $('#current');
                    current.css('display', 'block');
                    },
                    onBlur: function (e){
                    var t = e.currentTarget.innerText;
                    var totalCharacters = t.trim().length;
                    current = $('#current');
                    if (totalCharacters <= 0){
                    current.css('display', 'none');
                    } else {
                    current.css('display', 'block');
                    }
                    },
                    onPaste: function(e) {
                    let characters = $('.post-comment').summernote('code').replace(/(<([^>]+)>)/ig, "");
                    let totalCharacters = characters.length;
//		$("#total-characters").text(totalCharacters + " / " + charLimit);
                    var t = e.currentTarget.innerText;
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    var maxPaste = bufferText.length;
                    if (t.length + bufferText.length > 1000) {
                    maxPaste = 1000 - t.length;
                    }
                    if (maxPaste > 0) {
                    document.execCommand('insertText', false, bufferText.substring(0, maxPaste));
                    }
                    $('#textarea').text(1000 - t.length);
                    }
            }
    });
    
    // code for getting all the saved posts
    $.ajax({
    url: "{{ url('getSavedPost') }}/{{$singlePost->id}}",
            method: "get",
            dataType: 'json',
            success: function (response) {
            if (response.data == 1) {
            document.getElementById("read-post-count-favorite").style.color = 'blue';
            }
            else{
            document.getElementById("read-post-count-favorite").style.color = 'black';
            }
            }
    });
    
    // Create comment code goes here
    $('#createCommentForm').submit(function (e) {
    e.preventDefault();
    $('#create-comment-button').html("");
    $('#create-comment-button').append('<i class="fa fa-spinner fa-spin"></i>');
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // gets the csrf_token
    }
    });
    let formData = new FormData(this);
    $.ajax({
    url: "{{ route('createComment') }}",
            type: 'post',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
            count_comments();
            if (response) {
            getComments(); // reload the comments to get the latest state 
            $("#comment-alert").addClass("d-none").removeClass("d-block");
            setTimeout(() => {
            $(".post-comment").summernote("reset");
            document.getElementById("success-alert").style.display = "block";
            $('#create-comment-button').html("");
            $('#create-comment-button').append('Submit');
            }, 1000);
            setTimeout(() => {
            document.getElementById("success-alert").style.display = "none";
            }, 3000);
            }
            },
            error: function (data) {
            $('#create-comment-button').html("");
            $('#create-comment-button').append('Submit');
            if ($.trim(data.responseJSON.errors.post_comment) == 0) {
            $("#comment-alert").addClass("d-none").removeClass("d-block");
            } else {
            $("#comment-alert").addClass("d-block").removeClass("d-none");
            document.getElementById("comment-alert").innerHTML = data.responseJSON.errors.post_comment[0];
            }
            }
    });
    });
    
    // get all comments from database excluding replies to each comment
    getComments();
    function getComments() {
    $.ajax({
    url: "{{ url('getAllComment') }}/{{$singlePost->id}}",
            method: "get",
            dataType: 'json',
            success: function (response) {
            // do something if data is gotten from 
            $('.read-post-comment-container').html("");
            if ($.trim(response.data) == 0){
            $('.read-post-comment-container').append('<div class="text-center p-4 read-post-comment-preloader"><h3>No Comments</h3></div>');
            }
            else{
            $.each(response.data, function (key, value) {
            var comment_id = value.id;
            const total_replies = response.count_replies.filter(element => element == comment_id);
            var created_at = new Date(value.created_at);
            var newDate = Math.round(( + new Date - created_at) / 1000 - 3600);
            var date;
            if (newDate < 60){
            date = 'Just now';
            }
            else if (newDate >= 60 && newDate < 120) {
            date = 'One minute ago';
            }
            else if (newDate >= 120 && newDate < 3600){
            newMinute = Math.round(newDate / 60);
            date = newMinute + ' minutes ago';
            }
            else if (newDate >= 3600 && newDate < 7200){
            date = '1 hour ago';
            }
            else if (newDate >= 7200 && newDate < 86400){
            newHour = Math.round(newDate / 3600);
            date = newHour + ' hours ago';
            }
            else if (newDate == 86400){
            date = '1 day ago';
            }
            else {
            get_time = created_at.getMinutes() + created_at.getMinutes();
            get_year = created_at.toLocaleString('default', { year: 'numeric' });
            get_month = created_at.toLocaleString('default', { month: 'short', day: 'numeric' });
            date = created_at.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }) + ' <i class="fa fa-circle" style="font-size: 5px; vertical-align: middle;"></i> ' + get_month + ', ' + get_year;
            }
            
            $('.read-post-comment-container').append('<div class="reply-box">\
                    <div class="row">\
                        <div class="col-xl-1 col-lg-2 col-md-2 col-sm-2 col-2">\
                            <img src="../images/' + value.picture + '" alt="' + value.first_name + '' + value.last_name + '"/>\
                        </div>\
                        <div class="col-xl-10 col-lg-9 col-md-9 col-sm-9 col-8 comment-name-container">\
                            <h6 class="comment1-name">' + value.first_name + ' ' + value.last_name + '</h6>\
                                <input  type="text-area" class="comment-name d-none" value="Replying to @' + value.first_name + ' ' + value.last_name + '" />\
                            <h6 class="comment-date">' + date + '</h6>\
                        </div>\
                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-2">\
                                    @guest\
                                    <i class="fas fa-heart fa-lg comment-likes" data-id="' + value.id + '" data-toggle="modal" data-target="#loginSignUp"></i> \
                                    @else\
                                     <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"/>\
                                <div class="comment-likes-container"><span><span></span><i class="fas fa-heart fa-lg comment-likes" data-id="' + value.id + '" data-user="'+ value.user_id +'" > </i></span></div>\
                                    @endguest\
                        </div>\
                    </div>\
                    <div><h5 class="comment-message">' + value.comment_body + '</h5><div>\
                    <div class="comment-button-container">\
                    @guest\
                                    <button data-toggle="modal" data-target="#loginSignUp" class="btn rep-btn reply-btn">Reply</button>\
                                @else    \
                                    <button value="' + value.id + '" class="btn rep-btn reply-btn">Reply</button>\
                            @endguest\
                        <button style="display: none;" value="' + value.id + '" data-count="' + total_replies.length + '"  class="btn view-reply-btn">View Replies (' + total_replies.length + ')</button>\
                    </div>\
                     <div class="reply-section"></div>\
                     <div class=""><span class="d-none hide-comment" id="hide-comment" value="' + value.id + '">hide comments</span> </div>\
                </div>');
            }); 
            
              $('.comment-likes').each(function () {
                var self = $(this);
                var comment_id = self.data('id');
                var comment_user_id = self.data('user');
                const total_comment_likes = response.count_comment_likes.filter(element => element == comment_id);
                const loggedIn_user_likes = response.loggedIn_user_likes.filter(element => element == comment_id);
                 
                var user_id = {{$user_id}};
                if (total_comment_likes.length > 0) {
                   self.html(' ' + total_comment_likes.length);
                }
                if(comment_id == loggedIn_user_likes){
                    self.css('color', 'red')
                }
                if (user_id != comment_user_id && user_id != 0){
                    self.addClass('like-unlike');
                    self.css('cursor', 'pointer');
                }
                if (comment_id == total_comment_likes && user_id != comment_user_id && user_id != 0){
                    self.addClass('like-unlike');
                    self.css('cursor', 'pointer');
                }
               self.removeAttr('data-user');
            });
            
            // this hide the view reply button if it has no reply or replies
            $('.view-reply-btn').each(function () {
                var self = $(this);
                var count_reply = self.data('count');
                if (count_reply == 0) {
                    self.css('display', 'none');
                }
                else{
                    self.css('display', 'inline-block');
                }
            });
            }
            }
    });
    }

    // for like and unlike a comment or reply
    $(document).on('click', '.like-unlike', function () {
    var thisClick = $(this)
    var comment_id = thisClick.data('id');
    var _token = thisClick.closest('.reply-box').find('#_token').val();
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var data = {
            'comment_id': comment_id,
            'id': {{$singlePost->id}},
            '_token': _token
        };
    $.ajax({
            url: "{{ route('likeUnlikeComment') }}",
            method: "post",
            data: data,
            dataType: 'json',
            success: function (response) {
                        console.log(response.data);
                if(response.data > 0){
                    thisClick.html("");
                thisClick.html(' ' + response.data);
            }
            else {
                thisClick.html("");
            }
            if (response.auth_check > 0) {
                thisClick.css('color', 'red');
            } 
            else {
           thisClick.css('color', 'black');
            }
            }
    });
    });
    
    // to hide comment's reply
    $(document).on('click', '.hide-comment', function () {
    var thisClick = $(this);
    thisClick.closest('.reply-box').find('.reply-section').html("");
    thisClick.closest('.reply-box').find('.view-reply-btn').show();
    thisClick.closest('.reply-box').find("#hide-comment").addClass("d-none").removeClass("d-block");
    });
    // code to display the reply box for the main comment
    $(document).on('click', '.reply-btn', function () {
    var thisClick = $(this);
    $('.reply-section').html("");
    $('.sub-input-reply').html("");
    thisClick.closest('.reply-box').find('.view-reply-btn').show();
    thisClick.closest('.reply-box').find("#hide-comment").addClass("d-none").removeClass("d-block");
    var comment = thisClick.closest('.reply-box').find('.comment-name').val();
    thisClick.closest('.reply-box').find('.reply-section').append('@guest\
            @else\
   <div class="main-input-reply"> <h6 class="replying-to-user">' + comment + '</h6>\
              <textarea placeholder="Replying as {{$user_name}}" type="text" class="form-control reply-msg" id="reply-msg" rows="2"></textarea>\
                       <div class="text-right">\
                                   <span id="count-text-reply"></span>\
                                </div>\
            <div class="">\
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"/>\
                <span class="d-none text-danger" id="reply-alert">\
                    </span>\
            <div class="text-right mt-2 mb-2">    <button class="btn rep-btn reply-add-btn" id="reply-add-btn">Reply</button>\
                <button class="btn btn-danger reply-cancel-btn">Cancel</button>\
          </div>  </div> </div>\
        @endguest');
    $('.reply-msg').summernote({
    toolbar: [
    ['style', ['style']],
    ['font', ['bold', 'underline', 'clear']],
    ['para', ['ul', 'ol']],
    ['insert', ['link', ]],
    ['view', [ 'help']],
    ],
            placeholder: 'Comment as {{$user_name}}',
            callbacks: {
            onKeydown: function (e){
            var t = e.currentTarget.innerText;
            var totalCharacters = t.trim().length;
            if (totalCharacters >= 1000){
            if (e.keyCode != 8 && !(e.keyCode >= 37 && e.keyCode <= 40) && e.keyCode != 46 && !(e.keyCode == 88 && e.ctrlKey) && !(e.keyCode == 67 && e.ctrlKey)) e.preventDefault();
            }
            },
                    onKeyup: function (e){
                    var t = e.currentTarget.innerText;
                    var totalCharacters = t.trim().length;
                    current = $('#count-text-reply');
                    current.text(1000 - totalCharacters);
                    if (totalCharacters < 200) {
                    current.css('color', '#666');
                    }
                    if (totalCharacters > 200 && totalCharacters < 400) {
                    current.css('color', '#6d5555');
                    }
                    if (totalCharacters > 400 && totalCharacters < 600) {
                    current.css('color', '#841c1c');
                    }
                    if (totalCharacters > 600 && totalCharacters < 800) {
                    current.css('color', '#8f0001');
                    }
                    if (totalCharacters > 800 && totalCharacters < 999) {
                    current.css('color', '#8e0001');
                    }
                    if (totalCharacters >= 1000) {
                    current.css("color", "red");
                    e.preventDefault();
                    }
                    },
                    onFocus: function (e){
                    var t = e.currentTarget.innerText;
                    var totalCharacters = t.trim().length;
                    current = $('#count-text-reply');
                    current.css('display', 'block');
                    },
                    onBlur: function (e){
                    var t = e.currentTarget.innerText;
                    var totalCharacters = t.trim().length;
                    current = $('#count-text-reply');
                    if (totalCharacters <= 0){
                    current.css('display', 'none');
                    } else {
                    current.css('display', 'block');
                    }
                    },
                    onPaste: function(e) {
                    let characters = $('.post-comment').summernote('code').replace(/(<([^>]+)>)/ig, "");
                    let totalCharacters = characters.length;
//		$("#total-characters").text(totalCharacters + " / " + charLimit);
                    var t = e.currentTarget.innerText;
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    var maxPaste = bufferText.length;
                    if (t.length + bufferText.length > 1000) {
                    maxPaste = 1000 - t.length;
                    }
                    if (maxPaste > 0) {
                    document.execCommand('insertText', false, bufferText.substring(0, maxPaste));
                    }
                    $('#textarea').text(1000 - t.length);
                    }
            }
    });
    });
    //for the cancel button of reply to the main comment  
    $(document).on('click', '.reply-cancel-btn', function () {
    $('.main-input-reply').html("");
    });
    // code to get all the replies of the main comment from the database
    $(document).on('click', '.reply-add-btn', function (e) {
    e.preventDefault();
    $('.reply-add-btn').html("");
    $('.reply-add-btn').append('<i class="fa fa-spinner fa-spin"></i>');
    var thisClick = $(this);
    var comment_id = thisClick.closest('.reply-box').find('.reply-btn').val();
    var reply_msg = thisClick.closest('.reply-box').find('.reply-msg').val();
    var _token = thisClick.closest('.reply-box').find('#_token').val();
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    var data = {
    'comment_id': comment_id,
            'reply_msg': reply_msg,
            'comment_name': " ",
            '_token': _token,
            'post_id':  {{$singlePost->id}},
    };
    $.ajax({
    url: "{{ route('replyComment') }}",
            method: "post",
            data: data,
            dataType: 'json',
            success: function (response) {
            $('.reply-add-btn').html("");
            $('.reply-add-btn').append('Reply');
            count_comments();
            getComments();
            },
            error: function (data) {
            if ($.trim(data.responseJSON.errors.reply_msg) == 0) {
            $("#reply-alert").addClass("d-none").removeClass("d-block");
            } else {
            $("#reply-alert").addClass("d-block").removeClass("d-none");
            document.getElementById("reply-alert").innerHTML = data.responseJSON.errors.reply_msg[0];
            }
            $('.reply-add-btn').html("");
            $('.reply-add-btn').append('Reply');
            }
    });
    });
    // code for getting all the replies via the view reply button
    $(document).on('click', '.view-reply-btn', function (e) {
    var thisClick = $(this);
    var comment_id = thisClick.val();
    thisClick.closest('.view-reply-btn').hide();
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
    url: "{{ route('getAllReplies') }}",
            method: "post",
            data: {
            'comment_id': comment_id,
            'post_id' : {{$singlePost->id}}
            },
            dataType: 'json',
            success: function (response) {
            $.each(response.data, function (key, value) {
            var created_at = new Date(value.created_at);
            var newDate = Math.round(( + new Date - created_at) / 1000 - 3600);
            var date;
            if (newDate < 60){
            date = 'Just now';
            }
            else if (newDate >= 60 && newDate < 120) {
            date = 'One minute ago';
            }
            else if (newDate >= 120 && newDate < 3600){
            newMinute = Math.round(newDate / 60);
            date = newMinute + ' minutes ago';
            }
            else if (newDate >= 3600 && newDate < 7200){
            date = '1 hour ago';
            }
            else if (newDate >= 7200 && newDate < 86400){
            newHour = Math.round(newDate / 3600);
            date = newHour + ' hours ago';
            }
            else if (newDate == 86400){
            date = '1 day ago';
            }
            else {
            get_time = created_at.getMinutes() + created_at.getMinutes();
            get_year = created_at.toLocaleString('default', { year: 'numeric' });
            get_month = created_at.toLocaleString('default', { month: 'short', day: 'numeric' });
            date = created_at.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }) + ' <i class="fa fa-circle" style="font-size: 5px; vertical-align: middle;"></i> ' + get_month + ', ' + get_year;
            }
            thisClick.closest('.reply-box').find("#hide-comment").addClass("d-block").removeClass("d-none");
            thisClick.closest('.reply-box').find('.reply-section').append('<div class="sub-reply-box">\
                    <div class="row">\
                        <div class="col-xl-1 col-lg-2 col-md-2 col-sm-2 col-2">\
                            <img src="../images/' + value.picture + '" alt="' + value.first_name + ' ' + value.last_name + '"/>\
                        </div>\
                        <div class="col-xl-10 col-lg-9 col-md-9 col-sm-9 col-8 comment-name-container">\
                            <h6 class="comment1-name">' + value.first_name + ' ' + value.last_name + '</h6>\
                                <input  type="text" class="reply-name d-none" value="@' + value.first_name + ' ' + value.last_name + '" />\
                            <h6 class="comment-date">' + date + '</h6>\
                        </div>\
                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-2">\
                                    @guest\
                                    <i class="fas fa-heart fa-lg comment-likes" data-id="' + value.id + '" data-toggle="modal" data-target="#loginSignUp"></i> \
                                    @else\
                                     <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"/>\
                                <div class="comment-likes-container"><span><span></span><i class="fas fa-heart fa-lg comment-likes" data-id="' + value.id + '" data-user="'+ value.user_id +'"> </i></span></div>\
                                    @endguest\
                        </div>\
                    </div>\
                    <div><h5 class="comment-message"> <span>' + value.comment_name + '</span> ' + value.reply_msg + ' </h5><div>\
                    <div class="p-2">\
                    @guest\
                        <button data-toggle="modal" data-target="#loginSignUp" class="btn rep-btn">Reply</button>\
                        @else\
                        <button value="' + value.comment_id + '" class="btn rep-btn sub-reply-btn">Reply</button>\
                        @endguest\
                    </div>\
                     <div class="sub-reply-section"></div>\
                </div>');
            });
             $('.comment-likes').each(function () {
                var self = $(this);
                var comment_id = self.data('id');
                var comment_user_id = self.data('user');
                const total_comment_likes = response.count_comment_likes.filter(element => element == comment_id);
                const loggedIn_user_likes = response.loggedIn_user_likes.filter(element => element == comment_id);
                console.log(self);
                 
                var user_id = {{$user_id}};
                if (total_comment_likes.length > 0) {
                   self.html(' ' + total_comment_likes.length);
                }
                if(comment_id == loggedIn_user_likes){
                    self.css('color', 'red')
                }
                if (user_id != comment_user_id && user_id != 0){
                    self.addClass('like-unlike');
                    self.css('cursor', 'pointer');
                }
                if (comment_id == total_comment_likes && user_id != comment_user_id && user_id != 0){
                    self.addClass('like-unlike');
                    self.css('cursor', 'pointer');
                }
                self.removeAttr('data-user');
            });
            }
    });
    });
    // code for showing the reply box of sub reply
    $(document).on('click', '.sub-reply-btn', function (e) {
    e.preventDefault();
    var thisClick = $(this);
    var comment_id = thisClick.val();
    $('.main-input-reply').html("");
    $('.sub-reply-section').html("");
    var reply_to = thisClick.closest('.sub-reply-box').find('.reply-name').val();
    thisClick.closest('.sub-reply-box').find('.sub-reply-section').append('@guest @else<div class="sub-input-reply">\
            <h6 class="replying-to-user">Replying to ' + reply_to + '</h6>\
            <textarea placeholder="Replying as {{$user_name}}" type="text" class="form-control sub-reply-msg" id="sub-reply-msg" rows="2"></textarea>\
                    <div class="text-right">\
                                   <span id="count-text-subreply"></span>\
                                </div>\
            <div class="">\
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"/>\
               <span class="d-none text-danger" id="reply-alert">\
                    </span>\
            <div class="text-right mt-2 mb-2">    <button class="btn rep-btn sub-reply-add-btn" id="reply-add-btn">Reply</button>\
                <button class="btn btn-danger sub-reply-cancel-btn">Cancel</button>\
          </div>   </div></div>@endguest');
    $('.sub-reply-msg').summernote({
    toolbar: [
    ['style', ['style']],
    ['font', ['bold', 'underline', 'clear']],
    ['para', ['ul', 'ol']],
    ['insert', ['link', ]],
    ['view', [ 'help']],
    ],
            placeholder: 'Comment as {{$user_name}}',
            callbacks: {
            onKeydown: function (e){
            var t = e.currentTarget.innerText;
            var totalCharacters = t.trim().length;
            if (totalCharacters >= 1000){
            if (e.keyCode != 8 && !(e.keyCode >= 37 && e.keyCode <= 40) && e.keyCode != 46 && !(e.keyCode == 88 && e.ctrlKey) && !(e.keyCode == 67 && e.ctrlKey)) e.preventDefault();
            }
            },
                    onKeyup: function (e){
                    var t = e.currentTarget.innerText;
                    var totalCharacters = t.trim().length;
                    current = $('#count-text-subreply');
                    current.text(1000 - totalCharacters);
                    if (totalCharacters < 200) {
                    current.css('color', '#666');
                    }
                    if (totalCharacters > 200 && totalCharacters < 400) {
                    current.css('color', '#6d5555');
                    }
                    if (totalCharacters > 400 && totalCharacters < 600) {
                    current.css('color', '#841c1c');
                    }
                    if (totalCharacters > 600 && totalCharacters < 800) {
                    current.css('color', '#8f0001');
                    }
                    if (totalCharacters > 800 && totalCharacters < 999) {
                    current.css('color', '#8e0001');
                    }

                    if (totalCharacters >= 1000) {
                    current.css("color", "red");
                    e.preventDefault();
                    }
                    },
                    onFocus: function (e){
                    var t = e.currentTarget.innerText;
                    var totalCharacters = t.trim().length;
                    current = $('#count-text-subreply');
                    current.css('display', 'block');
                    },
                    onBlur: function (e){
                    var t = e.currentTarget.innerText;
                    var totalCharacters = t.trim().length;
                    current = $('#count-text-subreply');
                    if (totalCharacters <= 0){
                    current.css('display', 'none');
                    } else {
                    current.css('display', 'block');
                    }
                    },
                    onPaste: function(e) {
                    let characters = $('.post-comment').summernote('code').replace(/(<([^>]+)>)/ig, "");
                    let totalCharacters = characters.length;
//		$("#total-characters").text(totalCharacters + " / " + charLimit);
                    var t = e.currentTarget.innerText;
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    var maxPaste = bufferText.length;
                    if (t.length + bufferText.length > 1000) {
                    maxPaste = 1000 - t.length;
                    }
                    if (maxPaste > 0) {
                    document.execCommand('insertText', false, bufferText.substring(0, maxPaste));
                    }
                    $('#textarea').text(1000 - t.length);
                    }

            }
    });
    });
    // code for the cancel button of the sub reply
    $(document).on('click', '.sub-reply-cancel-btn', function (e) {
    e.preventDefault();
    $('.sub-input-reply').html("");
    });
    // code to reply to a sub reply
    $(document).on('click', '.sub-reply-add-btn', function (e) {
    e.preventDefault();
    $('.sub-reply-add-btn').html("");
    $('.sub-reply-add-btn').append('<i class="fa fa-spinner fa-spin"></i>');
    var thisClick = $(this);
    var comment_id = thisClick.closest('.sub-reply-box').find('.sub-reply-btn').val();
    var sub_reply_msg = thisClick.closest('.sub-reply-box').find('.sub-reply-msg').val();
    var _token = thisClick.closest('.reply-box').find('#_token').val();
    var comment_name = thisClick.closest('.sub-reply-box').find('.reply-name').val();
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    var data = {
    'comment_id': comment_id,
            'reply_msg': sub_reply_msg,
            'comment_name': comment_name,
            '_token': _token,
            'post_id':  {{$singlePost->id}},
    };
    $.ajax({
    url: "{{ route('replyComment') }}",
            method: "post",
            data: data,
            dataType: 'json',
            success: function (response) {
            count_comments();
            getComments();
            $('.sub-reply-add-btn').html("");
            $('.sub-reply-add-btn').append('Reply');
            },
            error: function (data) {
            if ($.trim(data.responseJSON.errors.reply_msg) == 0) {
            $("#reply-alert").addClass("d-none").removeClass("d-block");
            } else {
            $("#reply-alert").addClass("d-block").removeClass("d-none");
            document.getElementById("reply-alert").innerHTML = data.responseJSON.errors.reply_msg[0];
            }
            $('.sub-reply-add-btn').html("");
            $('.sub-reply-add-btn').append('Reply');
            }
    });
    });
    });
    
    // code for liking a post
    function likePost() {
    $.ajax({
    url: "{{ url('likePost') }}/{{$singlePost->id}}",
            method: "get",
            dataType: 'json',
            success: function (response) {
            document.getElementById("read-post-count-likes").innerHTML = ' ' + response.data;
            if (response.auth_check > 0) {
            document.getElementById("read-post-count-likes").style.color = 'red';
            } else
            {
            document.getElementById("read-post-count-likes").style.color = 'black';
            }
            }
    });
    }

    // code for saving a post
    function savePost() {
    $.ajax({
    url: "{{ url('savePost') }}/{{$singlePost->id}}",
            method: "get",
            dataType: 'json',
            success: function (response) {
            if (response.data > 0) {
            document.getElementById("read-post-count-favorite").style.color = 'blue';
            $('#nav-count-saved-post').html("");
            document.getElementById("nav-count-saved-post").innerHTML = '<i class="fas fa-heart"></i> Saved Post  (' + response.count_user_total_saved + ')';
            } else
            {
            document.getElementById("read-post-count-favorite").style.color = 'black';
            $('#nav-count-saved-post').html("");
            document.getElementById("nav-count-saved-post").innerHTML = '<i class="fas fa-heart"></i> No Saved Post';
            }
            }
    });
    }
</script>

@endsection


