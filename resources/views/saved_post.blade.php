@extends('layouts.app_layout')
@section('page_title')
My favorites
@endsection

@section('content')
<div class="container-fluid saved-post">
    <div class="row">
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 favorite-post-container">
            <div class="favorite-post-header">
                <h3 style="">My Saved Post</h3>
            </div>
            <div class="row" style="margin-top: -15px;">
                @if(count($favorites) > 0)
                @foreach ($favorites as $favorite)
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 favorite-post-body">
                    <a href="{{ url (Str::replace(' ', '-', Str::limit($favorite->post_title, 80))) }} {{$favorite->post_id}}">
                        <div class="category">
                            <h4>{!! Str::limit($favorite->category, 70) !!}</h4>
                        </div>
                        <div class="favorite-post-body-size">
                            <div class="favorite-image-container">
                                <img src="../images/{{$favorite->featured_picture}}" alt="{{$favorite->post_title}}"/>
                            </div>
                            <div class="d-flex flex-row">
                                <div class="col-6 author-name">
                                    <span style=""> By {{$favorite->first_name}} {{$favorite->last_name}}</span>
                                </div>
                                <div class="col-6 favorite-post-date">
                                    <span>{{date('F j, Y', strtotime($favorite->post_created_at))}}</span>
                                </div>
                            </div>
                            <div class="favorite-post-title">
                                <h5>{{$favorite->post_title}}</h5>
                            </div>
                            <div class="favorite-post-saved-date p-2 text-center">
                                <h5>Added to favorites on {{date('F j, Y', strtotime($favorite->favorites_created_at))}}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

                <div class="container-fluid text-center p-4">
                    {!! $favorites->links() !!} 
                </div>
                @else
                <div class="container text-center">
                    <h2>No saved post</h2>
                </div>
                @endif
            </div>

        </div>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 read-post-side-bar">
            <div class="recent-post-container">
                <h3>- Trending News-</h3>
                @foreach ($posts as $post)
                <a href="{{ url (Str::replace([' ','?'], '-', Str::limit($post->post_title, 50))) }} {{$post->id}}"> 
                    <div class="read-post-side-bar-title-container">
                        <h5>{!! Str::limit($post->post_title, 50) !!}</h5> 
                    </div>

                </a>
                @endforeach 
            </div>
            <div class="container-fluid post-side-bar-advert">
                <img src="../images/image2.jpg" alt="..."/>
            </div>
        </div>
    </div>
</div> 
<section class="sect3">
    <div class="container-fluid  four-column-post">
        <div class="home-header">
            <hr>
            <h3>More from us</h3>
        </div>
        <div class="row">
            @foreach ($sport as $sport)
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 four-column-post-body">
                <a href="{{ url (Str::replace([' ','?'], '-', Str::limit($sport->post_title, 50))) }} {{$sport->id}}">
                    <div class="four-column-post-size">
                        <div class="four-column-post-image-container">
                            <img src="../images/{{$sport->featured_picture}}" alt="{{ Str::limit($sport->post_title, 80) }}" />
                        </div>
                        <div class="four-column-post-author ">
                            <span><em>
                                    By {{$sport->first_name}} {{$sport->last_name}}
                                </em></span>
                        </div>
                        <div class="four-column-post-content">
                            <h5><strong>{!! Str::limit($sport->post_title, 70) !!}</strong></h5>
                            <h4>{!! Str::limit($sport->body, 50) !!}</h4>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>   
</section>

@endsection
