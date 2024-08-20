{{-- MODAL FOR ADD BUTTON --}}

<button  class="btn btn-outline-danger" type="button" data-bs-toggle="modal" data-bs-target="#nocheckModal">
    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 6 L6 18 M6 6 L18 18"></path>
    </svg>
</button>

<!-- The Modal -->
<div class="modal" id="nocheckModal">
    <div class="modal-dialog modal-l">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Case Appeal: Unsuccessful!</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="remarks" class="form-label text-start" style="text-align: left; display: block;">
                            Remarks:
                        </label>
                        <textarea class="form-control" id="remarks" rows="4" placeholder="Enter your remarks here..."></textarea>
                    </div>
                </form>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
