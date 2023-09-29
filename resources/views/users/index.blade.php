@extends('layouts.main')
@section('maincontent')
    <div class="container">
        <div class="row">
            <div class="col">
                    <a class="btn btn-primary" href="{{route('users.create')}}">Create User</a>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Address</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $myuser)
                                <tr>
                                    <th scope="row">{{$myuser->id}}</th>
                                    <td>{{$myuser->name}}</td>
                                    <td>{{$myuser->email}}</td>
                                    <td>{{$myuser->surname}}</td>
                                    <td>{{$myuser->address}}</td>
                                    <td>
                                        <a href="{{ route('users.edit',$myuser->id) }}" class="btn btn-primary">Edit Now</a>
                                    </td>
                                    <td>
                                        @if ($myuser->trashed())
                                        <form action="{{ route('users.restore', $myuser->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Restore    </button>
                                        </form>
                                        @else
                                        <form action="{{ route('users.destroy', $myuser->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Deleted Now</button>
                                        </form>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                      </table>
            </div>
        </div>
    </div>
 @endsection


