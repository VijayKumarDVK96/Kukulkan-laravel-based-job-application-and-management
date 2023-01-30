@extends('includes.admin-layout')

@section('title', 'Dashboard')

@section('styles')
  <link href="{{url('admin-assets/plugins/morris/css/morris.css')}}" rel="stylesheet">
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card bg-transparent mt-3 shadow-none border border-light">
        <div class="card-content">
          <div class="row row-group m-0">
            <div class="col-12 col-lg-2 col-xl-3 border-light">
              <div class="card-body bg-white">
                <div class="media">
                  <div class="media-body text-left">
                    <h4 class="text-info">{{$count->candidates}}</h4>
                    <span>Total Candidates</span>
                  </div>
                  <div class="align-self-center w-circle-icon rounded bg-info shadow-info">
                    <i class="icon-user text-white"></i></div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
              <div class="card-body bg-white">
                <div class="media">
                  <div class="media-body text-left">
                    <h4 class="text-danger">{{$count->employers}}</h4>
                    <span>Total Employers</span>
                  </div>
                  <div class="align-self-center w-circle-icon rounded bg-danger shadow-danger">
                    <i class="icon-people text-white"></i></div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
              <div class="card-body bg-white">
                <div class="media">
                  <div class="media-body text-left">
                    <h4 class="text-success">{{$count->requirements}}</h4>
                    <span>Total Jobs</span>
                  </div>
                  <div class="align-self-center w-circle-icon rounded bg-success shadow-success">
                    <i class="icon-briefcase text-white"></i></div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
              <div class="card-body bg-white">
                <div class="media">
                  <div class="media-body text-left">
                  <h4 class="text-warning">{{$count->pending_candidates}}</h4>
                    <span>New Candidates</span>
                  </div>
                  <div class="align-self-center w-circle-icon rounded bg-warning shadow-warning">
                    <i class="icon-user-following text-white"></i></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-lg-8 col-xl-8">
          <div class="card shadow-none border border-light">
            <div class="card-header  border-light">
              MONTHLY SUMMARY
            </div>
            <div class="card-body">
              <span><i class="candidates"></i>Candidates</span>
              <span><i class="employers"></i>Employers</span>
              <div id="monthly_summary" style="height:300px;"></div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card">
            <div class="card-header text-uppercase">GENDER SUMMARY</div>
            <div class="card-body">
              <div id="gender_summary" style="height:320px;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End container-fluid-->
  </div>
  <!--End content-wrapper-->
@endsection

@section('scripts')
  <script src="{{url('admin-assets/plugins/Chart.js/Chart.min.js')}}"></script>
  <script src="{{url('admin-assets/plugins/raphael/raphael-min.js')}}"></script>
  <script src="{{url('admin-assets/plugins/morris/js/morris.js')}}"></script>
  <script src="{{url('admin-assets/js/index.js')}}"></script>

  <script>
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    Morris.Area({
      element: 'monthly_summary',
      data: [
        @foreach($summary as $value)
        {
          month: '{{$value["month"]}}',
          Candidates: {{$value["candidates"]}},
          Employers: {{$value["employers"]}}
        },
        @endforeach
      ],
      xkey: 'month',
      ykeys: ['Candidates', 'Employers'],
      labels: ['Candidates', 'Employers'],
      xLabelFormat: function (x) { // <--- x.getMonth() returns valid index
        var month = months[x.getMonth()];
        return month;
      },
      dateFormat: function (x) {
        var month = months[new Date(x).getMonth()];
        return month;
      },
      pointSize: 3,
      fillOpacity: 0,
      pointStrokeColors: ['#008cff', '#15ca20'],
      behaveLikeLine: true,
      gridLineColor: '#e0e0e0',
      lineWidth: 3,
      hideHover: 'auto',
      lineColors: ['#008cff', '#15ca20'],
      resize: true
    });
  </script>

  <script>
    Morris.Donut({
      element: 'gender_summary',
      data: [{
          label: "Male Candidates",
          value: {{$gender_summary[0]->male}},
      },{
          label: "Female Candidates",
          value: {{$gender_summary[0]->female}}
      }],
      resize: true,
      colors:['#008cff', '#15ca20']
    });
  </script>
@endsection