<form>

    <div class="form-group">
        <label for="exampleFormControlInput1">País:</label>
        <select class="form-control" wire:model="selectedPais">
            <option>Seleccione o Nome do País</option>
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
            <option>Seleccione o Nome do Pais</option>
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
        <label for="exampleFormControlInput1">Endereço:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Av. Salvador Allende, n. 42" wire:model="endereco">
        @error('endereco') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Tipo de Agricultura:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Frutas" wire:model="categoria">
        @error('categoria') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Nome dos Produtos:</label>
        <textarea class="form-control" style="height:70px" placeholder="Banana" wire:model="produto"></textarea>
        @error('produto') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Quantidade:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Quantidade" wire:model="quantidade">
        @error('quantidade') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Montante:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="120" wire:model="montante">
        @error('montante') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Observação:</label>
        <textarea class="form-control" style="height:150px" placeholder="Observação" wire:model="observacao"></textarea>
        @error('quantidade') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    @endif
    
    <button wire:click.prevent="store()" class="btn btn-success">Adicionar</button>
</form>
