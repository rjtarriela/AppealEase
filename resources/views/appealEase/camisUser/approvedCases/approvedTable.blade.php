<div class="card mb-4">
    <div class="card-header" style="display: flex; align-items: center;">
        <svg class="svg-inline--fa fa-table me-1" width="16" height="16" aria-hidden="true" focusable="false"
            data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
            data-fa-i2svg="">
            <path fill="currentColor"
                d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z">
            </path>
        </svg>
        List of Solved Cases
    </div>
    <div class="card-body">
        <table id="caseTable" class="table">
            <thead>
                <tr class="text-center">
                    <th>Case Number</th>
                    <th>Case Type</th>
                    <th>Case Court</th>
                    <th>Case Judge</th>
                    <th>Case Requirements</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($cases->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No records of cases</td>
                    </tr>
                @else
                    @foreach ($cases as $case)
                        <tr class="text-center">
                            <td class="align-content-center">{{ $case->case_number }}</td>
                            {{-- <td class="align-content-center">{{ $case->case_type }}</td> --}}
                            {{-- first letter capital --}}
                            <td class="align-content-center">{{ ucfirst($case->case_type) }}</td>
                            <td class="align-content-center">{{ $case->case_court }}</td>
                            <td class="align-content-center">{{ $case->case_judge }}</td>
                            <td class="align-content-center">
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
                                        <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong><br>
                                        @foreach ($files as $filePath)
                                            <a href="{{ asset('storage/' . $filePath) }}" target="_blank">
                                                View {{ basename($filePath) }}
                                            </a><br>
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td class="align-content-center">
                                <!-- Action buttons -->
                                {{-- Send Button - No function yet --}}
                                <form action="{{ url('/approved-cases/send-to-supremeCourt/' . $case->id) }}" method="POST" style="display: flex; justify-content: center; align-items: center;">
                                    {{-- button for action --}}
                                    @csrf
                                    <button class="btn btn-outline-success" type="submit"
                                        style="display: flex; justify-content: center; align-items: center;" onclick="return confirmSend()">
                                        Send to Supreme Court
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
