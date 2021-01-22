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
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h1>Творів не знайдено</h1>
    @endisset
</div>
@endsection
