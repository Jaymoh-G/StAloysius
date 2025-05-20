<div>
 	<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Team</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                   @if ($teamMembers->count())
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>

                                                <th><strong>Name</strong></th>
                                                <th><strong>Position</strong></th>
                                                <th><strong>Skills</strong></th>
                                                <th><strong>Socials</strong></th>
                                                <th><strong>Experience</strong></th>
                                                <th><strong>Action</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>

 @foreach ($teamMembers as $member)
											<tr>

                                                <td>
  @if ($member->image)
<div class="d-flex align-items-center"><img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" class="rounded-lg me-2" width="24" alt=""/> <span class="w-space-no">{{ $member->name }}</span>
                                                    @else<div class="d-flex align-items-center"><img src="images/avatar/2.jpg" class="rounded-lg me-2" width="24" alt=""/> <span class="w-space-no">{{ $member->name }}</span></div>
                                                    @endif</td>

                                                <td>{{ $member->position }}</td>
                                                <td>{{ $member->experience }}	</td>
                                                <td>01 August 2020</td>
                                                <td><div class="d-flex align-items-center"><i class="fa fa-circle text-danger me-1"></i> Canceled</div></td>
                                                <td>
													<div class="d-flex">
														<a href="{{ route('dashboard.team.edit', $member->id) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
														<button "wire:click="$emit('deleteMember', {{ $member->id }})" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a><a href="#" class="btn btn-success shadow btn-xs sharp"><i class="fa fa-eye"></i></a>
													</div>
												</td>
                                            </tr>
@endforeach


                                        </tbody>
                                    </table>


                        <div class="mt-4">
                            {{ $teamMembers->links() }}
                        </div>
                    @else
                        <p>No team members found.</p>

@endif
                                </div>
                            </div>
                        </div>
                    </div>
</div>
