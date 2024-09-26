<div class="card mb-4">
    <div class="card-header" style="display: flex; align-items: center;">
        <svg class="svg-inline--fa fa-table me-1" width="16" height="16" aria-hidden="true" focusable="false"
            data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
            data-fa-i2svg="">
            <path fill="currentColor"
                d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z">
            </path>
        </svg>
        Existing Case
    </div>
    <div class="card-body">
        <table id="caseTable" class="table">
            <thead>
                <tr class="text-center">
                    <th>Case Number</th>
                    <th>Case Type</th>
                    <th>Lower Court</th>
                    <th>Case Judge</th>
                    <th>Case Requirements</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($status->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No records of cases</td>
                    </tr>
                @else
                    @foreach ($status as $case)
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
                                {{-- Send Button Randomized - No function yet --}}
                                <form action="{{ url('/dashboard/cases/randomize/' . $case->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary edit-btn" onclick="return confirmRaffle()">
                                        {{-- <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 105.71" width="15" height="15">
                                            <path fill="#2196F3" d="M0,79.45c-0.02-1.95,0.76-3.06,2.51-3.18h14.08c5.98,0,8.89,0.16,13.98-3.91c1.08-0.86,2.1-1.86,3.06-3 c4.55-5.41,6.17-11.96,7.87-18.9C44.79,37,50.03,22.78,63.98,17.15c7.94-3.2,18.82-2.59,27.41-2.59h5.27l0.01-10.05 c0-5.01,1.18-5.88,4.79-2.45l19.55,18.58c2.36,2.24,2.03,3.7-0.22,5.86L101.49,45c-3.37,3.41-4.89,2.45-4.82-2.26v-11.8 c-34-0.52-32.57,1.67-42.05,34.09c-3.5,10.04-8.81,17.08-15.59,21.69c-7.09,4.82-13.68,6.39-22.02,6.39H6.65 C0.71,93.11,0,92.83,0,86.75V79.45L0,79.45z M0.23,26.26c-0.02,1.95,0.76,3.06,2.51,3.18h14.7c5.98,0,8.89-0.16,13.98,3.91 c1.08,0.86,2.1,1.86,3.06,3c1.16,1.38,2.13,2.84,2.96,4.35c1.5-4.69,3.36-9.29,5.82-13.5c0.7-1.19,1.44-2.35,2.23-3.48 c-1.74-1.8-3.61-3.37-5.61-4.73c-7.09-4.82-13.68-6.39-22.02-6.39H6.88c-5.94,0-6.65,0.28-6.65,6.36V26.26L0.23,26.26z M53.57,80.45c2.96,3.42,6.63,6.24,11.27,8.11c7.94,3.2,18.21,2.59,26.8,2.59h5.27l0.01,10.05c0,5.01,1.18,5.88,4.79,2.45 l19.55-18.58c2.36-2.24,2.03-3.7-0.22-5.86l-19.3-18.5c-3.37-3.41-4.89-2.45-4.82,2.26v11.8c-24.78,0.38-30.42-0.69-35.32-13.84 c-0.27,0.94-0.64,2.23-1.93,6.65c-0.03,0.1-0.06,0.19-0.09,0.28l0,0C57.91,72.62,55.9,76.79,53.57,80.45L53.57,80.45z"/>
                                          </svg>--}}
                                          Raffle
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
