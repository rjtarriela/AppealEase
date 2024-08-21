{{-- MODAL FOR ADD BUTTON --}}
<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#crossModal">
    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 6 L6 18 M6 6 L18 18"></path>
    </svg>
</button>

<!-- The Modal -->
<div class="modal" id="crossModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Case Appeal: Unuccessful!</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="mb-3 row">
                        <label for="remarks" class="col-sm-2 col-form-label text-start">Remarks:</label>
                        <div class="col-sm-10">
                            <textarea id="remarks" name="remarks" class="form-control" rows="4" placeholder="Enter your remarks here..."></textarea>
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