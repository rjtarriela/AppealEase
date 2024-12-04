{{-- MODAL FOR ADD BUTTON --}}
<button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
    data-bs-target="#checkModal{{ $case->id }}">
    Verdict
</button>

<!-- The Modal -->
<div class="modal" id="checkModal{{ $case->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Verdict</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ url('/dashboard/judge-approved/' . $case->id) }}" method="POST">
                    @csrf
                    <div class="mb-3 row">
                        <label for="remarks" class="col-sm-2 col-form-label text-start">Remarks:</label>
                        <div class="col-sm-10">
                            <textarea id="remarks" name="remarks" class="form-control" rows="4" placeholder="Enter your remarks here..."
                                required></textarea>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer" style="justify-content: space-between">
                        <div>
                            <button type="submit" class="btn btn-primary" name="decision" value="Inhibited" onclick="return confirmDecision('Inhibit')">Inhibit</button>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" name="decision" value="Affirmed" onclick="return confirmDecision('Affirmed')">Affirmed</button>
                            <button type="submit" class="btn btn-primary" name="decision" value="Acquitted" onclick="return confirmDecision('Acquitted')">Acquitted</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
