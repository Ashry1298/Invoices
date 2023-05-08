@props(['item', 'url'])
<a class="btn btn-danger" href="{{ $url }}"
    onclick="event.preventDefault();
              document.getElementById('item-{{ $item }}').submit();">
    حذف
</a>
<form id='item-{{ $item }}' action="{{ $url }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
