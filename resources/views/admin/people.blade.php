@extends('partials.layouts.admin')
@section('content')
<div class="container">
    @include('partials.alerts.status')
    <button title="Adicionar uma pessoa" class="button is-fixed is-primary"><i class="fas fa-plus"></i></button>
    <div class="columns">
        <div class="column is-6 p-r-55">
            <div class="is-divider" data-content="Quem somos"></div>
            <div class="columns is-multiline">
                @foreach ($members as $member)
                    <div class="column is-6">
                        <div class="card is-person">
                            <a href="{{ route('admin.people.delete', $member->id) }}" class="button is-floating is-danger"><i class="fas fa-trash"></i></a>
                            <div class="quickview-trigger is-link" data-target="quickview-{{ $member->id }}">
                                <div class="card-image">
                                    <figure class="image is-1by1">
                                        <img src="/storage/{{ $member->image }}" alt="{{ $member->name }}">
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <p class="title">{{ $member->name }}</p>
                                </div>
                            </div>                      
                        </div>
                    </div>
                    <div id="quickview-{{ $member->id }}" class="quickview">
                        <header class="quickview-header">
                            <p class="title">{{ $member->name }}</p>
                            <span class="delete"></span>
                        </header>
                        <div class="quickview-body">{!! $member->presentation !!}</div>
                        <footer class="quickview-footer">
                            @if ($member->email)
                                <a class="tooltip" data-tooltip="{{ $member->email }}"><i class="fas fa-envelope"></i></a>
                            @endif
                            @if ($member->facebook)
                                <a target="_blank" href="{{ $member->facebook }}"><i class="fab fa-facebook"></i></a>
                            @endif
                            @if ($member->linkedin)
                                <a target="_blank" href="{{ $member->linkedin }}"><i class="fab fa-linkedin"></i></a>
                            @endif
                            @if ($member->lattes)
                                <a target="_blank" href="{{ $member->lattes }}"><i class="fas fa-eye fa-lattes"></i></a>
                            @endif
                        </footer>
                    </div>  
                @endforeach
            </div>
        </div>
        <div class="column is-6 p-l-55">
            <div class="is-divider" data-content="Parceiros"></div>
            <div class="columns is-multiline">
                @foreach ($partners as $partner)
                    <div class="column is-6">
                        <div class="card is-person">
                            <a href="{{ route('admin.people.delete', $partner->id) }}" class="button is-floating is-danger"><i class="fas fa-trash"></i></a>
                            <div class="quickview-trigger is-link" data-target="quickview-{{ $partner->id }}">
                                <div class="card-image">
                                    <figure class="image is-1by1">
                                        <img src="/storage/{{ $partner->image }}" alt="{{ $partner->name }}">
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <p class="title">{{ $partner->name }}</p>
                                </div>
                            </div>                      
                        </div>
                    </div>
                    <div id="quickview-{{ $partner->id }}" class="quickview">
                        <header class="quickview-header">
                            <p class="title">{{ $partner->name }}</p>
                            <span class="delete"></span>
                        </header>
                        <div class="quickview-body">{!! $partner->presentation !!}</div>
                        <footer class="quickview-footer">
                            @if ($partner->email)
                                <a class="tooltip" data-tooltip="{{ $partner->email }}"><i class="fas fa-envelope"></i></a>
                            @endif
                            @if ($partner->facebook)
                                <a target="_blank" href="{{ $partner->facebook }}"><i class="fab fa-facebook"></i></a>
                            @endif
                            @if ($partner->linkedin)
                                <a target="_blank" href="{{ $partner->linkedin }}"><i class="fab fa-linkedin"></i></a>
                            @endif
                            @if ($partner->lattes)
                                <a target="_blank" href="{{ $partner->lattes }}"><i class="fas fa-eye fa-lattes"></i></a>
                            @endif
                        </footer>
                    </div>  
                @endforeach
            </div>
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
                        <div class="steps">
                            <div class="step-item">
                                <div class="step-marker">1</div>
                                <div class="step-details"><p class="step-title">Dados Pessoais</p></div>
                            </div>
                            <div class="step-item">
                                <div class="step-marker">2</div>
                                <div class="step-details"><p class="step-title">Imagem</p></div>
                            </div>
                            <div class="step-item">
                                <div class="step-marker">3</div>
                                <div class="step-details"><p class="step-title">Participação</p></div>
                            </div>
                            <div class="steps-content">
                                <div class="step-content">
                                    <div class="columns is-multiline">
                                        <div class="column is-8">
                                            <div class="control has-icons-left">
                                                <input class="input" type="text" placeholder="Nome de exibição" name="name" value="{{ old('name') }}">
                                                <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                                            </div>
                                        </div>
                                        <div class="column is-4">
                                            <div class="select control is-fullwidth">
                                                <select name="type">
                                                    <option>Selecione o tipo</option>
                                                    <option {{ old('type') == 'partner' ? 'selected' : '' }} value="partner">Parceiro</option>
                                                    <option {{ old('type') == 'team' ? 'selected' : '' }} value="team">Membro do time</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="column is-12">
                                            <div class="control has-icons-left">
                                                <input class="input" type="text" placeholder="E-mail para contato" name="email" value="{{ old('email') }}">
                                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                                            </div>
                                        </div>
                                        <div class="column is-12">
                                            <div class="control has-icons-left">
                                                <input class="input" type="text" placeholder="Facebook (opcional)" name="facebook" value="{{ old('facebook') }}">
                                                <span class="icon is-small is-left"><i class="fab fa-facebook-square"></i></span>
                                            </div>
                                        </div>
                                        <div class="column is-12">
                                            <div class="control has-icons-left">
                                                <input class="input" type="text" placeholder="Linkedin (opcional)" name="linkedin" value="{{ old('linkedin') }}">
                                                <span class="icon is-small is-left"><i class="fab fa-linkedin"></i></span>
                                            </div>
                                        </div>
                                        <div class="column is-12">
                                            <div class="control has-icons-left">
                                                <input class="input" type="text" placeholder="Lattes (opcional)" name="lattes" value="{{ old('lattes') }}">
                                                <span class="icon is-small is-left"><i class="fas fa-eye fa-rotate-60"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-content">
                                    <div class="columns is-multiline is-centered">
                                        <div class="column is-6">
                                            <figure class="image is-1by1">
                                                <img class="image-preview cover is-fullwidth" src="{{ asset('images/person.png') }}">
                                            </figure>
                                        </div>
                                        <div class="column is-8">
                                            <label class="file-label file is-fullwidth">
                                                <input class="file-input" accept=".jpeg,.png,.jpg" type="file" name="image">
                                                <span class="file-cta">
                                                    <span class="file-icon"><i class="fas fa-upload"></i></span>
                                                    <span class="file-label">Escolha uma imagem para exibição</span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-content">
                                    <div class="columns is-multiline">
                                        <div class="column is-12">
                                            <textarea class="wysiwyg" name="presentation">{!! old('presentation', 'Esqueva aqui a participação dessa pessoa no projeto.') !!}</textarea>
                                            <button type="submit" class="button is-fullwidth is-white m-t-30">Adicionar pessoa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="steps-actions">
                                <div class="steps-action">
                                    <a class="button is-white previous-step">Voltar</a>
                                </div>
                                <div class="steps-action">
                                    <a class="button is-white next-step">Avançar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('partials.alerts.image')
                    @include('partials.alerts.errors')
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', ()=> {
        modal.initModal('.modal', '.button.is-fixed', '.modal-close');
        quickview.initQuickview('.quickview-trigger');
        notification.initNotification();
        form.initFileField('.file-input', 'span.file-label');
        steps.initSteps('.steps');
        form.changeImageSrcWhenInputChanges('input[name="image"]', ".image-preview");
        tinymceConfig.height = "150";
        tinymce.init(tinymceConfig);
    });
</script>
@endsection