<form action="{{ url('/dashboard/judge-complete/' . $case->id) }}" method="POST" style="margin-right: 5px">
    @csrf
    <input type="hidden" name="decision" value="complete">
    <button type="submit" class="btn btn-outline-success">Complete</button>
</form>
