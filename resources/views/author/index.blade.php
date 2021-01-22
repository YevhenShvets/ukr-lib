@extends('layouts.app')

@section('title')Автори@endsection

@section('content')
<div class="container bg-light main-div">
    @isset($authors)
        <div class="text-center d-flex justify-content-center">
            @foreach($authors as $a)
                <a href="{{ route('author',['id' => $a->id]) }}">
                    <div class="card author-card flex-fill">
                        @isset($a->photo1)
                            <img src="data:image/png;base64,{{ chunk_split(base64_encode($a->photo1)) }}" class="card-img-top author-img">
                        @endisset
                        <div class="card-body">
                            <p class="card-text" style="height:80px;">
                            {{ $a->PIB }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endisset
</div>
@endsection
