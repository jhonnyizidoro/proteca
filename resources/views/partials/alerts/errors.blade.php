@if (!$errors->isEmpty())
    <div class="notification is-danger">
        <button type="button" class="delete"></button>
        @foreach($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif