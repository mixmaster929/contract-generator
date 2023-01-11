@extends($templateLayout)

@section('page-title',$blogPost->title)

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h3 class="pb-4 mb-4  border-bottom">
                @lang('site.blog')
            </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-0">
                        <li class="breadcrumb-item"><a href="#">@lang('site.home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blog') }}">@lang('site.blog')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $blogPost->title }}</li>
                    </ol>
                </nav>


                 <div class="blog-post">
                    <h2 class="blog-post-title">{{ $blogPost->title }}</h2>
                    <p class="blog-post-meta">{{  \Carbon\Carbon::parse($blogPost->publish_date)->format('d M, Y') }}
                        @if($blogPost->user()->exists())
                            @lang('site.by') <a href="#">{{ $blogPost->user->name }}</a>
                        @endif
                    </p>

                    @if(!empty($blogPost->cover_photo))
                        <img src="{{ asset($blogPost->cover_photo) }}" class="img-fluid img-thumbnail" >
                    @endif

                    <p class="int_hpw">
                        {!! clean( $blogPost->content ) !!}
                    </p>


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



                </div><!-- /.blog-post -->

        </div>
        <div class="col-md-4">
            <div class="p-4 mb-3 bg-light rounded">
                <form method="get" action="{{ route('blog') }}">
                    <input class="form-control rounded" type="text" name="q" placeholder="@lang('site.search')"/>
                </form>
            </div>

            <div class="p-4">
                <h4>@lang('site.categories')</h4>
                <ol class="list-unstyled mb-0">
                    @foreach($categories as $category)
                        <li><a href="{{ route('blog') }}?category={{ $category->id }}">{{ $category->name }}</a></li>
                    @endforeach

                </ol>
            </div>

        </div>
    </div>


@endsection
