@if (!$errors->isEmpty() && !$errors->has('thumbnail'))
    <small class="text-danger">Não se esqueça de selecionar o arquivo novamente.</small>
@endif