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
            @endauth()
        </div>
        <div class="text" style="margin-left:15px;">
            {!! $text->value !!}
        </div>
    @else
        <h1>Твору не знайдено</h1>
    @endisset
</div>
@endsection
