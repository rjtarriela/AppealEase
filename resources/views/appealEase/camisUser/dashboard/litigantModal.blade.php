<!-- Button to trigger modal -->
<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#litigantModal-{{ $case->id }}">
    View Information
</button>

<!-- Modal -->
<div class="modal fade" id="litigantModal-{{ $case->id }}" tabindex="-1" role="dialog"
    aria-labelledby="litigantModalLabel-{{ $case->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="margin-top: 50px">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="litigantModalLabel-{{ $case->id }}">
                    Litigant Profile
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                {{-- <ul style="text-align: left">
                <p>Name:</p>
                <p>Email Address:</p>
                <p>Contact Number:</p>
                <p>License Number:</p>
              </ul> --}}

                <table>
                    <tr>
                        <td style="text-align: left">Name of Filing Party</td>
                        <td style="text-align: left">: {{ $case->name_of_filing_party }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Litigant Name</td>
                        <td style="text-align: left">: {{ $case->litigant_name }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Email Address</td>
                        <td style="text-align: left">: {{ $case->email_address }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Contact Number</td>
                        <td style="text-align: left">: {{ $case->contact_number }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left">License Number</td>
                        <td style="text-align: left">: {{ $case->license_number }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
