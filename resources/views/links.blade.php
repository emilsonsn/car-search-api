@extends('home')

@section('crud-content')

@php
    use App\Models\{Link, Group};
    use Illuminate\Support\Str;

    $links = Link::get();
    $groups = Group::all();
@endphp

<style>
    .table-content{
        max-height: 320px;
        overflow-y: scroll;
    }
</style>

<div class="container mt-4">
    <h2>Gerenciamento de Links</h2>
    
    <!-- Formulário de Criação -->
    <form id="linkForm" method="POST" action="{{ url('link') }}">
        @csrf
        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="description" name="description" required>
        </div>
        <div class="mb-3">
            <label for="site" class="form-label">Site</label>
            <select id="site" name="site" class="form-select" required>
                <option value="">Selecione um site</option>
                <option value="webmotos">WebMotors</option>
                <option value="olx">OLX</option>
                <option value="mercadolivre">Mercado Livre</option>
                <option value="icarros">iCarros</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="text" class="form-control" id="url" name="url" required>
        </div>
        <div class="mb-3">
            <label for="groups" class="form-label">Grupos</label>
            <select id="groups" name="groups[]" class="form-select" multiple required>
                @foreach($groups as $group)
                    <option value="{{ $group->group_id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
    
    <div class="table-content">
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Site</th>
                    <th>URL</th>
                    <th>Grupos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($links as $link)
                <tr>
                    <td>{{ $link->id }}</td>
                    <td>{{ $link->description }}</td>
                    <td>{{ $link->site }}</td>
                    <td>{{ Str::limit($link->url, 60, '...') }}</td>
    
                    <td>
                        @php
                            $groupsId = str_replace(['"', '[', ']'], '',$link->groups);
                            $groups = explode(',', $groupsId);
                            $groupsLabel = '';
                            foreach($groups as $group) {
                                $groupName = Group::where('group_id', trim($group))
                                    ->first()
                                    ?->name;
    
                                $groupsLabel.= $groupName.', ';
                            }
                        @endphp
                        {{ $groupsLabel }}
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="editLink({{ $link->id }}, '{{ $link->description }}', '{{ $link->site }}', '{{ $link->url }}', '{{ json_encode(json_decode($link->groups, true)) }}')">Editar</button>
                        <form method="POST" action="{{ url('link/'.$link->id) }}" class="d-inline">
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
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Choices('#groups', {
            removeItemButton: true,
            searchEnabled: true,
        });
    });

    function editLink(id, description, site, url, groups) {
        document.getElementById('description').value = description;
        document.getElementById('site').value = site;
        document.getElementById('url').value = url;
            
        document.getElementById('linkForm').action = `/link/${id}`;
        document.getElementById('linkForm').insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PATCH">');
    }
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
@endsection