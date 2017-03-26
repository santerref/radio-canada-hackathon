@extends('layouts.app')

@section('content')
<div>
    <section class="search">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <search v-on:search="search"></search>
            </div>
        </div>
    </section>
    <section class="tags">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <bs-select :choice="timetenseChoice" :choices="timetenseChoices" v-on:update="updateTimetense"></bs-select>

                <!-- Single button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Toutes les régions <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>

                <bs-select v-on:update="updateRegion" :choice="regionChoice" :choices="regionChoices"></bs-select>

                <bs-select v-on:update="updateEmission" :choice="emissionChoice" :choices="emissionChoices"></bs-select>
            </div>
        </div>
    </section>
    <section class="results" v-show="results.length > 0">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <results :results="results"></results>
            </div>
        </div>
    </section>
</div>
@endsection
