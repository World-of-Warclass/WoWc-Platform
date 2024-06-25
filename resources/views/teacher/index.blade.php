

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Teachers') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('teachers.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Id</th>
                                        
									<th >Teacher</th>
									<th >Email</th>
									<th >Institution</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>{{ $teacher->user->id }}</td>
                                            
										<td >{{ $teacher->user->name }}</td>
										<td >{{ $teacher->user->email }}</td>
										<td >{{ $teacher->institution->name }}</td>
                                            <td>
                                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('teachers.show', $teacher->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('teachers.edit', $teacher->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $teachers->withQueryString()->links() !!}
            </div>
        </div>
    </div>
