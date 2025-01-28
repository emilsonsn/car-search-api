@extends('home')

@section('crud-content')

@php
    use App\Models\Group;
    $groups = Group::get();
@endphp
<div class="container mt-4">
    <h2>Gerenciamento de Grupos</h2>
    
    <!-- Formulário de Criação -->
    <form id="groupForm" method="POST" action="{{ url('group') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome do Grupo</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="group_id" class="form-label">ID do Grupo</label>
            <input type="text" class="form-control" id="group_id" name="group_id" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
    
    <!-- Tabela de Grupos -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Id do grupo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
            <tr>
                <td>{{ $group->id }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->group_id }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="editGroup({{ $group->id }}, '{{ $group->name }}', '{{ $group->group_id }}',)">Editar</button>
                    <form method="POST" action="{{ url('group/'.$group->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function editGroup(id, name, group_id) {
    document.getElementById('name').value = name;
    document.getElementById('group_id').value = group_id;
    document.getElementById('groupForm').action = `/group/${id}`;
    document.getElementById('groupForm').insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PATCH">');
}
</script>
@endsection