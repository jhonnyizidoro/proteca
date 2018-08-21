@extends('partials.layouts.admin')
@section('content')

<div class="container">
    @include('partials.alerts.status')
    <button title="Adicionar uma pessoa" class="button is-fixed is-primary"><i class="fas fa-plus"></i></button>
    <div class="columns">
        <div class="column is-6">
            <div class="is-divider" data-content="Quem somos"></div>
            <div class="columns">
                @foreach ($members as $member)
                    <div class="column is-6">
                        <div class="card is-person">
                            <div class="card-image">
                                <figure class="image is-1by1">
                                    <img src="/storage/{{ $member->image }}" alt="{{ $member->name }}">
                                </figure>
                            </div>
                            <div class="card-content">
                                <p class="title"><a class="quickview-trigger" data-target="quickview-{{ $member->id }}">{{ $member->name }}</a></p>
                                <div class="content">
                                    
                                </div>
                            </div>
                            <div id="quickview-{{ $member->id }}" class="quickview">
                                <header class="quickview-header">
                                    <p class="title">{{ $member->name }}</p>
                                    <span class="delete"></span>
                                </header>
                                <div class="quickview-body">
                                    <div class="quickview-block">
                                        {{ $member->presentation }}
                                    </div>
                                </div>
                                  
                                <footer class="quickview-footer">
                                    <a href="/">Excluir</a>
                                </footer>
                            </div>                                  
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="column is-6">
            <div class="is-divider" data-content="Parceiros"></div>
        </div>
    </div>
</div>
{{-- Modal para registrar novo usuário --}}
<div class="modal {{ $errors->isEmpty() ? '' : 'is-active' }}">
    <div class="modal-background"></div>
    <button class="modal-close is-large"></button>
    <div class="modal-content">
        <form action="{{ route('admin.people.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card is-primary">
                <header class="card-header">
                    <p class="card-header-title is-centered">Adicionar uma nova pessoa</p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <div class="columns is-multiline">
                            <div class="column is-12">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Nome de exibição" name="name" value="{{ old('name') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-12">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="email" placeholder="E-mail para contato" name="email" value="{{ old('email') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-8">
                                <div class="file is-fullwidth ">
                                    <label class="file-label">
                                        <input class="file-input" accept=".jpeg,.png,.jpg" type="file" name="image">
                                        <span class="file-cta">
                                            <span class="file-icon"><i class="fas fa-upload"></i></span>
                                            <span class="file-label">Escolha uma imagem para exibição</span>
                                        </span>
                                    </label>
                                </div>
                                @if (!$errors->isEmpty() && !$errors->has('image'))
                                    <small class="text-white">Não se esqueça de selecionar o arquivo novamente.</small>
                                @elseif (!$errors->isEmpty() && $errors->has('image'))
                                    <small class="text-white">Clique no botão acima para selecionar um arquivo.</small>
                                @endif
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select name="type">
                                                <option>Selecione o tipo</option>
                                                <option {{ old('type') == 'partner' ? 'selected' : '' }} value="partner">Parceiro</option>
                                                <option {{ old('type') == 'team' ? 'selected' : '' }} value="team">Membro do time</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-12">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Facebook" name="facebook" value="{{ old('facebook') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fab fa-facebook-square"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-12">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Linkedin" name="linkedin" value="{{ old('linkedin') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fab fa-linkedin"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-12">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Lattes" name="lattes" value="{{ old('lattes') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-eye fa-rotate-60"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-12">
                                <div class="field">
                                    <div class="control">
                                        <textarea class="textarea" name="presentation" type="text" placeholder="Escreva aqui uma breve apresentação sobre a pessoa que está sendo adicionada (obrigatório apenas para membros do time).">{{ old('presentation') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="button is-fullwidth is-white m-b-10">Adicionar pessoa</button>
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
    myFunctions.initQuickview('a.quickview-trigger');
    myFunctions.initNotification();
    myFunctions.initFileField('.file-input', 'span.file-label');
</script>
@endsection