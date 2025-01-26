<form action="/sample" method="post">
    @method('PUT')
    @csrf
    <input type="text" name="prova">
    <button type="submit">send</button>
</form>