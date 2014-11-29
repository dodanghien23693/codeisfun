<form id="rootwizard-2" method="post" action="" class="form-wizard validate" novalidate="novalidate">

    <div class="steps-progress" style="margin-left: 10%; margin-right: 10%;">
        <div class="progress-indicator" style="width: 0px;"></div>
    </div>

    <ul>
        <li class="active">
            <a href="#tab2-1" data-toggle="tab"><span>1</span>Personal Info</a>
        </li>
        <li class="">
            <a href="#tab2-2" data-toggle="tab"><span>2</span>Address</a>
        </li>
        <li>
            <a href="#tab2-3" data-toggle="tab"><span>3</span>Education</a>
        </li>
        <li>
            <a href="#tab2-4" data-toggle="tab"><span>4</span>Work Experience</a>
        </li>
        <li>
            <a href="#tab2-5" data-toggle="tab"><span>5</span>Register</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="tab2-1">

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="full_name">Full Name</label>
                        <input class="form-control" name="full_name" id="full_name" data-validate="required" placeholder="Your full name"><span for="full_name" class="validate-has-error" style="display: none;">This field is required.</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="birthdate">Date of Birth</label>
                        <input class="form-control" name="birthdate" id="birthdate" data-validate="required" data-mask="date" placeholder="Pre-formatted birth date"><span for="birthdate" class="validate-has-error" style="display: none;">This field is required.</span>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label" for="about">Write Something About You</label>
                        <textarea class="form-control autogrow" name="about" id="about" data-validate="minlength[10]" rows="5" placeholder="Could be used also as Motivation Letter" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 99px;"></textarea>
                    </div>
                </div>

            </div>

        </div>

        <div class="tab-pane" id="tab2-2">

            <div class="row">

                <div class="col-md-8">
                    <div class="form-group validate-has-error">
                        <label class="control-label" for="street">Street</label>
                        <input class="form-control" name="street" id="street" data-validate="required" placeholder="Enter your street address"><span for="street" class="validate-has-error">This field is required.</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="door_no">Door no.</label>
                        <input class="form-control" name="door_no" id="door_no" data-validate="number" placeholder="Numbers only">
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label" for="address_line_2">Address Line 2</label>
                        <input class="form-control" name="address_line_2" id="address_line_2" placeholder="(Optional) Secondary Address">
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-5">
                    <div class="form-group validate-has-error">
                        <label class="control-label" for="city">City</label>
                        <input class="form-control" name="city" id="city" data-validate="required" placeholder="Current city"><span for="city" class="validate-has-error">This field is required.</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="state">State</label>

                        <select name="test" class="selectboxit visible" style="display: none;">
                            <optgroup label="United States">
                                <option value="1">Alabama</option>
                                <option value="2">Boston</option>
                                <option value="3">Ohaio</option>
                                <option value="4">New York</option>
                                <option value="5">Washington</option>
                            </optgroup>
                        </select><span id="" class="selectboxit-container selectboxit-container" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" aria-owns=""><span id="" class="selectboxit selectboxit visible selectboxit-enabled selectboxit-btn" name="test" tabindex="0" unselectable="on" style="width: 111px;"><span class="selectboxit-option-icon-container"><i id="" class="selectboxit-default-icon selectboxit-option-icon selectboxit-container" unselectable="on"></i></span><span id="" class="selectboxit-text" unselectable="on" data-val="1" aria-live="polite" style="max-width: 21px;">Alabama</span><span id="" class="selectboxit-arrow-container" unselectable="on"><i id="" class="selectboxit-arrow selectboxit-default-arrow" unselectable="on"></i></span></span><ul class="selectboxit-options selectboxit-list" tabindex="-1" role="listbox" aria-hidden="true" style="min-width: 64px;"><span class="selectboxit-optgroup-header undefined" data-disabled="true">United States</span><li data-id="0" data-val="1" data-disabled="false" class="selectboxit-optgroup-option selectboxit-option  selectboxit-option-first selectboxit-selected" role="option"><a class="selectboxit-option-anchor"><span class="selectboxit-option-icon-container"><i class="selectboxit-option-icon  selectboxit-container"></i></span>Alabama</a></li><li data-id="1" data-val="2" data-disabled="false" class="selectboxit-optgroup-option selectboxit-option" role="option"><a class="selectboxit-option-anchor"><span class="selectboxit-option-icon-container"><i class="selectboxit-option-icon  selectboxit-container"></i></span>Boston</a></li><li data-id="2" data-val="3" data-disabled="false" class="selectboxit-optgroup-option selectboxit-option" role="option"><a class="selectboxit-option-anchor"><span class="selectboxit-option-icon-container"><i class="selectboxit-option-icon  selectboxit-container"></i></span>Ohaio</a></li><li data-id="3" data-val="4" data-disabled="false" class="selectboxit-optgroup-option selectboxit-option" role="option"><a class="selectboxit-option-anchor"><span class="selectboxit-option-icon-container"><i class="selectboxit-option-icon  selectboxit-container"></i></span>New York</a></li><li data-id="4" data-val="5" data-disabled="false" class="selectboxit-optgroup-option selectboxit-option  selectboxit-option-last" role="option"><a class="selectboxit-option-anchor"><span class="selectboxit-option-icon-container"><i class="selectboxit-option-icon  selectboxit-container"></i></span>Washington</a></li></ul></span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group validate-has-error">
                        <label class="control-label" for="zip">Zip</label>
                        <input class="form-control" name="zip" id="zip" data-mask="** *** **" data-validate="required" placeholder="Zip Code"><span for="zip" class="validate-has-error">This field is required.</span>
                    </div>
                </div>

            </div>

        </div>

        <div class="tab-pane" id="tab2-3">

            <strong>Primary School</strong>
            <br>
            <br>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="prim_subject">Subject</label>
                        <input class="form-control" name="prim_subject" id="prim_subject" data-validate="require" placeholder="Graduation Degree">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="prim_school">School Name</label>
                        <input class="form-control" name="prim_school" id="prim_school" placeholder="Which school did you attended">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="prim_date_start">Start Date</label>
                        <input class="form-control datepicker" name="prim_date_start" id="prim_date_start" data-start-view="2" placeholder="(Optional)">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="prim_date_end">End Date</label>
                        <input class="form-control datepicker" name="prim_date_end" id="prim_date_end" data-start-view="2" placeholder="(Optional)">
                    </div>
                </div>

            </div>

            <br>

            <strong>Secondary School</strong>
            <br>
            <br>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="second_subject">Subject</label>
                        <input class="form-control" name="second_subject" id="second_subject" data-validate="require" placeholder="High School">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="second_school">School Name</label>
                        <input class="form-control" name="second_school" id="second_school" placeholder="Which school did you attended">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="second_date_start">Start Date</label>
                        <input class="form-control datepicker" name="second_date_start" id="second_date_start" data-start-view="2" placeholder="(Optional)">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="second_date_end">End Date</label>
                        <input class="form-control datepicker" name="second_date_end" id="second_date_end" data-start-view="2" placeholder="(Optional)">
                    </div>
                </div>

            </div>

            <br>

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label" for="other_qualifications"><strong>Other Qualifications</strong></label>
                        <textarea class="form-control autogrow" name="other_qualifications" id="other_qualifications" placeholder="List one subject per row" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 31px;"></textarea>
                    </div>
                </div>

            </div>

        </div>

        <div class="tab-pane" id="tab2-4">

            <strong>Current &amp; Past Jobs</strong>
            <br>
            <br>

            <div class="row">

                <div class="col-md-1">
                    <label class="control-label">&nbsp;</label>
                    <p class="text-right">
                        <span class="label label-info">1</span>
                    </p>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="job_position_1">Company Name</label>
                        <input class="form-control" name="job_position_1" id="job_position_1" data-validate="require" placeholder="Your current job">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="job_position_1">Job Position</label>
                        <input class="form-control" name="job_position_1" id="job_position_1" data-validate="require" placeholder="Your current position">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="job_position_start_date_1">Start Date</label>
                        <input class="form-control datepicker" name="job_position_start_date_1" id="job_position_start_date_1" placeholder="(Optional)">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="job_position_end_date_1">End Date</label>
                        <input class="form-control datepicker" name="job_position_end_date_1" id="job_position_end_date_1" placeholder="(Optional)">
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-1">
                    <label class="control-label">&nbsp;</label>
                    <p class="text-right">
                        <span class="label label-info">2</span>
                    </p>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="job_position_2">Company Name</label>
                        <input class="form-control" name="job_position_2" id="job_position_2" data-validate="require" placeholder="(Optional)">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="job_position_2">Job Position</label>
                        <input class="form-control" name="job_position_2" id="job_position_2" data-validate="require" placeholder="(Optional)">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="job_position_start_date_2">Start Date</label>
                        <input class="form-control datepicker" name="job_position_start_date_2" id="job_position_start_date_2" placeholder="(Optional)">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="job_position_end_date_2">End Date</label>
                        <input class="form-control datepicker" name="job_position_end_date_2" id="job_position_end_date_2" placeholder="(Optional)">
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-1">
                    <label class="control-label">&nbsp;</label>
                    <p class="text-right">
                        <span class="label label-info">3</span>
                    </p>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="job_position_3">Company Name</label>
                        <input class="form-control" name="job_position_3" id="job_position_3" data-validate="require" placeholder="(Optional)">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="job_position_3">Job Position</label>
                        <input class="form-control" name="job_position_3" id="job_position_3" data-validate="require" placeholder="(Optional)">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="job_position_start_date_3">Start Date</label>
                        <input class="form-control datepicker" name="job_position_start_date_3" id="job_position_start_date_3" placeholder="(Optional)">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="job_position_end_date_3">End Date</label>
                        <input class="form-control datepicker" name="job_position_end_date_3" id="job_position_end_date_3" placeholder="(Optional)">
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-1">
                    <label class="control-label">&nbsp;</label>
                    <p class="text-right">
                        <span class="label label-info">4</span>
                    </p>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="job_position_4">Company Name</label>
                        <input class="form-control" name="job_position_4" id="job_position_4" data-validate="require" placeholder="(Optional)">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="job_position_4">Job Position</label>
                        <input class="form-control" name="job_position_4" id="job_position_4" data-validate="require" placeholder="(Optional)">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="job_position_start_date_4">Start Date</label>
                        <input class="form-control datepicker" name="job_position_start_date_4" id="job_position_start_date_4" placeholder="(Optional)">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="job_position_end_date_4">End Date</label>
                        <input class="form-control datepicker" name="job_position_end_date_4" id="job_position_end_date_4" placeholder="(Optional)">
                    </div>
                </div>

            </div>

        </div>

        <div class="tab-pane" id="tab2-5">

            <div class="form-group">
                <label class="control-label">Choose Username</label>

                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="entypo-user"></i>
                    </div>

                    <input type="text" class="form-control" name="username" id="username" data-validate="required,minlength[5]" data-message-minlength="Username must have minimum of 5 chars." placeholder="Could also be your email">
                </div>
            </div>

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Choose Password</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-key"></i>
                            </div>

                            <input type="password" class="form-control" name="password" id="password" data-validate="required" placeholder="Enter strong password">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">						
                    <div class="form-group">
                        <label class="control-label">Repeat Password</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-cw"></i>
                            </div>

                            <input type="password" class="form-control" name="password" id="password" data-validate="required,equalTo[#password]" data-message-equal-to="Passwords doesn't match." placeholder="Confirm password">
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6">	
                    <div class="form-group">
                        <label class="control-label">Include Services</label>


                        <select multiple="multiple" name="my-select[]" class="form-control multi-select" id="828multiselect" style="position: absolute; left: -9999px;">
                            <option value="1">Web Builder</option>
                            <option value="2" selected="">Server Side Scripting</option>
                            <option value="3">Secure Connection</option>
                            <option value="4" selected="">Database Access</option>
                            <option value="5" selected="">Email</option>
                            <option value="6">eCommerce</option>
                        </select><div class="ms-container" id="ms-828multiselect"><div class="ms-selectable"><ul class="ms-list" tabindex="-1"><li class="ms-elem-selectable" id="1-selectable"><span>Web Builder</span></li><li selected="" class="ms-elem-selectable ms-selected" id="2-selectable" style="display: none;"><span>Server Side Scripting</span></li><li class="ms-elem-selectable" id="3-selectable"><span>Secure Connection</span></li><li selected="" class="ms-elem-selectable ms-selected" id="4-selectable" style="display: none;"><span>Database Access</span></li><li selected="" class="ms-elem-selectable ms-selected" id="5-selectable" style="display: none;"><span>Email</span></li><li class="ms-elem-selectable" id="6-selectable"><span>eCommerce</span></li></ul></div><div class="ms-selection"><ul class="ms-list" tabindex="-1"><li class="ms-elem-selection" id="1-selection" style="display: none;"><span>Web Builder</span></li><li selected="" class="ms-elem-selection ms-selected" id="2-selection" style=""><span>Server Side Scripting</span></li><li class="ms-elem-selection" id="3-selection" style="display: none;"><span>Secure Connection</span></li><li selected="" class="ms-elem-selection ms-selected" id="4-selection" style=""><span>Database Access</span></li><li selected="" class="ms-elem-selection ms-selected" id="5-selection" style=""><span>Email</span></li><li class="ms-elem-selection" id="6-selection" style="display: none;"><span>eCommerce</span></li></ul></div></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Gender</label>

                        <br>

                        <div class="make-switch switch-small has-switch" data-on-label="M" data-off-label="F">
                            <div class="switch-animate switch-on"><input type="checkbox" checked=""><span class="switch-left switch-small">M</span><label class="switch-small">&nbsp;</label><span class="switch-right switch-small">F</span></div>
                        </div>
                    </div>	

                    <div class="form-group">
                        <label class="control-label">Subscribe for Newsletter</label>

                        <br>

                        <div class="make-switch switch-small has-switch" data-on-label="Yes" data-off-label="No">
                            <div class="switch-animate switch-on"><input type="checkbox" checked=""><span class="switch-left switch-small">Yes</span><label class="switch-small">&nbsp;</label><span class="switch-right switch-small">No</span></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">
                            Auto-renew Subscription 
                            <span class="label label-warning">Yearly</span>
                        </label>

                        <br>

                        <div class="make-switch switch-small has-switch" data-on-label="Yes" data-off-label="No">
                            <div class="switch-animate switch-on"><input type="checkbox" checked=""><span class="switch-left switch-small">Yes</span><label class="switch-small">&nbsp;</label><span class="switch-right switch-small">No</span></div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="form-group">
                <div class="checkbox checkbox-replace neon-cb-replacement">
                    <label class="cb-wrapper"><input type="checkbox" name="chk-rules" id="chk-rules" data-validate="required" data-message-message="You must accept rules in order to complete this registration."><div class="checked"></div></label>
                    <label for="chk-rules">By registering I accept terms and conditions.</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Finish Registration</button>
            </div>

        </div>

        <ul class="pager wizard">
            <li class="previous disabled">
                <a href="#"><i class="entypo-left-open"></i> Previous</a>
            </li>

            <li class="next">
                <a href="#">Next <i class="entypo-right-open"></i></a>
            </li>
        </ul>
    </div>

</form>