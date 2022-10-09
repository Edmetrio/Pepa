<form>
    <div class="form-group">
        <label for="exampleFormControlInput1">Role:</label>
        <select class="form-control" wire:model="role_id">
            <option>Seleccione o Nome da Rotas</option>
            @foreach($role as $r)
            <option value="{{ $r->id }}">{{ $r->nome }}</option>
            @endforeach
        </select>
        @error('role_id') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="update()" class="btn btn-dark">Actualizar</button>
    <button wire:click.prevent="cancel()" class="btn btn-danger">Cancelar</button>
</form>