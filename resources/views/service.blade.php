@extends('includes.layout')

@section('content')

    <!-- top-agency-area-start -->
    <div class="top-agency-area" id="_top_agency">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-12">
                    <div class="section-title">
                        <h2>Our Services</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="top-agencey-content">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="single-top-agency">
                                    <div class="icon">
                                        <span class="bg-recruitement"></span>
                                    </div>
                                    <h6 class="name">Recruitment</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="single-top-agency">
                                    <div class="icon">
                                        <span class="bg-staff"></span>
                                    </div>
                                    <h6 class="name">Staffing</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="single-top-agency">
                                    <div class="icon">
                                        <span class="bg-training"></span>
                                    </div>
                                    <h6 class="name">Training and Development</h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- top-agency-area-end -->

    <!-- welcome-area-start -->
    <div class="welcome-area">
        <div class="welcome-banner d-none d-lg-block"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-1 col-md-10 offset-md-1 col-sm-12 col-12">
                    <div class="section-title">
                        <h2>Welcome To Our Consulting Agency</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="welcome-faq">
                        <div class="accordion" id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link recruitment" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Recruitment</button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="text-justify">
                                            In KUKULKAN, we are finding and hiring the best and most qualified candidate
                                            for your job openings, in a timely and cost-effective manner. It’s the
                                            process of searching for prospective employees and stimulating and
                                            encouraging them to apply for your organization.
                                        </div>

                                        <div class="text-justify">
                                            Our core activities towards the process are such as, Advertising vacancies,
                                            Conducting job interviews, Initial Screening, Performing background checks,
                                            Reviewing application documents and credentials.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link staffing" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">Staffing</button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <h6>Long term </h6>
                                        <div class="text-justify">
                                            KUKULKAN hires its own employees and assigns them to support or supplement a
                                            client’s workforce on longer-term assignments. Employees are recruited,
                                            screened, and assigned by us.
                                        </div>
                                        <h6>Short term</h6>
                                        <div class="text-justify">
                                            KUKULKAN hires its own employees and assigns them to support or supplement a
                                            client’s workforce to keep fully staffed during busy times, gain special
                                            expertise or staff special projects, or fill temporary vacancies. Employees
                                            are recruited, screened, and assigned by us.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link training" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">Training and Development</button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="text-justify">
                                            Our Training and development programs are designed according to the
                                            requirements of the organization, the type and skills of employees being
                                            trained, the end goals of the training and the job profile of the employees.
                                        </div>
                                        <div class="text-justify">
                                            KUKULKAN provides Different training to employees at different levels. The
                                            following training methods are used For the training of skilled workers and
                                            operators-Specific job training programs, Technical training at a training
                                            with live demos, Internship training, Training via the process of rotation
                                            of job. </div>
                                        <h6>Textiles</h6>
                                        <ol>
                                            <li>Work Culture Analysis</li>
                                            <li> Customer Relationship Management</li>
                                            <li>Creative Selling Techniques</li>
                                            <li>Brand Management &Promotion</li>
                                            <li> Problem Solving Skills</li>
                                        </ol>


                                        <h6>Jewellery</h6>
                                        <ol>
                                            <li>SWOT Analysis</li>
                                            <li>Goal Setting</li>
                                            <li>Innovative Marketing Techniques</li>
                                            <li>Handling peer pressure</li>
                                            <li>Objection Handling techniques</li>
                                        </ol>

                                        <h6> Food &beverages</h6>
                                        <ol>
                                            <li>Health Management</li>
                                            <li>Self Motivation</li>
                                            <li>Value Added Services Managements</li>
                                            <li>Peer Pressure Management</li>
                                            <li>Cross Selling Techniques</li>
                                        </ol>

                                        <h6>Educational Institution</h6>
                                        <ol>
                                            <li>Creative Study Techniques</li>
                                            <li>Intelligent Quotient Enhancement techniques</li>
                                            <li>Placement Techniques</li>
                                            <li>Language Development Skills</li>
                                            <li>Life Management Skills </li>
                                        </ol>

                                        <h6>Corporates</h6>
                                        <ol>
                                            <li>Time Management</li>
                                            <li>Stress Management</li>
                                            <li>Team Building Skills</li>
                                            <li>Emotional Intelligence</li>
                                            <li>Work Life Balance </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="wf-contact">
                            <a href="{{url('contact')}}" class="text" style="margin-right: 45px;">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- welcome-area-end -->
@endsection

@section('scripts')
    <?php
    if(isset($type)) {
        echo "<script>";
        if($type == 'recruitment') {
            echo "$('.recruitment').click()";
        } else if($type == 'staffing') {
            echo "$('.staffing').click()";
        } else if($type == 'training') {
            echo "$('.training').click()";
        }
        echo "</script>";
    }
    ?>
@endsection