@extends($templateLayout)

@section('page-title',$title)

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h3 class="pb-4 mb-4  border-bottom">
                {{ $title }}
            </h3>
        @if(isset(request()->category))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-0">
                    <li class="breadcrumb-item"><a href="#">@lang('site.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('blog') }}">@lang('site.blog')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
            @endif

        @foreach($posts as $post)
                <div class="blog-post">
                    <h2 class="blog-post-title"><a href="{{ route('blog.post',['blogPost'=>$post->id]) }}">{{ $post->title }}</a></h2>
                    <p class="blog-post-meta">{{  \Carbon\Carbon::parse($post->publish_date)->format('d M, Y') }}
                        @if($post->user()->exists())
                            @lang('site.by') <a href="#">{{ $post->user->name }}</a>
                        @endif
                    </p>

                    @if(!empty($post->cover_photo))
                        <a href="{{ route('blog.post',['blogPost'=>$post->id]) }}"><img src="{{ asset($post->cover_photo) }}" class="img-fluid img-thumbnail" ></a>
                    @endif

                    <p class="int_hpw">
                        {!! clean( $post->content ) !!}
                    </p>


                </div><!-- /.blog-post -->
            @endforeach

            {!! clean( $posts->appends(['q' => Request::get('q'),'category' => Request::get('category')])->render() ) !!}

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
