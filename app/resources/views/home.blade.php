@extends('layouts.app')

@section('content')
<div>
    <section class="search">
        <div class="container">
            <div class="col-md-12">
                <search :searching="isSearching" v-on:search="search" v-on:type="type"></search>
            </div>
        </div>
    </section>
    <section class="tags">
        <div class="container">
            <div class="col-md-12">
                <p>Raffiner la recherche</p>
                
                <bs-select :choice="timetenseChoice" :choices="timetenseChoices" v-on:update="updateTimetense"></bs-select>

                <bs-select v-on:update="updateRegion" :choice="regionChoice" :choices="regionChoices"></bs-select>

                <bs-select v-on:update="updateEmission" :choice="emissionChoice" :choices="emissionChoices"></bs-select>
            </div>
        </div>
    </section>
    <section class="results" v-show="results.length > 0">
        <div class="container">
            <div class="col-md-12">
                <results :results="results"></results>
            </div>
        </div>
    </section>
    <section class="results" v-show="!haveResults">
        <div class="container">
            <div class="col-md-12">
                Aucun résultat
            </div>
        </div>
    </section>
</div>
@endsection
