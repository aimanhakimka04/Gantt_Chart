@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">
                    <i class="fas fa-calendar-alt"></i> Activity Calendar
                </h2>
            </div>
            <div class="card-body">
                @if($events->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Event Title</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td><strong>{{ $event->title }}</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}</td>
                                        <td>{{ $event->description ?? 'No description available' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No Events Found</h4>
                        <p class="text-muted">There are no events scheduled at the moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
