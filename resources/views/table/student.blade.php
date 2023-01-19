
@extends('table.main')
@section('studentContent')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            </div>
        </div>
        <form method="get">
            <div class="row mb-3">
                <div class="col-12">
                    <h3><b>Filters</b></h3>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="name">Search by name</label>
                        <input type="text" class="form-control" placeholder="enter name" name="name" id="name" value="{{$name}}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="availability">Search by availability</label>
                        <select class="form-control" name="availability" id="availability">
                            <option value="" selected>select availability</option>
                            <option value="1" @if($availability == "1") selected @endif >Yes</option>
                            <option value="0" @if($availability == "0") selected @endif >No</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="sorting">Sort</label>
                        <select class="form-control" name="sorting" id="sorting">
                            <option value="" selected>select sorting order</option>
                            <option value="asc" @if($sorting == "asc") selected @endif >Ascending</option>
                            <option value="desc" @if($sorting == "desc") selected @endif >Descending</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <button type="submit" class="btn-primary btn mt-4">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    @include   ('addons.flash')
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Exam Availability</th>
                            <th>Exam Start Date</th>
                            <th>Deadline</th>
                            <th>Register</th>
                            <th>Start Exam</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <td>{{$subject->id}}</td>
                                <td>{{$subject->name}}</td>
                                @if ($subject->exam_availability ==1)
                                    <td>yes</td>
                                @else
                                    <td>No</td>
                                @endif

                                <td>{{$subject->exam_start_date}}</td>
                                <td>{{$subject->exam_deadline}}</td>

                                @if($subject->exam_deadline > date ('Y-m-d H:i:s') )
                                    <td><a class="btn btn-primary btn-sm" href="{{route('registerExam',['subject_id'=>$subject->id])}}">Register</a></td>
                                @else
                                    <td>deadline passed</td>
                                @endif

                                @if($subject->exam_start_date > date ('Y-m-d H:i:s'))
                                    <td></td>
                                @elseif($subject->exam_deadline > date ('Y-m-d H:i:s') )
                                    <td> <a class="btn btn-danger btn-sm" href="{{route('getTestQuestion',['subject_id'=>$subject->id])}}">Start Exam</a></td>
                                @else
                                    <td>deadline passed</td>
                                @endif


                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            {{$subjects->links('vendor.pagination.bootstrap-4')}}
        </div>
    </main>
@endsection
