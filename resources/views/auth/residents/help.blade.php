@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <h3>Help</h3>
    <p></p>
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-body">
            <div class="form-group contents">
                <div class="row">
                    <div class="form-group col-md-6">
                        <ul>
                            <li><a class="help" href="#announcements">Announcements</a></li>
                            <li><a class="help" href="#profile">My Profile</a></li>
                            <li><a class="help" href="#activities">Activities</a></li>
                            <li><a class="help" href="#menu">Meal Menu</a></li>
                        </ul>
                    </div>

                    <div class="form-group col-md-6">
                        <ul>
                            <li><a class="help" href="#requests">Maintenance Requests</a></li>
                            <li><a class="help" href="#complaints">Complaints</a></li>
                            <li><a class="help" href="#logout">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="heading"><h4><a name="announcements">Announcements</a></h4></div>
    <p>Residents can view all the current announcements on this page.</p>

    <h5>View Announcements</h5>
    <p>Residents can view the details of a specific announcement by clicking on the announcement title for the announcement 
        they wish to view.</p>

    <h5>Announcement Comments</h5>
    <p>Viewing the details of a specific announcements allows the user to send and receive correspondence from management staff 
        regarding the announcements. This can be executed by entering a message in the Comment box and clicking the Submit 
        button.</p>

    <div class="heading"><h4><a name="profile">My Profile</a></h4></div>
    <p>Residents can view their personal information on this page, including the number of open complaints and maintenance 
        requests and how many activities they have scheduled for the day. Clicking on any of these 3 numbers will take the 
        resident to the corresponding page where they can access further information regarding each of these.</p>

    <h5>Edit Personal Information</h5>
    <p>Residents can edit their information by clicking on the Edit Profile button on their profile page. The information can 
        be updated by editing the information on this page. Once completed, click the Submit button to save any changes that 
        may have been made.</p>

    <h5>Change Password</h5>
    <p>Users can change their password by clicking on the Change Password button on their profile page. The password can be 
        changed by simply typing the new password into both fields and clicking on the Submit button to save the changes. It is 
        recommended that users change their password upon logging in for the first time.</p>

    <div class="heading"><h4><a name="activities">Activities</a></h4></div>
    <p>Residents can view the upcoming activities that they have registered for on this page.</p>
    
    <h5>Cancel Interest in an Activity</h5>
    <p>Residents can cancel their interest in an activity by clicking on Cancel your Interest for the chosen activity.</p>

    <h5>Upcoming Activities</h5>
    <p>Residents can view all upcoming activities on this page.</p>

    <h5>Register for an Activity</h5>
    <p>Residents can register for an activity by clicking on Register your Interest for the chosen activity. This will add the 
        activity to the Your activities page.</p>
    
    <h5>Past Activities</h5>
    <p>Residents can view a list of all past activities on this page.</p>

    <div class="heading"><h4><a name="menu">Meal Menu</a></h4></div>
    <p>Residents can view the weekly menu on this page. </p>

    <div class="heading"><h4><a name="requests">Maintenance Requests</a></h4></div>
    <p>Residents can view a list of their open maintenance requests on this page. Residents can view their closed maintenance 
        requests by clicking on View closed jobs.</p>
 
    <h5>Submit Maintenance Requests</h5>
    <p>Residents can submit new maintenance requests by clicking the Submit New button and completing the submission form with 
        the required details, including a maintenance type selected from the drop down list. When all details have been added, 
        click the Submit button to save the maintenance request.</p>

    <h5>View Maintenance Requests</h5>
    <p>Residents can view the details of each request by clicking the eye icon under View in their list of open maintenance 
        requests. Viewing the details of a specific request allows residents to send and receive correspondence from management 
        and maintenance staff regarding the request. This can be executed by entering a message in the Message box and clicking 
        the Submit button. </p>

    <div class="heading"><h4><a name="complaints">Complaints</a></h4></div>
    <p>Residents can view a list of their open complaints to management staff on this page. Residents can view their resolved 
        complaints by clicking on View resolved complaints.</p>

    <h5>Submit Complaints</h5>
    <p>Residents can submit new complaints by clicking the Submit New button and completing the submission form with the 
        required details. Once all details have been entered, click the Submit button to save the complaint.</p>
    
    <h5>View Complaints</h5>
    <p>Residents can view the details of each complaint by clicking the eye icon under View in their list of open complaints. 
        Viewing the details of a specific complaint allows residents to send and receive correspondence from management staff 
        regarding the complaint. This can be executed by entering a message in the Message box and clicking the Submit button. </p>

    <h5>Resolve Complaints</h5>
    <p>Users can mark a complaint as resolved by clicking on Mark as resolved under Actions in the View Complaint Details page. </p>

    <h5>Reopen Complaints</h5>
    <p>Users can reopen a complaint by finding the corresponding complaint in the list of resolved complaints viewing the 
        details of the complaint by clicking on the eye icon under View. On this next page, users can click on Reopen under 
        Actions to reopen the complaint.</p>

    <div class="heading"><h4><a name="logout">Log Out</a></h4></div>
    <p>Users can log out by clicking the arrow icon in the top right hand corner of each page. This will take the user back to 
        the login screen.</p>

</div>
@endsection
