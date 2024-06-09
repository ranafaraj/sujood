@extends('layouts.app')

@section('content')


<div class="container p-3">

    <div class="row">

        <!-- Text area -->
        <div class="col-4">
            <form class="bg-white p-2 shadow rounded" action="{{ route('post.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-floating">
                    <textarea class="form-control @error('content') border border-danger @enderror" name="content" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    @error('content')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="floatingTextarea2">What's on your mind?</label>
                </div>

                <button type="submit" class="btn btn-sm btn-primary mt-3">Post</button>
            </form>
        </div>


        <!-- Feed -->
        <div class="col">

            @if ($posts->count() == 0)

            <div class="p-3 text-white shadow-sm bg-secondary rounded border">
                There are no posts yet!
            </div>

            @endif

            @if($posts->count() > 0)

                @foreach ($posts as $post)

                    <div class="card bg-white shadow border-0 mb-3">
                        <div class="card-header border-0 bg-white">
                            <div class="row">
                                <div class="col border-bottom">
                                    <div class="text-start">
                                        {{ $post->user->name }}
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="dropdown text-end">

                                        @can('update', $post)
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Options
                                            </button>
                                        @endcan
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item btn" data-bs-toggle="modal" data-bs-target="#modal_{{ $post->id }}">Edit</a></li>
                                          <li><hr class="dropdown-divider"></li>
                                          <li><a class="dropdown-item text-danger btn" data-bs-toggle="modal" data-bs-target="#delete_{{ $post->id }}">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>{{ $post->content }}</p>
                        </blockquote>

                        <hr>

                        <form action="{{ route('posts.likes', ['post' => $post, 'user' => auth()->user()->id]) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button class="btn btn-outline-primary btn-sm">
                                {{ $post->likes->contains('user_id', auth()->user()->id) ? "Unlike" : "Like" }}
                                <span class="badge text-bg-primary">{{ $post->likes->count() }}</span></button>
                        </form>
                        </div>
                    </div>
                @endforeach

            @endif

            {{ $posts->links() }}
        </div>

    </div>

    @foreach ($posts as $post)
        <!-- Edit Modal -->
        <div class="modal fade" id="modal_{{ $post->id }}" tabindex="-1" aria-labelledby="modal_{{ $post->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <form action="{{ route('post.update', $post) }}" method="POST">

                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit your post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="form-floating">
                                <textarea class="form-control @error('content') border border-danger @enderror" name="content" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{ $post->content }}</textarea>
                                @error('content')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="floatingTextarea2">Edit your post</label>
                            </div>

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                </div>
            </form>

        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="delete_{{ $post->id }}" tabindex="-1" aria-labelledby="delete_{{ $post->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this post?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('post.delete', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    @endforeach


</div>


@endsection
