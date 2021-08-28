@extends('layouts.master')
@section('body-class', 'page-sidebar-collapsed')
@section('styles')
        <link href="{{ asset('assets/plugins/fullcalendar/main.min.css') }}" rel="stylesheet">
@endsection


@section('content')
        <div class="page-container">
          @include('layouts.components.sidebar')
            <div class="page-content">
                @include('layouts.components.page-header', ['title' => 'Calender'])
                <div class="main-wrapper">
                    <div class="row">
                      <div class="col">
                        <div class="card">
                          <div class="card-body">
                            <div id='calendar'></div>
                          </div>
                        </div>
                      </div>
                    </div>
                      </div>
              @include('layouts.components.footer')
            </div>
        </div>
        @include('layouts.components.sidebar-overlay')
      @endsection

    @section('scripts')
        <script src="{{ asset('assets/plugins/fullcalendar/main.min.js') }}"></script>
                <script>

          document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',

    events: 'https://fullcalendar.io/demo-events.json?overload-day'
            });
            calendar.render();
          });
    
        </script>
    @endsection