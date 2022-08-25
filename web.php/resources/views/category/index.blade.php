<h1>Esta é a página que retorna as categorias</h1>

@foreach($categories as $category)
    <li>{{$category->name}}</li>
@endforeach
