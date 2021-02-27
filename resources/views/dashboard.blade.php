@extends('layouts.app')

@section('content')    
    <a href="{{ route('movies.create') }}" class="btn btn-outline-info ml-5">
        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width:1em" ><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" class=""></path></svg>
        Cadastrar Filme
    </a>
    <section class="py-5 flix-parents">
        <div class="flickfeed video-list-slider pl-5">
            
            @foreach ($movies as $movie)
                <article class="card" style="background-image: url('{{ $movie->getFirstMediaUrl() != '' ? $movie->getFirstMediaUrl() : "https://images.unsplash.com/photo-1593488239201-b6932a52f60b?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ"  }}');">
                    <div class="back p-4 back d-flex flex-column justify-content-end">
                        <h1 class="h4">{{ $movie->title }}</h1>
                        <p class="Episode">{{ Str::limit($movie->description, 70) }}</p>
                        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-outline-info mt-3">Ver detalhes</a>
                    </div>
                </article>                    
            @endforeach

        </div>
    </section>
@endsection