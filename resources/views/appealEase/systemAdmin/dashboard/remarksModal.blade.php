<!-- Button to trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#remarksModal-{{ $case->id }}">
    View Remarks
</button>

<!-- Modal -->
<div class="modal fade" id="remarksModal-{{ $case->id }}" tabindex="-1" role="dialog"
    aria-labelledby="remarksModalLabel-{{ $case->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top: 50px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="remarksModalLabel-{{ $case->id }}">
                    Remarks for Case #{{ $case->case_number }}
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul style="text-align: left">
                    @foreach ($case->decisions as $decision)
                        <li>
                            <strong>{{ $decision->judge->name ?? 'No Remarks' }}:</strong>
                            {{ $decision->remarks ?? 'No remarks' }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

