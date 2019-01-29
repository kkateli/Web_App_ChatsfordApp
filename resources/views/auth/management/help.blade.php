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
                            <li><a class="help" href="#dashboard">Dashboard</a></li>
                            <li><a class="help" href="#profile">My Profile</a></li>
                            <li><a class="help" href="#announcements">Announcements</a></li>
                            <li><a class="help" href="#residents">Residents</a></li>
                            <li><a class="help" href="#employees">Employees</a></li>
                            <li><a class="help" href="#requests">Maintenance Requests</a></li>
                            <li><a class="help" href="#complaints">Complaints</a></li>
                        </ul>
                    </div>

                    <div class="form-group col-md-6">
                        <ul>
                            <li><a class="help" href="#activities">Activities</a></li>
                            <li><a class="help" href="#menu">Meal Menu</a></li>
                            <li><a class="help" href="#homes">Homes</a></li>
                            <li><a class="help" href="#areas">Areas</a></li>
                            <li><a class="help" href="#mainttypes">Maintenance Types</a></li>
                            <li><a class="help" href="#logout">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="heading"><h4><a name="dashboard">Dashboard</a></h4></div>
    <p>The management dashboard provides an overview of the Chatsford Retirement Village, including open maintenance requests 
        and complaints, total residents and employees, total activities occurring today, and the current total of homes in the 
        retirement village. Users can access further details for each of these by clicking on the corresponding icon. Users 
        can also use the Quick Search to search the entire site for a specific word or phrase. Specific search bars can also 
        be found on the Residents, Employees, Homes and Areas pages. </p>

    <div class="heading"> <h4><a name="profile">My Profile</h4></div>
    <p>Users can view their personal information on this page.</p>

    <h5>Edit Your Information</h5>
    <p>Users can edit their information by clicking on the Edit Profile button on their profile page. The information can be 
        updated by editing the information on this page. Once completed, click the Submit button to save any changes that may 
        have been made.</p>

    <h5>Change Password</h5>
    <p>Users can change their password by clicking on the Change Password button on their profile page. The password can be 
        changed by simply typing the new password into both fields and clicking on the Submit button to save the changes. It 
        is recommended that users change their password upon logging in for the first time.</p>

    <div class="heading"> <h4><a name="announcements">Announcements</a></h4></div>
    <p>Users can view a list of all announcements on this page.</p>

    <h5>Create Announcements</h5>
    <p>A new announcement can be created by clicking the Add New button and completing the form with the required details. To 
        ensure the announcement is sent to corrects users, either All residents or Homes and/or areas must be checked. If All 
        residents is checked, the announcement will display in the dashboard of all residents. If all Homes and/or areas is 
        checked, the user can select a combination of one or multiple areas and one or multiple homes from the drop down lists. 
        The announcement will only be displayed for residents in the selected homes or areas.</p>

    <h5>View Announcements</h5>
    <p>The details of a specific announcement can be accessed by clicking the eye icon under View in the list of all 
        announcements. </p>

    <h5>Announcement Comments</h5>
    <p>Viewing the details of a specific announcements allows the user to send and receive correspondence from residents 
        regarding the announcements. This can be executed by entering a message in the Comment box and clicking the Submit 
        button.</p>

    <h5>Hide Announcements</h5>
    <p>The status of an announcement can be updated by clicking on Hide under Actions when viewing the details of an 
        announcement. This will remove the announcement from resident’s dashboards.</p>

    <h5>Repost Announcements</h5>
    <p>Users can report an announcement by selecting an announcement withe the status “Hidden” in the list of announcements 
        and click the eye icon under View. From there, users can click on Repost under Actions to add this announcement back 
        onto resident’s announcements.</p>

    <div class="heading"><h4><a name="residents">Residents</a></h4></div>
    <p>Users can view a list of all residents on this page. The search bar above the table of residents allows users to search 
        for specific residents. Further information regarding each resident can be accessed by clicking the eye icon under 
        View.</p>

    <h5>Add Residents</h5>
    <p>A new resident can be added by clicking the Add New button and completing the form with the required details, including 
        the residents home from the drop down list. Clicking the Submit button will save the new resident.</p>

    <h5>View Residents</h5>
    <p>A resident’s details can be accessed by clicking the eye icon under View in the list of all residents. This page 
        displays the current information regarding the corresponding resident, including any open maintenance requests and 
        complaints linked to the resident. Further information regarding each maintenance request and complaint can be 
        accessed by clicking the eye icon under View. </p>

    <h5>Edit Residents</h5>
    <p>The resident’s information can be edited by clicking on the icon under Edit Resident on the View Resident Details page. 
        Users can edit the resident’s information by altering the information on this page. Once completed, click the Submit 
        button to save any changes that have been made. A resident’s status can be changed to Inactive if they are no longer a 
        resident in the Chatsford Retirement Village.</p>

    <h5>Reset Resident's Password</h5>
    <p>A resident’s password can be changed by clicking on Reset Password under actions on the View Resident’s Details page. 
        Enter the new password into both fields and click the Submit button to save the new password.</p>

    <div class="heading"><h4><a name="employees">Employees</a></h4></div>
    <p>Users can view a list of all employees on this page. The search bar above the table of employees allows users to search 
        for specific employees. Further information regarding each employee can be accessed by clicking the eye icon under 
        View.</p>

    <h5>Add Employees</h5>
    <p>A new employee can be added by clicking the Add New button and completing the form with the required details, including 
        the employee type from the drop down list. Clicking the Submit button will save the new employee.</p>

    <h5>View Employees</h5>
    <p>An employee’s details can be accessed by clicking the eye icon under View in the list of all employees. This page 
        displays the current information regarding the corresponding employee. </p>

    <h5>Edit Employees</h5>
    <p>The employee’s information can be edited by clicking on Edit under Actions on the View Employee Details page. Users can 
        edit the employee’s information by altering the information on this page. Once completed, click the Submit button to 
        save any changes that have been made. An employee’s status can be changed to Inactive if they are no longer employed 
        by Chatsford Retirement Village.</p>

    <h5>Reset Employee's Password</h5>
    <p>An employee’s password can be changed by clicking on Reset Password under actions on the View Employee’s Details page. 
        Enter the new password into both fields and click the Submit button to save the new password.</p>

    <div class="heading"><h4><a name="requests">Maintenance Requests</a></h4></div>
    <p>Users can view a list of all open maintenance requests on this page. Users can view a list of all closed maintenance 
        requests by clicking on View closed jobs.</p>

    <h5>Submit Maintenance Requests</h5>
    <p>Users can submit new maintenance requests by clicking the Submit New button and completing the submission form with the 
        required details, including a maintenance type from the drop down list. Maintenance requests can be submitted for 
        either a resident, home or an area. When submitting a maintenance request, the user must select only on from either 
        the resident, home or area drop down lists. When all details have been added, click the Submit button to save and 
        submit the maintenance request.</p>

    <h5>View Maintenance Requests</h5>
    <p>The details of a specific maintenance request can be viewed by clicking on the eye icon under View in the list of 
        maintenance requests. Viewing the details of a specific request allows the user to send and receive correspondence 
        from the resident regarding the request. This can be executed by entering a message in the Message box and clicking 
        the Submit button.</p>

    <h5>Edit Maintenance Requests</h5>
    <p>The status of a maintenance request can be updated by clicking on either Mark in Progress or Complete Job under Actions 
        when viewing the details of a request.</p>

    <h5>Print Maintenance Requests</h5>
    <p>Users can print the details of the maintenance request by clicking on Print under Actions when viewing the details of a 
        request.</p>

    <div class="heading"><h4><a name="complaints">Complaints</a></h4></div>
    <p>Users can view a list of all open complaints to management on this page. Users can view a list of all resolved complaints 
        by clicking on View resolved complaints.</p>

    <h5>View Complaints</h5>
    <p>The details of a specific complaint can be viewed by clicking on the eye icon under View in the list of complaints. 
        Viewing the details of a specific complaint allows the user to send and receive correspondence from the resident 
        regarding the complaint. This can be executed by entering a message in the Message box and clicking the Submit button.</p>

    <h5>Resolve Complaints</h5>
    <p>Users can mark a complaint as resolved by clicking on Mark as resolved under Actions in the View Complaint Details page.</p> 

    <h5>Reopen Complaints</h5>
    <p>Users can reopen a complaint by finding the corresponding complaint in the list of resolved complaints viewing the 
        details of the complaint by clicking on the eye icon under View. On this next page, users can click on Reopen under 
        Actions to reopen the complaint.</p>

    <div class="heading"><h4><a name="activities">Activities</a></h4></div>
    <p>Users can view all activities on this page, including the number of residents registered for each event.</p>

    <h5>Create Activity</h5>
    <p>Users can create a new activity by clicking on the the Add New button and completing the form with the required details, 
        including a Date and Time.</p>

    <h5>View Activities</h5>
    <p>The details of a specific activity can be viewed by clicking on the eye icon under View in the list of activities. 
        Users can also view a list of residents registered for the activity.</p>

    <h5>Edit Activities</h5>
    <p>An activity’s information can be edited by clicking on Edit under Actions on the View Activity Details page. Users can 
        edit the activity’s information by altering the information on this page. Once completed, click the Submit button to 
        save any changes that have been made. </p>

    <h5>Register Resident for an Activity</h5>
    <p>Users can register a resident for an activity by clicking on Register resident’s interest under Actions on the View 
        Activity Details page. Simply select a resident from the drop down list and click Submit to register the resident.</p>
    
    <h5>Cancel Resident't Interest in an Activity</h5>
    <p>Users can cancel a resident’s interest in an activity by clicking on Cancel resident’s interest next to the specific 
        resident on the View Activity Details page.</p>

    <div class="heading"><h4><a name="menu">Meal Menu</a></h4></div>
    <p>Users can create and view meal menus on this page.</p>

    <h5>Add Meal Menu</h5>
    <p>Users can add a new menu by clicking on the Add New button. Users can add a new menu for an entire week by selecting 
        the Start date and Ends date from the drop down calendar.</p>
    <p>Once the dates are selected, users can click on the Submit button. This will take the user to a new page where they can
        enter the meal details for the entire week. Once all details are entered, click on the Submit button to save the new 
        menu.</p>

    <h5>View Meal Menu</h5>
    <p>Users can view a specific week’s menu by clicking on the eye icon under View in the list of all menus.</p>

    <h5>Edit Meal Menu</h5>
    <p>Users can edit the menu for a specific day by clicking on Edit next to the meal they want to edit and updating the meal 
        details. Once completed, click on the Submit button to save any changes made.</p>

    <div class="heading"><h4><a name="homes">Homes</a></h4></div>
    <p>Users can view a list of all residential homes in the Chatsford Retirement Village on this page. The search bar above 
        the table of homes allows users to search for specific homes. </p>

    <h5>Add Homes</h5>
    <p>A new home can be created by clicking the Add New button and completing the form with the required details, including 
        the area from the drop down list. Clicking the Submit button will save the new home.</p>

    <h5>View Homes</h5>
    <p>A home’s details can be accessed by clicking the eye icon under View in the list of all homes. This page displays the 
        current information regarding the corresponding home, including all open maintenance requests and complaints for the 
        selected home.</p>

    <h5>Edit Homes</h5>
    <p>The details of a specific home can be edited by clicking on Edit under Actions on the View Homes page. Users can edit 
        the home’s information by altering the information on this page. Once completed, click the Submit button to save any 
        changes that have been made.</p>

    <div class="heading"><h4><a name="areas">Areas</a></h4></div>
    <p>Users can view a list of all residential areas in the Chatsford Retirement Village on this page. The search bar above 
        the table of areas allows users to search for specific areas. </p>

    <h5>Add Areas</h5>
    <p>A new area can be created by clicking the Add New button and completing the form with the required detail. Clicking the 
        Submit button will save the new area.</p>

    <h5>Edit Areas</h5>
    <p>The name of a specific area can be edited by clicking on the icon under Edit in the list of areas and editing the 
        information on this page. Once completed, click the Submit button to save any changes that may have been made.</p>

    <div class="heading"><h4><a name="mainttypes">Maintenance Types</a></h4></div>
    <p>Users can view a list of all maintenance request types on this page.</p>

    <h5>Add Maintenance Types</h5>
    <p>A new maintenance request type can be created by clicking the Add New button and completing the form with the required 
        details, including selecting an icon to be shown on the Maintenance users dashboard. Clicking the Submit button will 
        save the new maintenance request type.</p>
 
    <h5>View Maintenance Types</h5>
    <p>Users can view the details of a specific maintenance request type by clicking on the eye icon under View in the list of 
        all maintenance request types.</p>

    <h5>Edit Maintenance Types</h5>
    <p>Users can edit a maintenance request type by clicking on Edit under Actions on the View Maintenance Request Type page. 
        Users can change the name of the maintenance request type and change the icon which is displayed on the Maintenance 
        users dashboard. Once completed, click on the Submit button to save any changes that have been made.</p>

    <div class="heading"><h4><a name="logout">Log Out</a></h4></div>
    <p>Users can log out by clicking the arrow icon in the top right hand corner of each page. This will take the user back to 
        the login screen.</p>

</div>
@endsection
