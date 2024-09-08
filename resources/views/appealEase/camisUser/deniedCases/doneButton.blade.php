<form action="" method="POST" style="margin-right: 5px">
    {{-- {{ url('/dashboard/case-done/' . $case->id) }} --}}
    @csrf
    <input type="hidden" name="decision" value="complete">
    <button type="submit" class="btn btn-outline-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 100 100">
            <path d="M20 20 L80 50 L20 80 Z" fill="none" stroke="green" stroke-width="8" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
    </button>
</form>
