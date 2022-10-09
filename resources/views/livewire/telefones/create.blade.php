<form>
    <div class="form-group">
        <label for="exampleFormControlInput1">Carteira:</label>
        <select class="form-control" wire:model="carteira_id">
            <option>Seleccione a Carteira</option>
            @foreach($carteira as $r)
            <option value="{{ $r->id }}">{{ $r->nome }}</option>
            @endforeach
        </select>
        @error('carteira_id') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Número:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Número" wire:model="numero">
        @error('numero') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="store()" class="btn btn-success">Adicionar</button>
</form>
