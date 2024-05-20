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



            <div class="card my-3">
                <div class="card-header">
                  Quote
                </div>
                <div class="card-body">
                  <blockquote class="blockquote mb-0">
                    <p>A well-known quote, contained in a blockquote element.</p>
                    <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                  </blockquote>

                  <hr>

                  <button class="btn btn-outline-primary">Like <span class="badge text-bg-primary">2</span></button>
                </div>
            </div>




        </div>

    </div>

</div>


@endsection
