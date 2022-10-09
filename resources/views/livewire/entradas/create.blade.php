<form>
    <div class="form-group">
        <label for="exampleFormControlInput1">Fornecedor:</label>
        <select class="form-control" wire:model="users_id">
            <option>Seleccione o Fornecedor</option>
            @foreach($users as $r)
            <option value="{{ $r->id }}">{{ $r->name }}</option>
            @endforeach
        </select>
        @error('users_id') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">País:</label>
        <select class="form-control" wire:model="selectedPais">
            <option>Seleccione o Nome da Rotas</option>
            @foreach($pais as $r)
            <option value="{{ $r->id }}">{{ $r->nome }}</option>
            @endforeach
        </select>
        @error('selectedPais') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    @if (!is_null($selectedPais))
    <div class="form-group">
        <label for="exampleFormControlInput1">Província:</label>
        <select class="form-control" wire:model="selectedProvincia">
            <option>Seleccione o Nome da Rotas</option>
            @foreach($provincias as $r)
            <option value="{{ $r->id }}">{{ $r->nome }}</option>
            @endforeach
        </select>
        @error('selectedProvincia') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    @endif

    @if (!is_null($selectedProvincia))
    <div class="form-group">
        <label for="exampleFormControlInput1">Distrito:</label>
        <select class="form-control" wire:model="distrito_id">
            <option>Seleccione o Nome do Distrito</option>
            @foreach($distritos as $r)
            <option value="{{ $r->id }}">{{ $r->nome }}</option>
            @endforeach
        </select>
        @error('distrito_id') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Categoria:</label>
        <select class="form-control" wire:model="selectedCategoria">
            <option>Seleccione o Nome da Categoria</option>
            @foreach($categoria as $r)
            <option value="{{ $r->id }}">{{ $r->nome }}</option>
            @endforeach
        </select>
        @error('selectedCategoria') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    @if (!is_null($selectedCategoria))
    <div class="form-group">
        <label for="exampleFormControlInput1">Produto:</label>
        <select class="form-control" wire:model="produto_id">
            <option>Seleccione o Nome do Produto</option>
            @foreach($produtos as $r)
            <option value="{{ $r->id }}">{{ $r->nome }}</option>
            @endforeach
        </select>
        @error('produto_id') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    @endif

    <div class="form-group">
        <label for="exampleFormControlInput1">Quantidade:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Quantidade" wire:model="quantidade">
        @error('quantidade') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Valor:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="valor" wire:model="valor">
        @error('valor') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    @endif
    
    <button wire:click.prevent="store()" class="btn btn-success">Adicionar</button>
</form>
