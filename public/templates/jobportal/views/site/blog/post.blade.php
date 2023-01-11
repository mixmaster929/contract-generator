@extends($templateLayout)

@section('page-title',$blogPost->title)
@section('inline-title',$blogPost->title)
@section('crumb')
    <li><a href="@route('blog')">@lang('site.blog')</a></li>
    <li>@lang('site.blog-post')</li>
@endsection
@section('content')
    <!-- Start Blog Singel Area -->
    <section class="section blog-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-inner">
                        @if(!empty($blogPost->cover_photo))
                            <div class="post-thumbnils">
                                <img src="{{ asset($blogPost->cover_photo) }}" >
                            </div>
                        @endif
                        <div class="post-details">
                            <div class="detail-inner">
                                <h2 class="post-title">
                                    <a href="#">{{ $blogPost->title }}</a>
                                </h2>
                                <!-- post meta -->
                                <ul class="custom-flex post-meta">
                                    <li>
                                        <a href="#">
                                            <i class="lni lni-calendar"></i>
                                            {{  \Carbon\Carbon::parse($blogPost->publish_date)->format('F d, Y') }}
                                        </a>
                                    </li>
                                    @if($blogPost->user)
                                        <li>
                                            <a href="#">
                                                <a href="#"><i class="lni lni-user"></i> {{ $blogPost->user->name }}</a>
                                            </a>
                                        </li>
                                        @endif
                                        </li>
                                </ul>

                                <p>{!! clean( $blogPost->content ) !!}</p>
                            </div>
                            <!-- Comments -->
                            @if(!empty(setting('general_disqus_shortcode')))
                                <div class="comment-form">
                                    <div id="disqus_thread"></div>
                                    <script>
                                        /**
                                         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                                         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                                        /*
                                        var disqus_config = function () {
                                        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                                        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                                        };
                                        */
                                        (function() { // DON'T EDIT BELOW THIS LINE
                                            var d = document, s = d.createElement('script');
                                            s.src = 'https://{{ trim(setting('general_disqus_shortcode')) }}.disqus.com/embed.js';
                                            s.setAttribute('data-timestamp', +new Date());
                                            (d.head || d.body).appendChild(s);
                                        })();
                                    </script>
                                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

                                </div>
                            @endif
                        </div>
                    </div>
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
