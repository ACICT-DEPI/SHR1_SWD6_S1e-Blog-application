@extends('layouts.site.master')
@section('nav')
<nav class="tm-nav" id="tm-nav">
    <ul id="tm-nav">
        <li class="tm-nav-item active"><a href="{{ route('site.home') }}" class="tm-nav-link">
            <i class="fas fa-home"></i> Blog Home
            </a></li>
            <li class="tm-nav-item"><a href="{{ route('site.show',['id'=>1]) }}" class="tm-nav-link">
            <i class="fas fa-pen"></i> Single Post
            </a></li>
                
    </ul>
</nav>
@endsection
@section('content')

<div class="row tm-row">
    @foreach ($posts as $post)

    <article class="col-12 col-md-6 tm-post">
        <hr class="tm-hr-primary">
        <a href="{{ route('site.show',$id=$post->id) }}" class="effect-lily tm-post-link tm-pt-20">
            <div class="tm-post-link-inner">
                <img src="{{ asset('storage/images/'.$post->photo) }}" alt="Image" class="img-fluid">
            </div>
            <h2 class="tm-pt-30 tm-color-primary tm-post-title">{{ $post->post_title }}</h2>
        </a>
        <p class="tm-pt-30">
            {{ Illuminate\Support\Str::limit($post->content,200) }}
        </p>
        <div class="d-flex justify-content-between tm-pt-45">

            <span class="tm-color-primary">{{ $post->created_at->format('F j, Y') }}</span>
        </div>
        <hr>

        <div class="d-flex justify-content-between">
            <span>{{ count($post->comments) }} comments</span>
            <span>{{ $post->user->name }}</span>
        </div>
    </article>
    @endforeach


</div>
@endsection
@section('pagination')
{{ $posts->links() }}

@endsection
