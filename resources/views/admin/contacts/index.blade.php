@extends('admin.admin_dashboard')

@section('title', 'Support contact')


@section('body')

    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h1>Contact List</h1>
                    <a href="{{ route('contacts.create') }}" class="btn btn-primary mt-2">Add Contact</a>
                </div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>
                                        <a href="https://wa.me/{{ $contact->phone_number }}" target="_blank">
                                            {{ $contact->phone_number }}
                                        </a>
                                    </td>
                                    <td>
                                        <!-- Delete Button -->
                                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this contact?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
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
