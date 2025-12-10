@extends('student.layout')

@section('title', 'Baholarim')
@section('page-title', 'Baholarim')

@section('content')


<div class="card">
    <div class="card-header">
        <h4>Baholar Jadvali</h4>
        <select class="form-select" style="width: 250px;">
            <option>Advanced English Grammar</option>
            <option>IELTS Speaking Preparation</option>
            <option>English for Beginners</option>
        </select>
    </div>
    <div class="card-body" style="overflow-x: auto;">
        <table class="table" style="min-width: 800px;">
            <thead style="background: #f8fafc;">
                <tr>
                    <th>Sana</th>
                    <th>Dars Mavzusi</th>
                    <th>Baho (1-5)</th>
                    <th>Izoh</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01.12.2025</td>
                    <td>Present Simple Tense</td>
                    <td><strong style="color: #10b981;">5</strong></td>
                    <td>Juda yaxshi</td>
                </tr>
                <tr>
                    <td>04.12.2025</td>
                    <td>Present Continuous</td>
                    <td><strong style="color: #3b82f6;">4</strong></td>
                    <td>Yaxshi</td>
                </tr>
                <tr>
                    <td>06.12.2025</td>
                    <td>Past Simple</td>
                    <td><strong style="color: #10b981;">5</strong></td>
                    <td>A'lo</td>
                </tr>
                <!-- Qo'shimcha qatorlar -->
            </tbody>
            <tfoot>
                <tr style="background: #f1f5f9;">
                    <td colspan="2"><strong>O'rtacha baho</strong></td>
                    <td colspan="2"><strong style="color: #10b981; font-size: 18px;">4.7</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection