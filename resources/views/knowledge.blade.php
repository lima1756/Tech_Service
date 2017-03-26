@extends('layouts.mortalLayout')
    @section('feature')
        <!--Feature-->
        
        <section id ="feature" class="section-padding">
        <?php
          $questions= DB::table('knowledge')->get();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-med-12">
                    <div class="page-header">
                        <h1>Lorem ipsum dolor sit amet<small>consectetur adipisicing elit. Repellendus accusantium sequi</small></h1>
                    </div>
                </div>
                <div class="col-med-12">
                    
                </div>
                </div>
        </div>
        </section>
        <!--/ feature-->
        @endsection
    @section('extra')
        
    @endsection