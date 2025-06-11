<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Team Members</h4>
                    <div class="page-title-right">
                        <a href="{{ route('dashboard.team.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Add New Member
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if ($teamMembers->count())
                            <div class="table-responsive">
                                <table class="table-hover table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Position</th>
                                            <th scope="col">Department</th>
                                            <th scope="col">Skills</th>
                                            <th scope="col">Social Links</th>
                                            <th scope="col">Experience</th>
                                            <th scope="col" class="text-end">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teamMembers as $member)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if ($member->image)
                                                            <img src="{{ asset('storage/' . $member->image) }}"
                                                                alt="{{ $member->name }}" class="rounded-circle me-2"
                                                                width="40" height="40"
                                                                style="object-fit: cover" />
                                                        @else
                                                            <img src="{{ asset('images/avatar/2.jpg') }}"
                                                                alt="Default Avatar" class="rounded-circle me-2"
                                                                width="40" height="40"
                                                                style="object-fit: cover" />
                                                        @endif
                                                        <span>{{ $member->name }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ $member->position }}</td>
                                                <td>
                                                    @if ($member->department)
                                                        {{ $member->department->name }}
                                                    @else
                                                        <span class="text-muted">No department</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($member->professional_skills)
                                                        @php
                                                            $skills = is_array($member->professional_skills)
                                                                ? $member->professional_skills
                                                                : json_decode($member->professional_skills, true);
                                                        @endphp
                                                        @if ($skills)
                                                            @foreach ($skills as $skill => $percent)
                                                              {{ $skill }}
                                                                    ({{ $percent }}%)
                                                               
                                                            @endforeach
                                                        @else
                                                            <span class="text-muted">No skills added</span>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">No skills added</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($member->socials)
                                                        @php
                                                            $socialLinks = is_array($member->socials)
                                                                ? $member->socials
                                                                : json_decode($member->socials, true);
                                                        @endphp
                                                        @if ($socialLinks)
                                                            @foreach ($socialLinks as $platform => $url)
                                                                <a href="{{ $url }}" target="_blank"
                                                                    class="btn btn-sm btn-light me-1">
                                                                    <i class="fab fa-{{ strtolower($platform) }}"></i>
                                                                </a>
                                                            @endforeach
                                                        @else
                                                            <span class="text-muted">No social links</span>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">No social links</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($member->experience)
                                                        <span class="text-truncate d-inline-block"
                                                            style="max-width: 200px">
                                                            {{ Str::limit($member->experience, 50) }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">No experience added</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end gap-2">
                                                        <a href="{{ route('dashboard.team.edit', $member->id) }}"
                                                            class="btn btn-primary btn-sm" title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>

                                                        <button wire:click="confirmDelete({{ $member->id }})"
                                                            class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <!-- link to view the member in the frontend open in new tab-->
                                                        <a href="{{ route('frontend.team.show', $member->slug) }}"
                                                            target="_blank" class="btn btn-info btn-sm" title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                {{ $teamMembers->links() }}
                            </div>
                        @else
                            <div class="py-5 text-center">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No team members found</h5>
                                <p class="text-muted">
                                    Start by adding your first team member
                                </p>
                                <a href="{{ route('dashboard.team.create') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-plus me-1"></i> Add New Member
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('confirmDelete', (data) => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.deleteMember(data.id);
                        Swal.fire(
                            'Deleted!',
                            'Team member has been deleted.',
                            'success'
                        );
                    }
                });
            });
        });
    </script>
@endpush
