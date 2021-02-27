@extends('layouts.app')

@section('content')
    <div class='container ml-5 p-0 h-100 mb-5 mt-5'>
        
        <a href="{{ route('dashboard') }}" class='btn btn-outline-info mb-2'>
            <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"  style="width:1em"><path fill="currentColor" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z" class=""></path></svg>
            Voltar
        </a>
        <div style="background-image: url('{{ $movie->getFirstMediaUrl() != '' ? $movie->getFirstMediaUrl() : "https://images.unsplash.com/photo-1593488239201-b6932a52f60b?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ"  }}'); background-size: cover;
    background-repeat: no-repeat; width: 100%; height: 30em";  ></div>
        
        <h1 class='mt-2'>{{ $movie->title }}</h1>
        <p>{{ $movie->description }}</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif  


        <form id="form-create" method="post" action="{{ route('comments.store') }}" class="mt-5">
            @csrf
            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
            <div class="form-group">
                <h4 class='text-muted'>Comentar</h4>
                <textarea class="form-control" name="content" rows="3"></textarea>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success">Enviar comentário</button>
            </div>
        </form>

        <form id="form-edit" method="post" action="" class="mt-5" style="display:none">
            @csrf
            @method('put')
            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
            <div class="form-group">
                <h4 class='text-muted'>Editar Comentário</h4>
                <textarea class="form-control" name="content" rows="3"></textarea>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success">Salvar edição</button>
            </div>
        </form>

        <h4 class="text-muted mt-4">Comentários</h4>
        @foreach ($movie->comments as $comment)
            <div class="card bg-dark p-2 mt-2">
                @if ($comment->user_id == auth()->user()->id)        
                    <button onclick="edit(this, {{ $comment->id }})" style="position: absolute; top: 0; right: 0; width: 2em; border: 0" class="bg-transparent text-primary"><svg aria-hidden="true" class='shadow' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z" class=""></path></svg></button>                    
                @endif
                <p class="m-2">{{ $comment->content }}</p>
                
                <span class='text-muted m-1' style="position: absolute; bottom: 0; right: 0; font-size:.7em">
                    {{ $comment->created_at->diffForHumans() }}
                </span>
            </div>
        @endforeach
    </div>
@endsection

@section('js')
    <script>
        function edit(commentDiv, id) {
            comment = $(commentDiv).parent().find('p')[0].innerText;
            $('#form-edit').show();
            $('#form-create').hide();
            $('#form-edit textarea[name="content"]').val(comment);
            $('#form-edit').attr('action', "{{ url('/comments') }}"+'/'+id);
        }
    </script>
@endsection

