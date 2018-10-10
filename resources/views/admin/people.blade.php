@extends('partials.layouts.admin')
@section('content')
<div class="container">
    @include('partials.alerts.status')
    <button title="Adicionar uma pessoa" class="button is-fixed is-primary"><i class="fas fa-plus"></i></button>
    <div class="columns has-lateral-padding-45">
        <div class="column is-6">
            <div class="columns is-multiline">
				<div class="column is-12">
					<div class="is-divider" data-content="Quem somos"></div>
				</div>
                @foreach ($teammates as $teammate)
                    <div class="column is-6">
                        <div class="card is-person">
							<a data-action="{{ route('admin.people.delete', $teammate->id) }}" class="button is-floating is-danger confirmed"><i class="fas fa-trash"></i></a>
                            {{-- <a href="{{ route('admin.people.delete', $teammate->id) }}" class="button is-floating is-danger"><i class="fas fa-trash"></i></a> --}}
                            <div class="quickview-trigger is-link" data-target="quickview-{{ $teammate->id }}">
                                <div class="card-image">
                                    <figure class="image is-1by1">
                                        <img src="{{ $teammate->image }}" alt="{{ $teammate->name }}">
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <p class="title">{{ $teammate->name }}</p>
                                </div>
                            </div>                      
                        </div>
                    </div>
                    <div id="quickview-{{ $teammate->id }}" class="quickview">
                        <header class="quickview-header">
                            <p class="title">{{ $teammate->name }}</p>
                            <span class="delete"></span>
                        </header>
                        <div class="quickview-body">{!! $teammate->presentation !!}</div>
                        <footer class="quickview-footer">
							<i class="fas fa-envelope"></i>{{ $teammate->email }}
                        </footer>
                    </div>  
                @endforeach
            </div>
        </div>
        <div class="column is-6">
            <div class="columns is-multiline">
				<div class="column is-12">
					<div class="is-divider" data-content="Parceiros"></div>
				</div>
                @foreach ($partners as $partner)
                    <div class="column is-6">
						<div class="card is-person">
							<a href="{{ route('admin.people.delete', $partner->id) }}" class="button is-floating is-danger"><i class="fas fa-trash"></i></a>
							<a target="_blank" href="{{ $partner->link }}">
								<div class="card-image">
									<figure class="image is-1by1">
										<img src="{{ $partner->image }}" alt="{{ $partner->name }}">
									</figure>
								</div>
								<div class="card-content">
									<p class="title">{{ $partner->name }}</p>
								</div>
							</a>
						</div>
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
                                                <input class="input" type="text" placeholder="E-mail (apenas para membros)" name="email" value="{{ old('email') }}">
                                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                                            </div>
                                        </div>
										<div class="column is-12">
											<div class="control has-icons-left">
												<input class="input" type="text" placeholder="Link do site (apenas para parceiros)" name="link" value="{{ old('link') }}">
												<span class="icon is-small is-left"><i class="fas fa-link"></i></span>
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
                                            <textarea class="wysiwyg" name="presentation">{!! old('presentation', 'Escreva aqui o currículo resumido dessa pessoa (apenas para membros do time).') !!}</textarea>
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
@include('partials.confirmation.confirmation')
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
		card.resizeToFit('.card-content .title');
		confirmation.initConfirmation();
    });
</script>
@endsection