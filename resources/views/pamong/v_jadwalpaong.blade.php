@extends('pamong.templatepamong')

@section('content')
<h1 class="text-2xl font-bold mb-6">Jadwal Kalender</h1>

<div id="calendar" class="bg-white p-4 rounded shadow"></div>
@endsection

@section('scripts')
<!-- FullCalendar JS & CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek', // Tampilan mingguan
            slotMinTime: "07:00:00",
            slotMaxTime: "21:00:00",
            allDaySlot: false,
            events: @json($events), // Data event dari controller
            locale: 'id', // Bahasa Indonesia
            height: 'auto'
        });

        calendar.render();
    });
</script>
@endsection
