@extends('layouts.app')

@section('title')Твори@endsection


@section('content')
<div class="container bg-light main-div">
    @isset($texts)
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
            <hr class="hr">
            @foreach($texts as $t)
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
            @endforeach
        </div>
    @else
        <h1>Творів не знайдено</h1>
    @endisset
</div>
@endsection
