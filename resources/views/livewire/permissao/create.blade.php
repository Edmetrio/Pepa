<form>
    <div class="form-group">
        <label for="exampleFormControlInput1">Role:</label>
        <select class="form-control" wire:model="role_id">
            <option>Seleccione o Nome da Rotas</option>
            @foreach($role as $r)
            <option value="{{ $r->id }}">{{ $r->nome }}</option>
            @endforeach
        </select>
        @error('nome') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Rota:</label>
        <select class="form-control" wire:model="rota_id">
            <option>Seleccione o Nome da Rotas</option>
            @foreach($rota as $r)
            <option value="{{ $r->id }}">{{ $r->nome }}</option>
            @endforeach
        </select>
        @error('nome') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="store()" class="btn btn-success">Adicionar</button>
</form>
