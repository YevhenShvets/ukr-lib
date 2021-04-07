@extends('layouts.app')

@section('title')Популярні твори@endsection


@section('content')
<div class="container bg-light main-div">
    @isset($texts)
        <div class="text-center">
            @foreach($texts as $t)
                <div class="card text-card" style="cursor:auto">
                    <div class="card-body p-2">
                        <div class="text-center">
                            <a href="{{ route('author', ['id' => $t->author_id]) }}"><h5>{{ $t->author }}</h5></a>
                        </div>
                        <h4 class="card-text text-card-text">{{ $t->text_name }}</h4>
                        <p style="text-align:right; color:#242240; font-size: 12px; padding:0;">рейтинг: {{ $t->rating }}</p>
                        <div class="text-center">
                            <a class="text-read" style="text-decoration:none;" href="{{ route('text', ['id' => $t->text_id]) }}">Читати -></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h1>Творів не знайдено</h1>
    @endisset
</div>
@endsection
