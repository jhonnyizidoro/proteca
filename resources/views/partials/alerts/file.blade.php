@if (!$errors->isEmpty() && !$errors->has('file'))
    <small class="text-danger">Não se esqueça de selecionar o arquivo novamente.</small>
@endif