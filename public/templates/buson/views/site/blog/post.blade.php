@extends($templateLayout)

@section('page-title',$blogPost->title)
@section('inline-title',$blogPost->title)
@section('crumb')
    <span><a href="@route('blog')">@lang('site.blog')</a></span>
    <span>/</span>
    <span>@lang('site.blog-post')</span>
@endsection
@section('content')
    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        @if(!empty($blogPost->cover_photo))
                        <div class="feature-img">
                            <img class="img-fluid" src="{{ asset($blogPost->cover_photo) }}" alt="">
                        </div>
                        @endif
                        <div class="blog_details">
                            <h2>{{ $blogPost->title }}
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                @if($blogPost->user()->exists())
                                <li><a href="#"><i class="fa fa-user"></i>{{ $blogPost->user->name }}</a></li>
                                @endif
                             </ul>
                            <p>{!! clean( $blogPost->content ) !!}</p>
                        </div>
                    </div>

                    @if(!empty(setting('general_disqus_shortcode')))
                        <div class="comments-area">
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
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form method="get" action="{{ route('blog') }}">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input  name="q"  type="text" class="form-control" placeholder='@lang('site.search')'
                                                onfocus="this.placeholder = ''"
                                                onblur="this.placeholder = '@lang('site.search')'">
                                        <div class="input-group-append">
                                            <button class="btns" type="submit"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                        type="submit">@lang('site.search')</button>
                            </form>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">@lang('site.category')</h4>
                            <ul class="list cat-list">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="#" class="d-flex">
                                            <p>{{ $category->name }}</p>
                                            <p>&nbsp;({{ $category->blogPosts()->count() }})</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">{{ __t('recent-posts') }}</h3>
                            @foreach(\App\BlogPost::whereDate('publish_date','<=',\Illuminate\Support\Carbon::now()->toDateTimeString())->where('status',1)->orderBy('publish_date','desc')->limit(5)->get() as $post)
                                <div class="media post_item">
                                    @if(!empty($post->cover_photo))
                                        <img class="recent-blog-img" src="{{ asset($post->cover_photo) }}" alt="">
                                    @endif
                                    <div class="media-body">
                                        <a href="{{ route('blog.post',['blogPost'=>$post->id]) }}">
                                            <h3>{{ $post->title }}</h3>
                                        </a>
                                        <p>{{  \Carbon\Carbon::parse($post->publish_date)->format('F d, Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </aside>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Blog Area end =================-->


@endsection
