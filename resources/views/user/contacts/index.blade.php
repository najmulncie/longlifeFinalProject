@extends('user.user_dashboard')

@section('title', 'Contact support')

@section('body')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Contact</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive table-bordered">
                            <thead>
                            <tr>
{{--                                <th>Name</th>--}}
{{--                                <th>Phone Number</th>--}}

                            </tr>
                            </thead>
                            <tbody>
                            <p class="text-center">Click on the number to open WhatsApp.</p>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td class="fs-5">{{ $contact->name }}</td>
                                        <td>
                                            <!-- WhatsApp Link -->
                                            <a class="btn btn-primary fs-3" href="https://wa.me/{{ $contact->phone_number }}" target="_blank">
                                                {{ $contact->phone_number }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
