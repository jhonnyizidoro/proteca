@extends('partials.layouts.admin')
@section('content')
<div class="columns is-centered is-multiline is-mobile">
    <div class="column is-8 is-offset-2">
        @include('partials.alerts.status')
    </div>
    <div class="column is-2"></div>
    <div class="column is-10-mobile is-4-desktop is-5-tablet is-3-fullhd">
        <form action="{{ route('admin.profile.update') }}" method="post">
            @csrf
            <div class="field">
                <div class="control has-icons-left">
                    <input class="input" type="text" name="name" value="{{ old('name', auth()->user()->name) }}">
                    <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
            <div class="field">
                <div class="control has-icons-left">
                    <input class="input" type="password" name="password" placeholder="Nova senha">
                    <span class="icon is-small is-left">
                        <i class="fas fa-unlock-alt"></i>
                    </span>
                </div>
                <small class="text-danger">{{ $errors->first('password') }}</small>
            </div>
            <div class="field">
                <div class="control has-icons-left">
                    <input class="input" type="password" name="password_confirmation" placeholder="Confirme a senha">
                    <span class="icon is-small is-left">
                        <i class="fas fa-unlock-alt"></i>
                    </span>
                </div>
            </div>
            <div class="field">
                <div class="control has-icons-left">
                    <input class="input" type="password" name="current_password" placeholder="Senha atual">
                    <span class="icon is-small is-left">
                        <i class="fas fa-key"></i>
                    </span>
                </div>
                <small class="text-danger">{{ $errors->first('current_password') }}</small>
            </div>
            <button type="submit" class="button is-fullwidth is-primary">Salvar alterações</button>
        </form>
        <span class="info m-t-15">A alteração da senha é opcional, caso queira alterar apenas seu nome, deixe os campos de senha em branco.</span>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', ()=> {
        notification.initNotification();
    });
</script>
@endsection