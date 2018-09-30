@extends('partials.layouts.auth')
@section('content')
<div class="columns is-centered">
    <div class="column is-8-tablet is-4-desktop has-card-centered">
        <form action="/login" method="post">
            @csrf
            <div class="card is-primary is-centered">
                <header class="card-header">
                    <p class="card-header-title is-centered">Administração PROTECA</p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" type="email" placeholder="E-mail" name="email" value="{{ old('email') }}">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                            <small class="text-white">{{ $errors->first('email') }}</small>
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" type="password" placeholder="Senha" name="password">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-key"></i>
                                </span>
                            </div>
                            <small class="text-white">{{ $errors->first('password') }}</small>
                        </div>
                    </div>
                    <button type="submit" class="button is-fullwidth is-white">Logue na sua conta</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection