@extends('backend.layouts.master')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('user.register.create') }}" class="btn btn-info btn-rounded btn-fw">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <p>Members</p>
            <div class="table-responsive table-sm">
                <table id="DataTable" class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="col-2">Name</th>
                            <th class="col-1">Gender</th>
                            <th class="col-2">Contact</th>
                            <th class="col-3">Address</th>
                            {{-- <th class="col-1">Gym Time</th> --}}
                            <th class="col-1">Plan</th>
                            <th class="col-2">Initial Weight</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                        <tr>
                            
                            <td>
                                {{$member->user->name ?? 'User Not Available' }}
                            </td>
                            <td>
                                {{ $member->gender == 1 ? 'Male':'Female' }}
                            </td>
                            <td>
                                {{ $member->contact }}
                            </td>
                            <td>
                                {{ $member->address }}
                            </td>
                            {{-- <td>
                                {{ \Carbon\Carbon::createFromTimeString($member->gym_time)->format('H:i:s A') }}
                            </td> --}}
                            <td>
                                {{$member->service->name ?? 'User Not Available' }}
                            </td>
                            <td>
                                {{ $member->initial_weight }}
                            </td>
                           
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('user.member.get',$member->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Make Member</a>
                                    
                                    {{-- <form class="form-inline" method="post" action="{{ route('announcement.destroy',$announcement->id) }}" onsubmit="return confirm('Are you sure you want to delete this?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash text-white"></i></button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>

</script>
@endsection
