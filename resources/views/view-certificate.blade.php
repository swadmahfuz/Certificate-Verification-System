<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>View Certificate Information</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />     
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    </head>
    <body background="../images/tuv-login-background1.jpg">
        <section style="padding-top: 60px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-header" ><center><h3>Detailed Certificate Information</h3></center>
                                <center>
                                    <a href="../dashboard" class="btn btn-primary">Go back to Dashboard</a>
                                    <a href="../add-certificate" class="btn btn-success">Add New Certificate</a> 
                                    <a href="../edit-certificate/{{ $certificate->id }}" class="btn btn-warning">Edit Certificate</a>
                                    <a href="../delete-certificate/{{ $certificate->id }}" class="btn btn-danger">Delete Certificate</a>
                                </center> 
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" style="width:60%; margin-left:20%; margin-right:20%; border: 1px solid black;">

                                    <tr>
                                        <th>Certificate Number</th>
                                        <td>{{ $certificate->certificate_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Certificate Status</th>
                                        <td>
                                            @if (empty($certificate->expiry_date) || \Carbon\Carbon::now() <= \Carbon\Carbon::parse($certificate->expiry_date))
                                                <span style="color: green;">Certificate Valid! ✅</span>
                                            @else
                                                <span style="color: red;">Certificate Expired! ⚠️</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $certificate->participant_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Passport/NID</th>
                                        <td>{{ $certificate->passport_nid }}</td>
                                    </tr>
                                    <tr>
                                        <th>Driving License</th>
                                        <td>{{ $certificate->driving_license }}</td>
                                    </tr>
                                    <tr>
                                        <th>Company</th>
                                        <td>{{ $certificate->company }}</td>
                                    </tr>
                                    <tr>
                                        <th>Training</th>
                                        <td>{{ $certificate->training_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Training Location</th>
                                        <td>{{ $certificate->location }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trainer</th>
                                        <td>{{ $certificate->trainer }}</td>
                                    </tr>
                                    <tr>
                                        <th>Training Start Date</th>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $certificate->training_date)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Training End Date</th>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $certificate->training_end)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Issue Date</th>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $certificate->issue_date)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Valid Till</th>
                                        @if (!empty($certificate->expiry_date))
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $certificate->expiry_date)->format('d M Y') }}</td>
                                        @else
                                            <td>No Expiry Date</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th>Created by</th>
                                        <td>{{ $certificate->created_by }}</td>
                                    </tr>
                                    <tr>
                                        <th>QR Code</th>
                                        @php
                                            $url = url('');  ///capture server url
                                            $verification_url = $url.'?search='.$certificate->certificate_number;   ///concat server url with verification link and certificate number
                                        @endphp
                                        {{-- The line below uses generate qr code image --}}
                                        <td><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $verification_url }}"/></td>
                                    </tr>
                                    <tr>
                                        <th>Last Updated by</th>
                                        <td>{{ $certificate->updated_by }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Updated on</th>
                                        <td>
                                            <!-- Ensures it will only show when a user updates a certificate after uploading -->
                                            @if ($certificate->updated_by)
                                                {{ $certificate->updated_at->format('d M Y \a\t H:i:s') }} 
                                            @else
                                                
                                            @endif
                                        </td>
                                    </tr>   
                                    <tr>
                                        <th>Deleted by</th>
                                        <td>{{ $certificate->deleted_by }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
    @include('layouts.footer')  <!-- Including the footer Blade file -->
</html>
