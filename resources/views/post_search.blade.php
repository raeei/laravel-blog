@extends('layouts.app_layout')
@section('page_title')
MyBlog | Search for "{{$search_input}}"
@endsection

@section('content')

<section class="sect5">
<div class="container-fluid three-column-post-with-sidebar" style="margin-top: -50px">
    <div class="row">
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
            <div class="search-post-header">
                <h3>Search results for "{{$search_input}}"</h3>
            </div>
            <div class="row">
                @if(count($searched_post) < 1)
                
                 <div class="container text-center">
                    <h2>No post found</h2>
                </div>
                @else
                  @foreach ($searched_post as $search_post)
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 four-column-post-body">
                <a href="{{ url (Str::replace([' ','?'], '-', Str::limit($search_post->post_title, 50))) }} {{$search_post->id}}">
                    <div class="category">
                            <h4>{!! Str::limit($search_post->category, 70) !!}</h4>
                    </div>
                    <div class="four-column-post-size" style="margin-top: -11px;">
                        <div class="four-column-post-image-container">
                            <img src="../images/{{$search_post->featured_picture}}" alt="{{ Str::limit($search_post->post_title, 80) }}" />
                        </div>
                        <div class="four-column-post-content">
                            <h5><strong>{!! Str::limit($search_post->post_title, 70) !!}</strong></h5>
                            <h4>{!! Str::limit($search_post->body, 70) !!}</h4>
                        </div>
                       
                    </div>
                </a>
            </div>
                @endforeach 
                @endif
            </div>
             <div class="container-fluid text-center p-4">
                    {{ $searched_post->appends(request()->input())->links() }} 
                </div>
                
        </div>

         <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 read-post-side-bar ">
            <div class="recent-post-container">
                <h3>- Trending News-</h3>
                @foreach ($side_bar as $side_bar)
                <a href="{{ url (Str::replace([' ','?'], '-', Str::limit($side_bar->post_title, 50))) }} {{$side_bar->id}}"> 
                    <div class="read-post-side-bar-title-container">
                        <h5>{!! Str::limit($side_bar->post_title, 50) !!}</h5> 
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
</section>


<section class="sect3">
    <div class="container-fluid  four-column-post">
 
         <div class="home-header">
            <hr>
            <h3>More from us</h3>
        </div>
        <div class="row">
            @foreach ($bottom_post as $bottom_post)
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 four-column-post-body">
                <a href="{{ url (Str::replace(' ', '-', Str::limit($bottom_post->post_title, 50))) }} {{$bottom_post->id}}">
                    <div class="four-column-post-size">
                        <div class="four-column-post-image-container">
                            <img src="../images/{{$bottom_post->featured_picture}}" alt="{{ Str::limit($bottom_post->post_title, 80) }}" />
                        </div>
                        <div class="four-column-post-author ">
                            <span><em>
                                    {{$bottom_post->category}}
                                </em></span>
                        </div>
                        <div class="four-column-post-content">
                            <h5><strong>{!! Str::limit($bottom_post->post_title, 70) !!}</strong></h5>
                            <h4>{!! Str::limit($bottom_post->body, 50) !!}</h4>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>   
</section>

@endsection
