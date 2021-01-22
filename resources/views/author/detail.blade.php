@extends('layouts.app')

@section('title')Детальна інформація@endsection

@section('content')
<div class="container bg-light main-div">
    @isset($author)
        <div class="text-center">
            <h1 class="pt-2">{{ $author->PIB }}</h1>
            <div class="author-description">
                {!! $author->description !!}
            </div>
            <hr class="hr">
            <h3 class="mt-2">Твори автора</h3>
            <div class="">
                @isset($texts)
                    @foreach($texts as $t)
                        <a style="text-decoration:none;" href="{{ route('text', ['id' => $t->id]) }}">
                            <div class="card text-card">
                                <div class="card-body p-2">
                                    <h4 class="card-text text-card-text">{{ $t->name }}</h4>

                                    <a class="text-read" href="{{ route('text', ['id' => $t->id]) }}">Читати -></a>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endisset
            </div>
        </div>
    @else
        <div class="text-center">
            <h1>Не знайдено</h1>
        </div>
    @endisset
</div>
@endsection
