@extends($templateLayout)

@section('page-title',(!empty($article->meta_title))? $article->meta_title:$article->title)
@section('meta-description',$article->meta_description)
@section('inline-title',$article->title)
@section('crumb')
    <li>{{ $article->title }}</li>
@endsection
@section('content')




    <section class="about-us section pb-130 pt-50">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                        {!! clean( $article->content ) !!}

                    <!-- about content -->
                </div>
            </div> <!-- row -->
        </div>
    </section>





@endsection
