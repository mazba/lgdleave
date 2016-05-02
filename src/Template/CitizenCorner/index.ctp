<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="portlet box blue" id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i> Form Wizard - <span class="step-title">
								Step 1 of 4 </span>
                </div>

            </div>
            <div class="portlet-body form">
                <?= $this->Form->create($applications, ['type' => 'file', 'class' => 'form-horizontal myForm', 'novalidate', 'id' => 'submit_form']) ?>

                <div class="form-wizard">
                    <div class="form-body">
                        <ul class="nav nav-pills nav-justified steps">
                            <li>
                                <a href="#tab1" data-toggle="tab" class="step">
												<span class="number">
												1 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Account Setup </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab2" data-toggle="tab" class="step">
												<span class="number">
												2 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Profile Setup </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab3" data-toggle="tab" class="step active">
												<span class="number">
												3 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Billing Setup </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab4" data-toggle="tab" class="step">
												<span class="number">
												4 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Confirm </span>
                                </a>
                            </li>
                        </ul>
                        <div id="bar" class="progress progress-striped" role="progressbar">
                            <div class="progress-bar progress-bar-success">
                            </div>
                        </div>
                        <div class="tab-content">


                            <div class="tab-pane active" id="tab1">
                                <h3 class="block"><?= __('Basic Info') ?></h3>

                                <?php
                                echo $this->Form->input('applicantTypes', ['options' => $applicantTypes, 'empty' => 'Select', 'class' => 'form-control applicantTypes', 'label' => __('Applicant Types')]);

                                echo $this->Form->input('divisions', ['options' => $divisions, 'empty' => 'Select', 'class' => 'form-control division ', 'label' => __('Divisions')]);
                                ?>


                                <div class="hide district">
                                    <?php
                                    echo $this->Form->input('districts', ['options' => [], 'empty' => 'Select', 'class' => 'form-control  districts', 'label' => __('Districts')]);
                                    ?>
                                </div>

                                <div class="hide upazila">
                                    <?php
                                    echo $this->Form->input('upazilas', ['options' => [], 'empty' => 'Select', 'class' => 'form-control upazilas', 'label' => __('Upazilas')]);
                                    ?>
                                </div>


                                <div class="hide city_corporation">
                                    <?php
                                    echo $this->Form->input('city_corporations', ['options' => [], 'empty' => 'Select', 'class' => 'form-control    city_corporations', 'label' => __('City_corporations')]);
                                    ?>
                                </div>

                                <div class="hide municipal">
                                    <?php
                                    echo $this->Form->input('municipals', ['options' => [], 'empty' => 'Select', 'class' => 'form-control    municipals', 'label' => __('Municipals')]);
                                    ?>
                                </div>

                                <div class="hide union">
                                    <?php
                                    echo $this->Form->input('unions', ['options' => [], 'empty' => 'Select', 'class' => 'form-control    unions', 'label' => __('Unions')]);
                                    ?>
                                </div>

                                <div class="hide">
                                    <?php
                                    echo $this->Form->input('city_corporation_wards', ['options' => [], 'empty' => 'Select', 'class' => 'form-control city_corporation_wards', 'label' => __('City_corporation_wards')]);
                                    ?>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab2">


                                <h3 class="block"><?= __('Provide your profile details') ?></h3>

                                <?php
                                echo $this->Form->input('application_type_id', ['options' => $applicationTypes, 'empty' => 'Select', 'class' => 'form-control division ', 'label' => __('ApplicationTypes')]);
                                echo $this->Form->input('applicant_name_bn',['required'=>'required']);
                                echo $this->Form->input('applicant_name_en');
                                echo $this->Form->input('mother_name_bn');
                                echo $this->Form->input('mother_name_en');
                                echo $this->Form->input('father_name_bn');
                                echo $this->Form->input('father_name_en');
                                echo $this->Form->input('phone');
                                echo $this->Form->input('email');
                                echo $this->Form->input('cellphone');
                                echo $this->Form->input('nid');
                                echo $this->Form->input('brn');
                                echo $this->Form->input('religion');
                                echo $this->Form->input('present_address');
                                echo $this->Form->input('permanent_address');
                                echo $this->Form->input('emergency_contact');
                                echo $this->Form->input('nid');
                                ?>

                            </div>
                            <div class="tab-pane" id="tab3">
                                <h3 class="block"><?= __('Previous History')?></h3>
                                <?php
                                echo  $this->Form->input('application_reason');
                                echo  $this->Form->input('start_date',['type'=>'text','class'=>'form-control  datepicker','label'=>__('Start Date')]);
                                echo  $this->Form->input('end_date');
                                echo $this->Form->input('document_file',['type'=>'file']);
                                echo $this->Form->input('is_foregin_tour',['type'=>'checkbox']);
                                ?>
                                <div class=" history" style="display: none">
                                    <?php
                                    echo $this->Form->input('pasport_number');
                                    echo $this->Form->input('applicant_using_passport_validity');
                                    echo $this->Form->input('using_passport_issue_place');
                                    echo $this->Form->input('foregin_tour_country');

                                    echo $this->Form->input('have_foregin_tour',['type'=>'checkbox']);
                                    ?>
                                    <div class="last_tour" style="display: none">
                                        <?php
                                        echo $this->Form->input('last_foreign_tour_country');
                                        echo $this->Form->input('last_foreign_tour_reason');
                                        echo $this->Form->input('last_foreign_tour_time');
                                        ?>
                                    </div>
                                </div>





                            </div>
                            <div class="tab-pane" id="tab4">
                                <h3 class="block">Confirm your account</h3>
                                <h4 class="form-section">Account</h4>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Username:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="username">
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Email:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="email">
                                        </p>
                                    </div>
                                </div>
                                <h4 class="form-section">Profile</h4>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Fullname:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="fullname">
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Gender:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="gender">
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Phone:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="phone">
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Address:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="address">
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">City/Town:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="city">
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Country:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="country">
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Remarks:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="remarks">
                                        </p>
                                    </div>
                                </div>
                                <h4 class="form-section">Billing</h4>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Card Holder Name:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="card_name">
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Card Number:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="card_number">
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">CVC:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="card_cvc">
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Expiration:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="card_expiry_date">
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Payment Options:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="payment[]">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <a href="javascript:;" class="btn default button-previous">
                                    <i class="m-icon-swapleft"></i> Back </a>
                                <a href="javascript:;" class="btn blue button-next">
                                    Continue <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                                <a href="javascript:;" class="btn green button-submit">
                                    Submit <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

<script>
    $(document).ready(function () {

        $(document).on('change', '.division', function () {
            $('#districts').html('');
            var obj = $(this);

            var applicantTypes_id = obj.closest('.tab-pane').find('.applicantTypes').val();
            var division_id = obj.val();


            if (applicantTypes_id < 100) {
                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_districts')?>',
                    type: 'POST',
                    data: {division_id: division_id},

                    success: function (data, status) {
                        $('.district').removeAttr('class', 'hide');

                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.districts').append("<option ><?= __('select') ?></option>");
                        $.each(data, function (key, value) {
                            obj.closest('.tab-pane').find('.districts').append($("<option></option>").attr("value", key).text(value));
                        });
                    },
                    error: function (xhr, desc, err) {
                        console.log("error");
                    }
                });
            }
        });


        $(document).on('change', '#districts', function () {
            $('#upazilas').html('');
            $('.city_corporations').html('');
            $('.municipals').html('');
            var obj = $(this);
            var applicantTypes_id = obj.closest('#tab1').find('.applicantTypes option:selected').val();

            var district_id = $(this).val();

            if (applicantTypes_id > 4 && applicantTypes_id < 8 || applicantTypes_id>13) {
                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_upazilas')?>',
                    type: 'POST',
                    data: {district_id: district_id},

                    success: function (data, status) {
                        $('.upazila').removeAttr('class', 'hide');

                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.upazilas').append("<option ><?= __('select') ?></option>");
                        $.each(data, function (key, value) {
                            obj.closest('.tab-pane').find('.upazilas').append($("<option></option>").attr("value", key).text(value));
                        });
                    },
                    error: function (xhr, desc, err) {
                        console.log("error");
                    }
                });
            }else if(applicantTypes_id > 7 && applicantTypes_id < 11) {
                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_city_corporations')?>',
                    type: 'POST',
                    data: {district_id: district_id},

                    success: function (data, status) {
                        $('.city_corporation').removeAttr('class', 'hide');
                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.city_corporations').append("<option ><?= __('select') ?></option>");
                        $.each(data, function (key, value) {
                            obj.closest('.tab-pane').find('.city_corporations').append($("<option></option>").attr("value", key).text(value));
                        });
                    },
                    error: function (xhr, desc, err) {
                        console.log("error");
                    }
                });
            }else if(applicantTypes_id > 10 && applicantTypes_id < 14) {
                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_municipals')?>',
                    type: 'POST',
                    data: {district_id: district_id},

                    success: function (data, status) {
                        $('.municipal').removeAttr('class', 'hide');
                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.municipals').append("<option ><?= __('select') ?></option>");
                        $.each(data, function (key, value) {
                            obj.closest('.tab-pane').find('.municipals').append($("<option></option>").attr("value", key).text(value));
                        });
                    },
                    error: function (xhr, desc, err) {
                        console.log("error");
                    }
                });
            }
        });

        $(document).on('change', '#upazilas', function () {
            $('.unions').html('');
            var obj = $(this);
            var applicantTypes_id = obj.closest('#tab1').find('.applicantTypes option:selected').val();

            var district_id = obj.closest('#tab1').find('#districts option:selected').val();

            var upazila_id = $(this).val();
           if( applicantTypes_id>13){
               $.ajax({
                   url: '<?= $this->Url->build('/CitizenCorner/ajax/get_unions')?>',
                   type: 'POST',
                   data: {upazila_id: upazila_id, district_id:district_id},

                   success: function (data, status) {
                       $('.union').removeAttr('class', 'hide');
                       data = JSON.parse(data);
                       obj.closest('.tab-pane').find('.unions').append("<option ><?= __('select') ?></option>");
                       $.each(data, function (key, value) {
                           obj.closest('.tab-pane').find('.unions').append($("<option></option>").attr("value", key).text(value));
                       });
                   },
                   error: function (xhr, desc, err) {
                       console.log("error");
                   }
               });
           }
        });

        $("#is-foregin-tour").on("click", function() {
            if ($(this).is(':checked') ) {
                $('.history').show();
            } else {
                $('.history').hide();
            }
        });

        $("#have-foregin-tour").on("click", function() {
            if ($(this).is(':checked') ) {
                $('.last_tour').show();
            } else {
                $('.last_tour').hide();
            }
        });
    });
</script>