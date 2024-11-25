<!-- Button to trigger modal -->
<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#requirementModal-{{ $case->id }}">
    View Requirements
</button>

<!-- Modal -->
<div class="modal fade" id="requirementModal-{{ $case->id }}" tabindex="-1" role="dialog"
    aria-labelledby="requirementModalLabel-{{ $case->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document" style="margin-top: 50px">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="requirementModalLabel-{{ $case->id }}">
                    Case Requirements
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <ol style="text-align: left">
                    @php
                        // Decode all JSON encoded file paths
                        $uploads = [
                            'pleading' => json_decode($case->pleading, true),
                            'evidences' => json_decode($case->evidences, true),
                            'verification' => json_decode($case->verification, true),
                            'certificate' => json_decode($case->certificate, true),
                            'judicial_affidavit' => json_decode($case->judicial_affidavit, true),
                            'notice_of_appeal' => json_decode($case->notice_of_appeal, true),
                            'documents' => json_decode($case->documents, true),
                            'memoranda' => json_decode($case->memoranda, true),
                            'other_files' => json_decode($case->other_files, true),
                        ];
                    @endphp

                    @foreach ($uploads as $key => $files)
                        @if (!empty($files))
                            <li><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong></li>
                            <ul>
                                @foreach ($files as $filePath)
                                    <li>
                                        <a href="{{ asset('storage/' . $filePath) }}" target="_blank">
                                            View {{ basename($filePath) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
