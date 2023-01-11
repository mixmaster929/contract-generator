@extends($templateLayout)

@section('page-title',(!empty($article->meta_title))? $article->meta_title:$article->title)
@section('meta-description',$article->meta_description)

@section('content')

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">{{ $article->title }}</h2>
            <p class="az-dashboard-text">{!! clean( $article->content ) !!}</p>
        </div>
    </div><!-- az-dashboard-one-title -->


@endsection
