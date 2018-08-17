@extends('partials.layouts.admin')
@section('content')
<div class="columns is-centered">
    <div class="column is-10">
        @include('partials.alerts.status')
        <button title="Adicionar usuário" class="button is-fixed is-primary"><i class="fas fa-plus"></i></button>
        <div class="scrollable-table">
            <table class="table is-fullwidth">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Acesso</th>
                        <th>Criado em</th>
                        <th>Gerenciar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->hasTheRole('admin'))
                                    Administrador
                                @else
                                    Autor
                                @endif
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a href='{{ route('admin.users.activate', $user->id) }}'>{{ $user->active ? 'Desativar' : 'Ativar' }}</a> | 
                                <a href='{{ route('admin.users.password', $user->id) }}'>Gerar Senha</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Modal para registrar novo usuário --}}
<div class="modal {{ $errors->isEmpty() ? '' : 'is-active' }}">
    <div class="modal-background"></div>
    <button class="modal-close is-large"></button>
    <div class="modal-content">
        <form action="{{ route('admin.users.register') }}" method="post">
            @csrf
            <div class="card is-primary">
                <header class="card-header">
                    <p class="card-header-title is-centered">Novo usuário PROTECA</p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <div class="columns is-multiline">
                            <div class="column is-12">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Nome completo" name="name" value="{{ old('name') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-8">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="email" placeholder="E-mail" name="email" value="{{ old('email') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select name="role">
                                                <option>Nível de acesso</option>
                                                <option {{ old('role') == 'admin' ? 'selected' : '' }} value="admin">Administrador</option>
                                                <option {{ old('role') == 'author' ? 'selected' : '' }} value="author">Autor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="button is-fullwidth is-white m-b-10">Criar conta</button>
                    @include('partials.alerts.errors')
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    myFunctions.initModal('.modal', '.button.is-fixed', '.modal-close');
    myFunctions.initNotification();
</script>
@endsection