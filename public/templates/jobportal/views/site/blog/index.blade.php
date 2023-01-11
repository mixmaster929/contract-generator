@extends($templateLayout)

@section('page-title',$title)
@section('inline-title',$title)
@section('crumb')
    <li>{{ $title }}</li>
@endsection
@section('content')
    <!-- Start Blog Singel Area -->
    <section class="section latest-news-area blog-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="row">
                        @foreach($posts as $post)
                        <div class="col-lg-6 col-12">
                            <!-- Single News -->
                            <div class="single-news wow fadeInUp" data-wow-delay=".3s">
                                @if(!empty($post->cover_photo))
                                <div class="image">
                                    <img class="thumb" src="{{ asset($post->cover_photo) }}" >
                                </div>
                                @endif
                                <div class="content-body">
                                    <h4 class="title"><a href="{{ route('blog.post',['blogPost'=>$post->id]) }}">{{ $post->title }}</a></h4>
                                    <div class="meta-details">
                                        <ul>
                                            <li><a href="#"><i class="lni lni-calendar"></i> {{  \Carbon\Carbon::parse($post->publish_date)->format('F d, Y') }}</a></li>
                                            @if($post->user)
                                                <li><a href="#"><i class="lni lni-user"></i> {{ $post->user->name }}</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <p>{{ limitLength(strip_tags($post->content),200) }}</p>
                                    <div class="button">
                                        <a href="{{ route('blog.post',['blogPost'=>$post->id]) }}" class="btn">{{ __t('read-more') }}</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single News -->
                        </div>
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    <div class="pagination center">
                        {!!  $posts->appends(['q' => Request::get('q'),'category' => Request::get('category')])->links('jobportal.views.partials.paginator')  !!}
                    </div>
                    <!--/ End Pagination -->
                </div>
                <aside class="col-lg-4 col-md-5 col-12">
                    <div class="sidebar">
                        <div class="widget search-widget">
                            <h5 class="widget-title"><span>@lang('site.search')</span></h5>
                            <form method="get" action="{{ route('blog') }}">
                                <input type="text" placeholder="@lang('site.search')">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <div class="widget categories-widget">
                            <h5 class="widget-title"><span>@lang('site.categories')</span></h5>
                            <ul class="custom">
                                @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('blog') }}?category={{ $category->id }}">{{ $category->name }}<span>{{ $category->blogPosts()->count() }}</span></a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget popular-feeds">
                            <h5 class="widget-title"><span>{{ __t('recent-posts') }}</span></h5>
                            <div class="popular-feed-loop">
                                @foreach(\App\BlogPost::whereDate('publish_date','<=',\Illuminate\Support\Carbon::now()->toDateTimeString())->where('status',1)->orderBy('publish_date','desc')->limit(5)->get() as $post)

                                <div class="single-popular-feed">
                                    <div class="feed-desc">
                                        <h6 class="post-title"><a href="{{ route('blog.post',['blogPost'=>$post->id]) }}">{{ $post->title }}</a></h6>
                                        <span class="time"><i class="lni lni-calendar"></i> {{  \Carbon\Carbon::parse($post->publish_date)->format('F d, Y') }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </aside>
            </div>
        </div>
    </section>
    <!-- End Blog Singel Area -->

@endsection
