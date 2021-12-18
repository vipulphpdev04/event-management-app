@extends('layouts.app')

@section('content')

<style type="text/css">
    .error{
        color:red;
    }
</style>

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Add Event Page') }}</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <form name="addEvent" id="addEvent" action="{{ route('event.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="eventTitle" class="form-label">Event Title:</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="">
                      </div>

                      <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date:</label>
                        <input type="text" name="start_date" class="form-control" id="start_date" placeholder="">
                      </div>
                      <div class="mb-3">
                        <label for="endDate" class="form-label">End Date:</label>
                        <input type="text" name="end_date" class="form-control" id="end_date" placeholder="">
                      </div>

                      <div class="mb-3">
                        <label for="endDate" class="form-label">Recurrence:</label>

                        {{-- <input class="form-check-input" type="radio" value="Repeat" name="recurrence_type" id="recurrence_type">
                        <label class="form-check-label" for="Repeat">
                            Repeat
                        </label>
                        <br>
                        <input class="form-check-input" type="radio" value="Repeat on the" name="recurrence_type" id="recurrence_type">
                        <label class="form-check-label" for="Repeat on the">
                            Repeat on the
                        </label> --}}

                        <input id="occurence" name="occurence" tabindex="9" type="radio" value="Repeat" checked /><label
                        for="recurrence_type"><span style="font-size: 10pt; font-family: Verdana">Repeat</span></label>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<select id="lstRepeatType" class="textbox-medium"
                        name="type1" style="font-size: x-small; width: 100px; font-family: Verdana"
                        tabindex="10">
                        <option selected="selected" value="Every">Every</option>
                        <option value="Every Other">Every Other</option>
                        <option value="Every Third">Every Third</option>
                        <option value="Every Fourth">Every Fourth</option>
                    </select>
                    <select id="lstEvery" class="textbox-medium" name="type2" style="font-size: x-small;
                        width: 66px; font-family: Verdana" tabindex="10">
                        <option selected="selected" value="Day">Day</option>
                        <option value="Week">Week</option>
                        <option value="Month">Month</option>
                        <option value="Year">Year</option>
                    </select>

                    <br><span style="margin-left:80px;"></label>

                    <INPUT id="occurence" tabIndex=11 type=radio value="Repeat on the"
                    name="occurence" /><span style="font-size: 10pt; font-family: Verdana">Repeat on the
                        <select id="lstRepeatOn" class="textbox-middle" name="type3" style="font-size: x-small;
                            width: 68px; font-family: Verdana" tabindex="12">
                            <option selected="selected" value="First">First</option>
                            <option value="Second">Second</option>
                            <option value="Third">Third</option>
                            <option value="Fourth">Fourth</option>
                        </select>
                    </span>&nbsp;<select id="lstRepeatWeek" class="textbox-middle" name="type4"
                        style="font-size: x-small; width: 56px; font-family: Verdana" tabindex="13">
                        <option selected="selected" value="0">Sun</option>
                        <option value="Mon">Mon</option>
                        <option value="Tue">Tue</option>
                        <option value="Wed">Wed</option>
                        <option value="Thu">Thu</option>
                        <option value="Fri">Fri</option>
                        <option value="Sat">Sat</option>
                    </select>
                                        of the
                                        <select id="lstRepeatMonth" class="textbox-middle" language="javascript" name="type5"
                                            style="font-size: x-small; width: 80px;
                                            font-family: Verdana" tabindex="14">
                                            <option selected="selected" value="Month">Month</option>
                                            <option value="3 Months">3 Months</option>
                                            <option value="4 Months">4 Months</option>
                                            <option value="6 Months">6 Months</option>
                                            <option value="12 Year">Year</option>
                                        </select>

                      </div>

                      <div class="mb-3">
                        <input class="btn btn-primary" type="submit" value="Submit">
                      </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
$(document).ready(function() {
    $("#addEvent").validate({
        rules: {
            title: 'required',
            start_date: 'required',
            end_date: 'required',
            occurence: {
               required: true,
            },
         },
        messages: {
            title: {
                required: "Please enter title",
            },
            start_date: {
                required: "Please select start date",
            },
            end_date: {
                required: 'Please select end date',
            },
            occurence: {
                required: 'Please select any Recurrence',
            },
        },
    });
});
@endsection
