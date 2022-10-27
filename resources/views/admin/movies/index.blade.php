
@extends('admin.layouts.base')

@section('title', 'Movies')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Movies</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('admin.movies.create') }}" class="btn btn-primary">Create Movie</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table id="movie-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Thumbnail</th>
                                <th>Categories</th>
                                <th>Casts</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movies as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            <img src="{{ asset('storage/thumbnails/' . $item->small_thumbnail) }}" alt="Thumbnail Movie" width="50%" style="max-height: 170px" class="img-thumbnail">
                                        </td>
                                        <td>{{ $item->categories }}</td>
                                        <td>{{ $item->casts }}</td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $('#movie-table').DataTable();
    </script>
@endsection