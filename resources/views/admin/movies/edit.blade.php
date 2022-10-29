
@extends('admin.layouts.base')

@section('title', 'Movies');

@section('content')
<div class="row">
    <div class="col-md-12">

        {{-- Alert Here --}}

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Movie</h3>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{ route('admin.movies.update', $movie->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $movie->title }}" placeholder="e.g Guardian of The Galaxy">
                        <p class="text-danger">{{ $errors->first('title') }}</p>
                    <div class="form-group">
                        <label for="trailer">Trailer</label>
                        <input type="text" class="form-control" id="trailer" name="trailer" value="{{ $movie->trailer }}" placeholder="Video url">
                        <p class="text-danger">{{ $errors->first('trailer') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="movie">Movie</label>
                        <input type="text" class="form-control" id="movie" name="movie" value="{{ $movie->movie }}" placeholder="Movie url">
                        <p class="text-danger">{{ $errors->first('movie') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" class="form-control" id="duration" name="duration" value="{{ $movie->duration }}" placeholder="1h 39m">
                        <p class="text-danger">{{ $errors->first('duration') }}</p>
                    </div>
                    <div class="form-group">
                        <label>Date:</label>
                        <div class="input-group date" id="release-date" data-target-input="nearest">
                            <input type="text" name="release_date" class="form-control datetimepicker-input" value="{{ $movie->release_date }}" data-target="#release-date"/>
                            <div class="input-group-append" data-target="#release-date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <p class="text-danger">{{ $errors->first('release_date') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="short-about">Casts</label>
                        <input type="text" class="form-control" id="short-about" name="casts" value="{{ $movie->casts }}" placeholder="Jackie Chan">
                        <p class="text-danger">{{ $errors->first('casts') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="short-about">Categories</label>
                        <input type="text" class="form-control" id="short-about" name="categories" value="{{ $movie->categories }}" placeholder="Action, Fantasy">
                        <p class="text-danger">{{ $errors->first('categories') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="small-thumbnail">Small Thumbnail</label>
                        <input type="file" class="form-control" name="small_thumbnail">
                        <p class="text-danger">{{ $errors->first('small_thumbnail') }}</p>
                        <img src="{{ asset('storage/thumbnails/' . $movie->small_thumbnail) }}" alt="" width="100px">
                    </div>
                    <div class="form-group">
                        <label for="large-thumbnail">Large Thumbnail</label>
                        <input type="file" class="form-control" name="large_thumbnail">
                        <p class="text-danger">{{ $errors->first('large_thumbnail') }}</p>
                        <img src="{{ asset('storage/thumbnails/' . $movie->large_thumbnail) }}" alt="" width="200px">
                    </div>
                    <div class="form-group">
                        <label for="short-about">Short About</label>
                        <input type="text" class="form-control" id="short-about" name="short_about" value="{{ $movie->short_about }}" placeholder="Awesome Movie">
                        <p class="text-danger">{{ $errors->first('short_about') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="short-about">About</label>
                        <input type="text" class="form-control" id="about" name="about" value="{{ $movie->about }}" placeholder="Awesome Movie">
                        <p class="text-danger">{{ $errors->first('about') }}</p>
                    </div>
                    <div class="form-group">
                        <label>Featured</label>
                        <select class="custom-select" name="featured">
                            <option value="0" {{ $movie->featured == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $movie->featured == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                        <p class="text-danger">{{ $errors->first('featured') }}</p>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(function () {
            $('#release-date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        });
    </script>
@endsection