@extends('layouts.app')

@isset($text)
    @section('title'){{ $text->name }}@endsection
@else
    @section('title')Помилка@endsection
@endisset

@section('content')
<div class="container bg-light main-div">
    @isset($text)
        <div class="text-center">
            <h1>{{ $text->name }}</h1>

            @auth()
                <div class="mt-2">
                    @isset($liked)
                        <form method="POST" action="{{ route('dislikeText', ['id' => $text->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Вилучити з улюбленого</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('likeText', ['id' => $text->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-success">Добавити в улюблене</button>
                        </form>
                    @endisset
                </div>
            @endauth
        </div>
        <div class="text" style="margin-left:15px;">
            @isset($content)
            {!! $content !!}
            @else
                <h2 style="text-align:center; color:gray;">Щось пішло не так   
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-emoji-frown" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
                </svg>
                </h2>
            @endisset
        </div>
        <div>
        @isset($pages)
        <div style="display:flex; justify-content:center; margin:30px;">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                @foreach($pages as $p)
                    <li class="page-item {{ ($page == $loop->index+1) ? 'active' : '' }}"><a class="page-link" href="{{ route('text', [$text->id, 'page' => $loop->index+1]) }}">{{ $loop->index+1 }}</a></li>

                @endforeach
            </ul>
        </nav>
        </div>
        @endisset
        </div>
    @else
        <h1>Твору не знайдено</h1>
    @endisset
</div>
@endsection
