@extends('layouts.app')

@section('title')Твори@endsection


@section('content')
<div class="container bg-light main-div">
        <div class="text-center">
            <div class="row justify-content-center align-items-center p-3">
                <div class="input-group" style="display: flex; align-items: center; justify-content: center;">
                    <div class="form-outline">
                        <form action="{{ route('search') }}" method="POST">
                            @csrf
                            <input type="search" id="form1" name="search_text" placeholder="Введіть твір або автора" class="form-control form-control-lg" required/>
                            <button type="submit" class="btn btn-primary btn-sm mt-1">Пошук</button>
                        </form>
                    </div>
                </div>
            </div>
            @isset($types)
            <div class="accordion" id="accordionExample" style="padding:0;">
                <div class="card" style="background:rgba(0,0,0,0.05); padding:0;">
                    <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link" style="text-decoration:none; color:black; font-size:20px; padding:0;" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Більше пошуку
                        </button>
                    </h2>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <div>
                            @forelse($types as $t)
                            <a href="{{ route('texts', ['type' => $t->name]) }}">#{{ $t->name}}</a>
                            @empty
                            <p style="text-align:center">Пусто :(</p>
                            @endforelse
                        </div>
                        <hr>
                        <div>
                        <a href="{{ route('popular') }}" style="margin: 0 auto; border-radius: 15px; font-size:15px; padding:10px 20px; background:rgba(12,34,255,0.5); color:black; width:min-content;">#Популярні</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            @endisset
        @isset($texts)
            <hr class="hr">
            @forelse($texts as $t)
                <div class="card text-card" style="cursor:auto">
                    <div class="card-body p-2">
                        <div class="text-center">
                            <a href="{{ route('author', ['id' => $t->author_id]) }}"><h5>{{ $t->author }}</h5></a>
                        </div>
                        <h4 class="card-text text-card-text">{{ $t->text_name }}</h4>
                        <h6 style="color:gray; ">{{ $t->type_name }}</h6>
                        <div class="text-center">
                            <a class="text-read" style="text-decoration:none;" href="{{ route('text', ['id' => $t->text_id]) }}">Читати -></a>
                        </div>
                        @auth('admin')
                        <hr>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('adminEditText', $t->text_id) }}" style="color:orange;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>
                            <a href="{{ route('adminDeleteText', ['id' => $t->text_id]) }}" style="color:red; margin-left:20px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>
            @empty
            <h2 class="text-center">Пусто </h2>
            @endforelse
        </div>
    @else
    @isset($popular)
    <hr class="hr">
        <div class="text-center">
            @foreach($popular as $t)
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
    @endisset
</div>
@endsection
