<form action="{{ url('/dashboard/judge-complete/' . $case->id) }}" method="POST" style="margin-left: 5px">
    @csrf
    <input type="hidden" name="decision" value="incomplete">
    <button type="submit" class="btn btn-outline-danger">Incomplete</button>
</form>
