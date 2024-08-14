{{-- MODAL FOR ADD BUTTON --}}

<button type="button" class="btn btn-success btn-large" data-bs-toggle="modal" data-bs-target="#myModal">
    + Add Judge
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-xl">
        
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Judge Registration</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="/submit" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name:</label>
                        <input type="fullname" class="form-control" id="name" placeholder="Enter Full Name"
                            name="name">
                    </div>
                    <div class="mb-3">
                        <label for="division" class="form-label">Division:</label>
                        <input type="number" class="form-control" id="division" name="division"
                            step="1" value="1" min="1" max="5">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter Email Address"
                            name="email">
                    </div>
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact Number:</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number"
                            placeholder="Enter Contact Number" pattern="\d{11}" title="Please enter exactly 11 digits"
                            required>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>