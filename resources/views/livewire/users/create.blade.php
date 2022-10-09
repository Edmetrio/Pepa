<form>
    <div class="form-group">
        <label for="exampleFormControlInput1">Nome:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome do Utilizador" wire:model="name">
        @error('nome') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">E-mail:</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="E-mail" wire:model="email">
        @error('nome') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Palavra-passe:</label>
        <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Palavra-passe" wire:model="password">
        @error('nome') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
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
    <button wire:click.prevent="store()" class="btn btn-success">Adicionar</button>
</form>
