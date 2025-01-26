
@if ($filter == "finance")
<h1>FINANCE</h1>
<ul>
    <li id="1">
        <a href="./1">News Title 1</a>
    </li>
    <li id="2">
        <a href="./2">News Title 2</a>
    </li>
    <li id="3">
        <a href="./3">News Title 3</a>
    </li>
</ul>
@elseif ($filter == "tranding")
<h1>TRANDING</h1>
<ul>
    <li id="1">
        <a href="./1">News Title 1</a>
    </li>
    <li id="2">
        <a href="/2">News Title 2</a>
    </li>
    <li id="3">
        <a href="/3">News Title 3</a>
    </li>
</ul>
@elseif ($filter == "popular")
<h1>POPULAR</h1>
<ul>
    <li id="1">
        <a href="/1">News Title 1</a>
    </li>
    <li id="2">
        <a href="/2">News Title 2</a>
    </li>
    <li id="3">
        <a href="/3">News Title 3</a>
    </li>
</ul>
@else
<ul>
    <li id="1">
        <a href="news/1">News Title 1</a>
    </li>
    <li id="2">
        <a href="news/2">News Title 2</a>
    </li>
    <li id="3">
        <a href="news/3">News Title 3</a>
    </li>
</ul>
@endif
