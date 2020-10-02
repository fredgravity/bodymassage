@extends('admin.layout.base')
@section('title', 'Graph')
@section('data-page-id', 'graph_details')


@section('content')


    <div class="grid-container fluid product">

        <h2 class="text-center">Payment Graph</h2>
        <hr>

        <section>


            <div class="grid-padding-x grid-x graph">
                <div class="small-12 medium-12 cell monthly-revenue">
                    <div class="card">

                        <div class="card-section">
                            <h4>Monthly Revenue</h4>
                            <canvas id="monthly-revenue"></canvas>
                        </div>

                    </div>
                </div>

            </div>

        </section>

    </div>



    

    @endsection









