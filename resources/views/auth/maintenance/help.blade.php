@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <h3>Help</h3>
    <p></p>
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-body">
            <ul>
                <li><a class="help" href="#dashboard">Dashboard</a></li>
                <li><a class="help" href="#requests">Maintenance Requests</a></li>
                <li><a class="help" href="#password">Change Password</a></li>
                <li><a class="help" href="#logout">Log Out</li>
            </ul>
        </div>
    </div>

    <div class="heading"><h4><a name="dashboard">Dashboard</a></h4></div>
    <p>The maintenance dashboard allows maintenance staff to view an overview of open maintenance jobs categorised by 
        maintenance type. Users can click on each category to view a list of the open maintenance jobs in the selected 
        category.</p>

    <div class="heading"><h4><a name="requests">Maintenance Requests</a></h4></div>
    <p>Users can view a list of all open maintenance requests on this page. Users can view a list of all closed maintenance 
        requests by clicking on View closed jobs. </p>

    <h5>Submit Maintenance Requests</h5>
    <p>Users can submit new maintenance requests by clicking the Submit New button and completing the submission form with the 
        required details, including a maintenance type from the drop down list. Maintenance requests can be submitted for 
        either a resident, home or an area. When submitting a maintenance request, the user must select only on from either the 
        resident, home or area drop down lists. When all details have been added, click the Submit button to save and submit 
        the maintenance request.</p>

    <h5>View Maintenance Requests</h5>
    <p>The details of a specific maintenance request can be viewed by clicking on the eye icon under View in the list of maintenance 
        requests. Viewing the details of a specific request allows the user to send and receive correspondence from the resident 
        regarding the request. This can be executed by entering a message in the Message box and clicking the Submit button.</p>

    <h5>Edit Maintenance Requests</h5>
    <p>The status of a maintenance request can be updated by clicking on either Mark in Progress or Complete Job under Actions 
        when viewing the details of a request.</p>

    <h5>Print Maintenance Requests</h5>
    <p>Users can print the details of the maintenance request by clicking on Print under Actions when viewing the details of a 
        request.</p>
    
    <div class="heading"><h4><a name="password">Change Password</a></h4></div>
    <p>Users can change their password on this page by simply typing in their new password into both fields and clicking on the 
        Submit button to save the changes. It is recommended that users change their password upon logging in for the first 
        time.</p>

    <div class="heading"><h4><a name="logout">Log Out</a></h4></div>
    <p>Users can log out by clicking the arrow icon in the top right hand corner of each page. This will take the user back to 
        the login screen.</p>

</div>
@endsection
