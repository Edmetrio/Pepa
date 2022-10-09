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
            <option>Seleccione o Nome da Província</option>
            @foreach($provincias as $r)
            <option value="{{ $r->id }}">{{ $r->nome }}</option>
            @endforeach
        </select>
        @error('selectedProvincia') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    @endif

    @if (!is_null($selectedProvincia))
    <div class="form-group">
        <label for="exampleFormControlInput1">Província:</label>
        <select class="form-control" wire:model="distrito_id">
            <option>Seleccione o Nome do Distrito</option>
            @foreach($distritos as $r)
            <option value="{{ $r->id }}">{{ $r->nome }}</option>
            @endforeach
        </select>
        @error('distrito_id') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Nome da Transpotadora:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome da Transpotadora" wire:model="nome">
        @error('nome') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    @endif
    
    <button wire:click.prevent="store()" class="btn btn-success">Adicionar</button>
</form>
