@extends('table.main')
@section('studentContent')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">


        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <!--  <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button> -->
        </div>
    </div>



    <div class="table-responsive">
        @include ('addons.flash')
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subject</th>
                    <th>Score</th>
            
                </tr>
            </thead>
            <tbody>
                @foreach($allResults as $singleResult)
                <tr>
                    <td>{{$singleResult->subject_id}}</td>
                    <td>{{$singleResult->subject_name}}</td>
                    <td>{{$singleResult->score}}</td>
                    
                </tr>

                @endforeach


            </tbody>
        </table>
    </div>
</main>
</div>
</div>



@endsection