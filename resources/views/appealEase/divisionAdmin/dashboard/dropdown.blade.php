<!-- Include this dropdown in your table's action column -->
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $judge->id }}" data-bs-toggle="dropdown" aria-expanded="false">
        {{ ucfirst($judge->judgeRole) }}
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $judge->id }}">
        <li>
            <a class="dropdown-item" href="{{ route('judge.updateRole', ['id' => $judge->id, 'role' => 'normal']) }}">
                Normal
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('judge.updateRole', ['id' => $judge->id, 'role' => 'head']) }}">
                Head
            </a>
        </li>
    </ul>
</div>