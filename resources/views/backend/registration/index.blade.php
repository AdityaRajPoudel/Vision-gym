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
                            {{-- <th>Action</th> --}}
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
                           
                            {{-- <td>
                              <form class="form-inline" method="post" action="">
                                  @csrf
                                  @method('delete')
                                  <a href="" class="btn btn-secondary m-2"><i class="fa-light fa-pen-to-square"></i></a>
                                  <button onclick="return confirm('Are you sure to delete this event?')" type="submit" class="btn btn-danger">
                                      <i class="fa fa-trash"></i>
                                  </button>
                              </form>
                          </td> --}}
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
