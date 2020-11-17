@extends('phonebooks.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Electronic Phonebook</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('phonebooks.create') }}"> Create New Number</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Numbers</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($phonebooks as $data)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->number }}</td>
                <td>
                    <form action="{{ route('phonebooks.destroy',$data->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('phonebooks.show',$data->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('phonebooks.edit',$data->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $phonebooks->links() !!}

@endsection
