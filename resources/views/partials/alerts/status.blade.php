@if (session('status'))
    <div class="notification is-inverse">
        <button type="button" class="delete"></button>
        {!! session('status') !!}
    </div>
@endif