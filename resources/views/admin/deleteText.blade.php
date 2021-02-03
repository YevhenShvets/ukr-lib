@extends('layouts.app')

@section('title')Вилучення тексту@endsection

@section('content')
<div class="container main-div">
    <div class="row justify-content-center">
        <div class="col-md-8" style="">
            <div class="card" style="background-color: rgba(255,205,255,0.9);">
                <div class="card-header text-center bg-secondary" style="font-size: 22px">{{ __('Форма для вилучення твору') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('adminDeleteTextSubmit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="text" class="col-md-4 col-form-label text-md-right">{{ __('Твір') }}</label>

                            <div class="col-md-6">
                                <select id="text" class="form-control form-select @error('text') is-invalid @enderror" name="text" required>
                                    @foreach($texts as $text)
                                        <option value="{{ $text->text_id }}">{{ $text->text_name }}</option>
                                    @endforeach 
                                </select>
                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Вилучити') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
