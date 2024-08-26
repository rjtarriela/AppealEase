{{-- MODAL FOR ADD BUTTON --}}
<button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
    data-bs-target="#checkModal{{ $case->id }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="green"
        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
        <path d="M20 6L9 17l-5-5" />
    </svg>
</button>

<!-- The Modal -->
<div class="modal" id="checkModal{{ $case->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Case Appeal: Successful!</h4>
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
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
