<form>
    <div class="form-group">
        <label for="exampleFormControlInput1">Situação:</label>
        <select class="form-control" wire:model="situacaotrans_id">
            <option>Seleccione a Situação</option>
            @foreach($situacao as $r)
            <option value="{{ $r->id }}">{{ $r->nome }}</option>
            @endforeach
        </select>
        @error('situacaotrans_id') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="update()" class="btn btn-dark">Actualizar</button>
    <button wire:click.prevent="cancel()" class="btn btn-danger">Cancelar</button>
</form>