<form>
    <div class="form-group">
        <label for="exampleFormControlInput1">Nome:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome do País" wire:model="nome">
        @error('nome') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="store()" class="btn btn-success">Adicionar</button>
</form>
