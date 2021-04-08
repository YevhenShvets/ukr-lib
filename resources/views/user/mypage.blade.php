@extends('layouts.app')

@section('title')Моя сторінка@endsection


@section('content')
<div class="container bg-light main-div">
    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" style="font-size:large;" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Улюблені</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="history-tab" style="font-size:large;" data-bs-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">Історія</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            @isset($liked)
                <div class="text-center">
                    @foreach($liked as $t)
                        <div class="card text-card" style="cursor:auto">
                            <div class="card-body p-2">
                                <div class="text-center">
                                    <a href="{{ route('author', ['id' => $t->author_id]) }}"><h5>{{ $t->author }}</h5></a>
                                </div>
                                <a href="{{ route('text', ['id' => $t->text_id]) }}"><h4 class="card-text text-card-text">{{ $t->text_name }}</h4></a>
                                <span style="color:gray; font-size: 12px;">Добавлено: {{ date('d:m:Y H:i', strtotime($t->create_date)) }}</span><br>
                                <form action="{{ route('dislikeTextMy', ['id' => $t->text_id]) }}" method="POST">
                                    @csrf
                                    <input type="text" hidden name="id_text" value="{{ $t->text_id}}">
                                    <button type="submit" class="btn btn-outline-danger" style="text-decoration:none;">Вилучити</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h1 class="text-center">Немає творів</h1>
            @endisset
        </div>
        <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
            @isset($history)
            <div class="d-flex justify-content-center">
            <div class="card m-0 p-0" style="width: 30rem">
                <div class="" style="text-align:right;">
                    <form action="{{ route('adminClearHistory') }}" method="POST">
                        @csrf
                        <input type="text" name="user_id" value="{{ Auth::id() }}" hidden>
                        <button type="submit" style="color:blue;" class="btn">
                        Видалити всю історію
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>
                        </button>
                    </form>
                </div>
                <ul class="list-group list-group-flush flex-fill m-0 mt-1">
                    @forelse($history as $h)
                            <li class="list-group-item">
                                <div class="d-flex" style="justify-content:space-between;">
                                    <div>
                                        <a href="{{ route('text', ['id' => $h->id]) }}">
                                            {{ $h->name }}
                                        </a>
                                        <div class="">{{ date('d:m:Y H:i', strtotime($h->read_date)) }}</div>
                                    </div>
                                    <div style="text-align:right;">
                                        <a href="{{ route('adminDeleteHistory', $h->rtid) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                        </a>
                                    </div>
                                </div>
                            </li>
                    @empty
                        <li class="list-group-item text-center">
                            Пусто
                        </li>
                    @endforelse
                </ul>
            </div>
            </div>
            @else
                <h1 class="text-center">Інформація відсутня</h1>
            @endisset
        </div>
    </div>
</div>
@endsection
