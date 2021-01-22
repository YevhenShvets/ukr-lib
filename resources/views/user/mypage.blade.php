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
                <ul class="list-group list-group-flush flex-fill m-0 mt-1">
                    @foreach($history as $h)
                            <li class="list-group-item">
                                <a href="{{ route('text', ['id' => $h->id]) }}">
                                    {{ $h->name }}
                                    <div class="text-right">{{ date('d:m:Y H:i', strtotime($h->read_date)) }}</div>
                                </a>
                            </li>
                    @endforeach
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
