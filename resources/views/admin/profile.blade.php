@extends('partials.layouts.admin')
@section('content')
<div class="columns is-centered is-multiline is-mobile">
	<div class="column is-4-desktop is-3-fullhd">
		@include('partials.alerts.status')
		<div class="is-divider m-b-50" data-content="Atualizar dados pessoais"></div>
		<form action="{{ route('admin.profile.update') }}" method="post">
			@csrf
			<div class="field control has-icons-left">
				<input class="input" type="text" name="name" value="{{ old('name', auth()->user()->name) }}">
				<span class="icon is-small is-left"><i class="fas fa-user"></i></span>
				<small class="text-danger">{{ $errors->first('name') }}</small>
			</div>
			<div class="field control has-icons-left">
				<input class="input" type="password" name="password" placeholder="Nova senha">
				<span class="icon is-small is-left"><i class="fas fa-unlock-alt"></i></span>
				<small class="text-danger">{{ $errors->first('password') }}</small>
			</div>
			<div class="field control has-icons-left">
				<input class="input" type="password" name="password_confirmation" placeholder="Confirme a senha">
				<span class="icon is-small is-left"><i class="fas fa-unlock-alt"></i></span>
			</div>
			<div class="field control has-icons-left">
				<input class="input" type="password" name="current_password" placeholder="Senha atual">
				<span class="icon is-small is-left"><i class="fas fa-key"></i></span>
				<small class="text-danger">{{ $errors->first('current_password') }}</small>
			</div>
			<button type="submit" class="button is-fullwidth is-primary">Salvar alterações</button>
		</form>
		<span class="info m-t-15">A alteração da senha é opcional, caso queira alterar apenas seu nome, deixe os campos de senha em branco.</span>
	</div>
</div>
@endsection
@section('scripts')
<script>
	document.addEventListener('DOMContentLoaded', ()=> {
		notification.initNotification();
	});
</script>
@endsection