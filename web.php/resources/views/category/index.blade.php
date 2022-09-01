<h1>Esta é a página que retorna as categorias</h1>

@foreach($categories as $category)
    <li>{{$category->name}}
    <a href="{{ route('category.edit', $category->id) }}" >Editar</a>
    <a href="{{ route('category.destroy', $category->id) }}" >Deletar</a>
    </li>
@endforeach
