                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       @extends('layouts.app_layout')
@section('page_title')
Welcome to my blog
@endsection

@section('content')

<section class="sect1">
    <div class="container-fluid post-with-bar-container">
        <div class="row">
            <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 main-post">
                <div class="row">
                    @foreach ($posts as $post)
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 main-post-body">
                        <a href="{{ url (Str::replace([' ','?'], '-', Str::limit($post->post_title, 50))) }} {{$post->id}} ">
                            <div class="class">
                                <div class="image-container">
                                    <img src="../images/{{$post->featured_picture}}" alt="{{ Str::limit($post->post_title, 40) }}"/>
                                </div>
                                <div class="">
                                    <h5><strong>{{ Str::limit($post->post_title, 100) }}</strong></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach    
                </div>
                {{-- {{ $posts->links() }} --}}

            </div>

            <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 side-bar">
                <div class="row">
                    @foreach ($sidebar_post1 as $sidebar_post_top)
                    <div class="col-xl-12 col-lg-12 col-md-4 col-6 side-bar-body">
                        <a href="{{ url (Str::replace([' ','?'], '-', Str::limit($sidebar_post_top->post_title, 50))) }} {{$sidebar_post_top->id}} "> 
                            <div style="">
                                <img src="../images/{{$sidebar_post_top->featured_picture}}">
                                <h5>{!! Str::limit($sidebar_post_top->post_title, 50) !!}</h5> 
                            </div>
                        </a>
                    </div>  
                    @endforeach    
                </div>
            </div>
        </div>
    </div> 
</section>

<section class="sect2">
    <div class="container-fluid home-post-with-slider-container">
        <div class="home-header">
        <hr>
        <h3 class="text-white">Business </h3>
    </div>
        <div class="my-slider">
            @foreach ($business as $business)
            <div class="slide" >
                <a href="{{ url (Str::replace([' ','?'], '-', Str::limit($business->post_title, 50))) }} {{$business->id}}"> 
                    <div class="col">
                        <div class="col-md-12 shortlet-listing-image-container">
                            <img src="images/{{$business->featured_picture}}">
                            <div class="col-12  ">
                                <h4>{{Str::limit($business->post_title, 100)}}</h4>
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

<section class="sect3">
    <div class="container-fluid  four-column-post">
        <div class="home-header">
            <hr>
            <h3>Sports</h3>
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
        
         <div class="home-header">
            <hr>
            <h3>News</h3>
        </div>
        <div class="row">
            @foreach ($news as $news)
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 four-column-post-body">
                <a href="{{ url (Str::replace(' ', '-', Str::limit($news->post_title, 50))) }} {{$news->id}}">
                    <div class="four-column-post-size">
                        <div class="four-column-post-image-container">
                            <img src="../images/{{$news->featured_picture}}" alt="{{ Str::limit($news->post_title, 80) }}" />
                        </div>
                        <div class="four-column-post-author ">
                            <span><em>
                                    By {{$news->first_name}} {{$news->last_name}}
                                </em></span>
                        </div>
                        <div class="four-column-post-content">
                            <h5><strong>{!! Str::limit($news->post_title, 70) !!}</strong></h5>
                            <h4>{!! Str::limit($news->body, 50) !!}</h4>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>   
</section>


<section class="sect4">
<div class="container-fluid five-box-post">
    <div class="home-header">
        <hr>
        <h3>Entertainment</h3>
    </div>
    <div class="row pt-3">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 box-1-post">
             <?php
                        $get_all_box = DB::table('posts')
                                ->where('status', 'Active')
                                ->where('category', 'Entertainment')
                                ->orderBy('created_at', 'DESC')
                                ->get();
                                
                                
//                        $box_1 = $get_all_box
//                                ->first();
//                        
//                        $box_2 = $get_all_box
//                                ->where('id', '!=', $box_1->id)
//                                ->first();
//                         $box_3 = $get_all_box
//                                ->where('id', '!=', $box_1->id)
//                                ->where('id', '!=', $box_2->id)
//                                ->first();
//                          $box_4 = $get_all_box
//                                ->where('id', '!=', $box_1->id)
//                                ->where('id', '!=', $box_2->id)
//                                ->where('id', '!=', $box_3->id)
//                                ->first();
//                           $box_5 = $get_all_box
//                                ->where('id', '!=', $box_1->id)
//                                ->where('id', '!=', $box_2->id)
//                                ->where('id', '!=', $box_3->id)
//                                ->where('id', '!=', $box_4->id)
//                                ->first();
                        ?>
                        

            <a href="{{ url (Str::replace([' ','?'], '-', Str::limit($box_1->post_title, 50))) }} {{$box_1->id}}"> 
                <div>
                    <img src="images/{{$box_1->featured_picture}}" height="68%">
                    <h4>{{ $box_1->post_title }}</h4>
                </div>
            </a>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 ">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-6 box-2-post">
                    
                    <a href="{{ url (Str::replace([' ','?'], '-', Str::limit($box_2->post_title, 50))) }} {{$box_2->id}}"> 
                        <div class="con1">
                            <img src="images/{{ $box_2->featured_picture}}" height="33%">
                            <h4>{{ $box_2->post_title }}</h4> 
                        </div>
                    </a>
                    <a href="{{ url (Str::replace([' ','?'], '-', Str::limit($box_3->post_title, 50))) }} {{$box_3->id}}"> 
                        <div style>
                            <img src="images/{{ $box_3->featured_picture}}" height="33%">
                            <h4>{{ $box_3->post_title }}</h4> 
                        </div>
                    </a>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-6 box-2-post">
                    <a href="{{ url (Str::replace([' ','?'], '-', Str::limit($box_4->post_title, 50))) }} {{$box_4->id}}"> 
                        <div class="con1">
                            <img src="images/{{ $box_4->featured_picture}}" height="33%">
                            <h4>{{ $box_4->post_title }}</h4> 
                        </div>
                    </a>
                    <a href="{{ url (Str::replace([' ','?'], '-', Str::limit($box_5->post_title, 50))) }} {{$box_5->id}}"> 
                        <div style>
                            <img src="images/{{ $box_5->featured_picture}}" height="33%">
                            <h4>{{ $box_5->post_title }}</h4> 
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
</section>

<section class="sect5">
<div class="container-fluid three-column-post-with-sidebar">
    <div class="home-header">
        <hr>
        <h3 class="">More from us</h3>
    </div>
    <div class="row">
        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12">
            <div class="row">
                @foreach ($last_sect as $last_sect)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 four-column-post-body">
                <a href="{{ url (Str::replace([' ','?'], '-', Str::limit($last_sect->post_title, 50))) }} {{$last_sect->id}}">
                    <div class="category">
                            <h4>{!! Str::limit($last_sect->category, 70) !!}</h4>
                    </div>
                    <div class="four-column-post-size" style="margin-top: -11px;">
                        <div class="four-column-post-image-container">
                            <img src="../images/{{$last_sect->featured_picture}}" alt="{{ Str::limit($last_sect->post_title, 80) }}" />
                        </div>
                        <div class="four-column-post-content">
                            <h5><strong>{!! Str::limit($last_sect->post_title, 70) !!}</strong></h5>
                            <h4>{!! Str::limit($last_sect->body, 70) !!}</h4>
                        </div>
                       
                    </div>
                </a>
            </div>
                @endforeach    
            </div>
        </div>

        <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 " style=" overflow-x: hidden; left:0; padding-right: 0; padding-bottom: 30px; padding-left: 10px;  z-index: 5;">
           <div>
                        <h5 class="text-center pb-2">Advertisement</h5>
                    </div>
            <div class="row">
                   
                <div class="col-xl-12 col-lg-12 col-md-4 col-6" style=" padding: 0px 5px 0px 5px; ">
                    <a href="#"> <img src="../images/advert2.jpg" width="100%" height="43%" style="margin-bottom: 20px;"/></a>
                    <a href="#">  <img src="../images/advert1.jpg" width="100%" height="43%"/></a>
                </div> 

            </div>
        </div>
    </div>
</div> 
</section>


<section class="sect3">
    <div class="container-fluid  four-column-post">
        <div class="">
            <h3>Advertisement</h3>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 four-column-post-body" style="min-height: 300px; max-height: 350px;">
                <a href="#">              
                            <img src="../images/advert2.jpg" width="100%" height="100%" style="margin-bottom: 20px;"" />                
                </a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 four-column-post-body" style="min-height: 300px; max-height: 350px;">
                <a href="#">              
                            <img src="../images/advert1.jpg" width="100%" height="100%" style="margin-bottom: 20px;"" />                
                </a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 four-column-post-body" style="min-height: 300px; max-height: 350px;">
                <a href="#">              
                            <img src="../images/advert2.jpg" width="100%" height="100%" style="margin-bottom: 20px;"" />                
                </a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 four-column-post-body" style="min-height: 300px; max-height: 350px;">
                <a href="#">              
                            <img src="../images/advert1.jpg" width="100%" height="100%" style="margin-bottom: 20px;"" />                
                </a>
            </div>
        </div>
    </div>   
</section>
<script>
$(document).ready(function () {
   
});
</script>
@endsection



