<div class="container-fluid">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Student Applications</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>KPSEA Index</th>
                            <th>Residence</th>
                            <th>Guardian Name</th>
                            <th>Guardian Phone</th>
                            <th>Application Letter</th>
                            <th>Academic Certificates</th>
                            <th>Death Certificate</th>
                            <th>Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applications as $i => $app)
                        <tr>
                            <td>{{ $applications->firstItem() + $i }}</td>
                            <td>{{ $app->student_name }}</td>
                            <td>{{ $app->kpsea_index_number }}</td>
                            <td>{{ $app->current_residence }}</td>
                            <td>{{ $app->guardian_name }}</td>
                            <td>{{ $app->guardian_phone }}</td>
                            <td>
                                <a
                                    href="{{ asset('storage/' . $app->application_letter) }}"
                                    target="_blank"
                                    class="btn btn-xs btn-outline-primary"
                                    >View</a
                                >
                            </td>
                            <td>
                                @php $certs =
                                is_array($app->academic_certificates) ?
                                $app->academic_certificates :
                                json_decode($app->academic_certificates, true);
                                @endphp @if($certs && count($certs))
                                @foreach($certs as $idx => $file)
                                <a
                                    href="{{ asset('storage/'.$file) }}"
                                    target="_blank"
                                    class="btn btn-xs btn-outline-primary mb-1"
                                    >Cert {{ $idx + 1 }}</a
                                >
                                @endforeach @else
                                <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                @php $deaths = is_array($app->death_certificate)
                                ? $app->death_certificate :
                                ($app->death_certificate ?
                                json_decode($app->death_certificate, true) :
                                []); @endphp @if($deaths && count($deaths))
                                @foreach($deaths as $idx => $file)
                                <a
                                    href="{{ asset('storage/'.$file) }}"
                                    target="_blank"
                                    class="btn btn-xs btn-outline-primary mb-1"
                                    >Cert {{ $idx + 1 }}</a
                                >
                                @endforeach @else
                                <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>{{ $app->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">
                                No applications found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $applications->links() }}
        </div>
    </div>
</div>
