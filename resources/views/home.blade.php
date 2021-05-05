@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(auth()->user()->roles->contains(1))
                    <div class="row">
                        <div class="{{ $settings1['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings1['total_number']) }}</div>
                                    <div>{{ $settings1['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings2['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings2['total_number']) }}</div>
                                    <div>{{ $settings2['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
               @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body center mx-auto">
                                      <button type="button" class="btn btn-primary">
                                        Total <span class="badge badge-light">4</span>
                                      </button>
                                      <button type="button" class="btn btn-primary">
                                        Vérifié(s) <span class="badge badge-success">4</span>
                                      </button>
                                      <button type="button" class="btn btn-primary">
                                        Rejetté(s) <span class="badge badge-danger">4</span>
                                      </button>
                                      <button type="button" class="btn btn-primary">
                                        En cours <span class="badge badge-info">4</span>
                                      </button>
  
                                </div>
                            </div>
                        </div>
                    </div>



                    
                </div>
            </div>
           {{-- delai --}}
           <div class="alert alert-danger " role="alert">
            Dernier délai de depot des dossier : <b>30/05/2022</b> à minuit
          </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection