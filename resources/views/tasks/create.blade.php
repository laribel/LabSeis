@extends('layouts.app')
@section('content')
<h1>Creado una tarea</h1>
<hr>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="/tasks" method="POST">
    @csrf

    <div>
        <label class="form-label" for="name">Usuario</label>
        <select name="user_id" id="usuario_id" class="form-control">
        @foreach($user as $customer)
                <option value="{{ $customer->id }}">{{ $customer->id}}</option>
            @endforeach
            
        </select>
        @error('user_id')
            <p>{{ $message }}</p>
        @enderror
    </div>
   
    <div>
       
        <label class="form-label" for="name">Nombre</label>
        <input class="form-control" type="text" name="name" id="name">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="form-label" for="name">Prioridad</label>
        <select name="priority_id" id="priority_id" class="form-control">
            @foreach($priorities as $priority)
                <option value="{{ $priority->id }}">{{ $priority->name }}</option>
            @endforeach
            
        </select>
        @error('priority_id')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="form-label" for="etiqueta">Etiqueta</label>
        <select name="etiqueta[]" id="etiqueta" class="form-control" multiple>
            @foreach($etiqueta as $etiquetas)
                <option value="{{ $etiquetas->id }}">{{ $etiquetas->nombre }}</option>
            @endforeach
            
        </select>
      
    </div>

  
    <div>
        <label class="form-label" for="description">Descripción</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
        @error('description')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Crear tarea</button>

    
</form>
@endsection