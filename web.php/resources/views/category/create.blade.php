<form action="/category/create" method="POST">
    @csrf
    Nome da categoria: <input type="text" name="name">
    <button type="submit">Enviar</button>
</form>
