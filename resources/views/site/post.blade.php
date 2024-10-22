


@extends('layouts.site.master')
@section('nav')
<nav class="tm-nav" id="tm-nav">
    <ul id="tm-nav">
        <li class="tm-nav-item "><a href="{{ route('site.home') }}" class="tm-nav-link">
            <i class="fas fa-home"></i> Blog Home
        </a></li>
        <li class="tm-nav-item active"><a href="{{ route('site.show', ['id' => App\Models\Post::inRandomOrder()->first()->id]) }}" class="tm-nav-link">
            <i class="fas fa-pen"></i> Single Post
        </a></li>

    </ul>
</nav>
@endsection
@if (!empty($post))

@section('content')
<div class="row tm-row">
    <div class="col-12">
        <hr class="tm-hr-primary tm-mb-55">
        <!-- Video player 1422x800 -->
        <img src="{{ asset('storage/images/'.$post->photo) }}" alt="Image" class="img-fluid">
    </div>
</div>
<div class="row tm-row">
    <div class="col-lg-8 tm-post-col">
        <div class="tm-post-full">
            <div class="mb-4">
                <h2 class="pt-2 tm-color-primary tm-post-title">{{ $post->post_title }}</h2>
                <p class="tm-mb-40"> {{ $post->created_at->format('F j, Y')  }} posted by {{ $post->user->name }}</p>
                <p> {{ $post->content }}</p>


            </div>

            <!-- Comments -->
            <div>
                <h2 class="tm-color-primary tm-post-title">Comments</h2>
                <hr class="tm-hr-primary tm-mb-45">
                @if ($post->comments->isEmpty())
                <div style="text-align: center; margin: 20px; padding: 10px; border: 1px solid #009899; background-color: #efecec;">
                    <h3 style="color: #009899; font-weight: bold;">
                        No Comments
                    </h3>
                </div>
                @endif
                @foreach ($post->comments as $comment)

                <div class="tm-comment tm-mb-45">
                    <figure class="tm-comment-figure">
                        <img src="{{ asset('storage/images/'.$comment->user->profile->image) }}"
                        alt="Image"
                        class="mb-2 rounded-circle img-thumbnail"
                        style="width: 100px; height: 100px; object-fit: cover; border: 2px solid #ccc;">

                        <figcaption class="tm-color-primary text-center">{{ $comment->user->name }}</figcaption>
                    </figure>
                    <div>
                        <p>
                            {{ $comment->comment }}
                        </p>
                        <div class="d-flex justify-content-between">

                            <span class="tm-color-primary">{{ $comment->created_at->format('F j, Y')  }}</span>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>
    <aside class="col-lg-4 tm-aside-col">
        <div class="tm-post-sidebar">

            <hr class="mb-3 tm-hr-primary">
            <h2 class="tm-mb-40 tm-post-title tm-color-primary">Related Posts</h2>
            @foreach ($posts as $post)

            <a href="{{ route('site.show',$id=$post->id) }}" class="d-block tm-mb-40">
                <figure>
                    <img src="{{ asset('storage/images/'.$post->photo) }}" alt="Image" class="mb-3 img-fluid">
                    <figcaption class="tm-color-primary">{{ Illuminate\Support\Str::limit($post->content,40) }}</figcaption>
                </figure>
            </a>
            @endforeach

        </div>
    </aside>
</div>





@endsection

@endif
