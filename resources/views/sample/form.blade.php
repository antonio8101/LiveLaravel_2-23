<form action="/sample" method="post">
    @method('PUT')
    <input type="hidden" name="_method" value="PUT">

    @csrf
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <input type="text" name="prova">
    <button type="submit">send</button>
</form>
