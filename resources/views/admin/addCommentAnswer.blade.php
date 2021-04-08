@extends('layouts.app')

@section('title')Добавлення відповіді на запитання@endsection

@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   
<div class="container main-div bg-light">
@isset($comments)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ім'я</th>
                <th scope="col">Email</th>
                <th scope="col">Запитання</th>
                <th scope="col">Дата</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @forelse($comments as $comment)
            <tr>
            <th scope="row">{{ $comment->id }}</th>
            <td>{{ $comment->user_name }}</td>
            <td>{{ $comment->user_email }}</td>
            <td>
                <div  class="overflow-auto" style="max-height:100px;">
                {{ $comment->user_message }}
                </div>
            </td>
            <td>{{ $comment->created_at }}</td>
            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#answerModal" data-whatever="{{ $comment->id }}">Відповісти</button></td>
            </tr>
        @empty
        <tr>
        <td class="text-center" colspan="6"> 
            Пусто
        </td>
        </tr>
        @endforelse
        </tbody>
    </table>
@else
    <p class="text-center">Пусто</p>
@endisset
</div>

<div class="modal fade" id="answerModal" tabindex="-1" role="dialog" aria-labelledby="answerModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="answerModalLabel">Відповідь на запитання</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('addCommentsAnswerSubmit') }}" method="POST">
            @csrf
            <div class="form-group m-0 p-0" hidden>
                <label for="comment_id" class="col-form-label">Id:</label>
                <input type="text" class="form-control" name="comment_id" id="comment_id">
            </div>

            <div class="form-group m-0 p-0">
                <label for="user_name" class="col-form-label">Відповідь</label>
                <textarea class="form-control" name="message" id="message" placeholder="Відповідь" required=""></textarea>
            </div>

            <div style="text-align:center;">
                <input type="submit" value="Відправити" class="btn btn-success">
            </div>
        </form>
        </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#answerModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) ;
            var id = button.data('whatever');
            var modal = $(this);
            modal.find('.modal-body #comment_id').val(id);
        });
    });
</script>
@endsection
