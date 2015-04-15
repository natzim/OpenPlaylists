@if (Request::has('genre'))
    <input type="hidden" name="genre" id="genre" value="{{ Request::input('genre') }}">
@else
    <input type="hidden" name="genre" id="genre">
@endif
<div id="input-genre"></div>