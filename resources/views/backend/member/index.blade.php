@extends('backend.layouts.master')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('member.create') }}" class="btn btn-info btn-rounded btn-fw">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <p>Members</p>
            <div class="table-responsive table-sm">
                <table id="DataTable" class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th >
                                Member Code
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Gender
                            </th>
                            <th>
                                Contact
                            </th>
                            <th>
                                Address
                            </th>
                            <th>
                                Gym Time
                            </th>
                            <th>
                                Plan
                            </th>
                            <th>
                                Initital Weight
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                        <tr>
                            <td class="py-1">
                                {{ $member->member_code }}
                            </td>
                            <td>
                                {{ $member->user->name }}
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
                            <td>
                                {{ \Carbon\Carbon::createFromTimeString($member->gym_time)->format('H:i:s A') }}
                            </td>
                            <td>
                                {{ $member->service->name }}
                            </td>
                            <td>
                                {{ $member->initial_weight }}
                            </td>
                           
                            <td>
                              <form class="form-inline" method="post" action="">
                                  @csrf
                                  @method('delete')
                                  <a href="" class="btn btn-secondary m-2"><i class="fa-light fa-pen-to-square"></i></a>
                                  <button onclick="return confirm('Are you sure to delete this event?')" type="submit" class="btn btn-danger">
                                      <i class="fa fa-trash"></i>
                                  </button>
                              </form>
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
