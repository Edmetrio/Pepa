<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Produto;
use App\Models\Models\Role;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Users extends Component
{
    public $role_id, $name, $email, $icon, $password, $email_verified_at, $post_id;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->role_id = '';
        $this->name = '';
        $this->email = '';
        $this->icon = '';
        $this->password = '';
        $this->post_id = '';
    }


    public function edit($id)
    {
        $post = User::findOrFail($id);
        $this->post_id = $id;
        $this->role_id = $post->role_id;
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'role_id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);

        $now = new DateTime();
        $datetime = $now->format('Y-m-d H:i:s');

        $validatedDate['password'] = Hash::make($this->password);
        $validatedDate['email_verified_at'] = $datetime;

        User::create($validatedDate);

        session()->flash('message', 'User criado com sucesso!');

        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'role_id' => 'required',
        ]);

        $post = User::find($this->post_id);
        $post->update([
            'role_id' => $this->role_id,
        ]);

        $this->updateMode = false;

        session()->flash('message', 'Utilizador actualizada com sucesso');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User apagada com sucesso.');
    }

    public function render()
    {
        $item = Itemcarrinha::with('produtos', 'users', 'distritos', 'enderecos', 'unidades')->where(function ($query) {
            if (auth()->check()) {
                $query->where('users_id', Auth::user()->id);
            }
        })->get();
        $tt = 0.0;
        foreach ($item as $itens) {
            $itens->subtotal = $itens->quantidade * $itens->produtos->preco_retalho;
            $tt += $itens->subtotal;
        }
        $item->total = $tt;

        $this->users = User::with('roles')->orderBy('created_at', 'desc')->get();
        /*  dd($this->users); */
        $this->role = Role::orderBy('created_at', 'desc')->get();
        $produto = Produto::orderBy('created_at', 'desc')->get();
        $categoria = Categoria::orderBy('created_at', 'desc')->get();
        return view('livewire.users')->layout('layouts.app', compact('produto', 'categoria', 'item'));
    }
}
