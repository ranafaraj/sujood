@extends('layouts.app')

@section('content')


<div class="container bg-white p-3">

    <div class="row">

        <!-- Text area -->
        <div class="col">
            <form action="{{ route('post.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-floating">
                    <textarea class="form-control @error('content') border border-danger @enderror" name="content" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    @error('content')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="floatingTextarea2">Whats on your mind?</label>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Post</button>


            </form>
        </div>


        <!-- Feed -->
        <div class="col">

            @if ($posts->count() == 0)

            <div class="p-3 text-white bg-secondary rounded border">
                There are no posts yet!
            </div>

            @endif

            @if($posts->count() > 0)

                @foreach ($posts as $post)

                    <div class="card my-3">
                        <div class="card-header">
                        {{ $post->user->name }}
                        </div>
                        <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>{{ $post->content }}</p>
                        </blockquote>

                        <hr>

                        <form action="{{ route('posts.likes', ['post' => $post, 'user' => auth()->user()->id]) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button class="btn btn-outline-primary btn-sm">Like <span class="badge text-bg-primary">{{ $post->likes->count() }}</span></button>
                        </form>
                        </div>
                    </div>
                @endforeach

            @endif





        </div>

    </div>

</div>


@endsection
