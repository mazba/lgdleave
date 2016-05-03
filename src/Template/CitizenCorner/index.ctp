<?php
use Cake\Core\Configure;
$religions = \Cake\Core\Configure::read('religions');
?>

<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="portlet box blue" id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>  <span class="step-title">
							 </span>
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
												<i class="fa fa-check"></i><?= __('Account Setup')?>  </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab2" data-toggle="tab" class="step">
												<span class="number">
												2 </span>
												<span class="desc">
												<i class="fa fa-check"></i> <?= __('Profile_Setup')?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab3" data-toggle="tab" class="step active">
												<span class="number">
												3 </span>
												<span class="desc">
												<i class="fa fa-check"></i><?= __('Billing_Setup')?>  </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab4" data-toggle="tab" class="step">
												<span class="number">
												4 </span>
												<span class="desc">
												<i class="fa fa-check"></i> <?= __('Confirm')?> </span>
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
                                    echo $this->Form->input('location_type_id', ['options'=>$locationTypes, 'empty' => 'Select', 'class' => 'form-control  location_type', 'label' => __('Location_type')]);
                                    ?>

                                <div class="hide applicant_type">
                                    <?php
                                    echo $this->Form->input('applicant_type_id', [ 'empty' => 'Select', 'class' => 'form-control applicantTypes', 'label' => __('Applicant Types')]);

                                    echo $this->Form->input('divsion_id', ['options' => $divisions, 'empty' => 'Select', 'class' => 'form-control division ', 'label' => __('Divisions')]);
                                    ?>
                                </div>




                                <div class="hide district">
                                    <?php
                                    echo $this->Form->input('district_id', [ 'empty' => 'Select', 'class' => 'form-control  districts', 'label' => __('Districts')]);
                                    ?>
                                </div>




                                <div class="hide upazila">
                                    <?php
                                    echo $this->Form->input('upazila_id', [ 'empty' => 'Select', 'class' => 'form-control upazilas', 'label' => __('Upazilas')]);
                                    ?>
                                </div>


                                <div class="hide city_corporation">
                                    <?php
                                    echo $this->Form->input('city_corporation_id', ['options' => [], 'empty' => 'Select', 'class' => 'form-control    city_corporations', 'label' => __('City_corporations')]);
                                    ?>
                                </div>
                                <div class="hide city_corporation_ward">
                                    <?php
                                    echo $this->Form->input('city_corporation_ward_id', ['options' => [], 'empty' => 'Select', 'class' => 'form-control city_corporation_wards', 'label' => __('City_corporation_wards')]);
                                    ?>
                                </div>
                                <div class="hide municipal">
                                    <?php
                                    echo $this->Form->input('municipal_id', ['options' => [], 'empty' => 'Select', 'class' => 'form-control    municipals', 'label' => __('Municipals')]);
                                    ?>
                                </div>

                                <div class="hide municipal_ward">
                                    <?php
                                    echo $this->Form->input('municipal_ward_id', ['options' => [], 'empty' => 'Select', 'class' => 'form-control municipal_wards', 'label' => __('Municipal_wards')]);
                                    ?>
                                </div>

                                <div class="hide union">
                                    <?php
                                    echo $this->Form->input('union_id', ['options' => [], 'empty' => 'Select', 'class' => 'form-control    unions', 'label' => __('Unions')]);
                                    ?>
                                </div>


                                <div class="hide ward">
                                    <?php
                                    echo $this->Form->input('union_ward',['label' => __('Ward_name')]);
                                    ?>
                                </div>



                            </div>
                            <div class="tab-pane" id="tab2">


                                <h3 class="block"><?= __('Provide your profile details') ?></h3>

                                <?php
                                echo $this->Form->input('applicant_name_bn',['required'=>'required', 'label' => __('Applicant_name_bn')]);
                                echo $this->Form->input('applicant_name_en',['label' => __('Applicant_name_en')]);
                                echo $this->Form->input('mother_name_bn',['label' => __('Mother_name_bn')]);
                                echo $this->Form->input('mother_name_en',['label' => __('Mother_name_en')]);
                                echo $this->Form->input('father_name_bn',['label' => __('Father_name_bn')]);
                                echo $this->Form->input('father_name_en',['label' => __('Father_name_en')]);
                                echo $this->Form->input('phone',['label' => __('Phone')]);
                                echo $this->Form->input('email',['label' => __('Email')]);
                                echo $this->Form->input('cellphone',['label' => __('Cellphone')]);
                                echo $this->Form->input('nid',['label' => __('Nid')]);
                                echo $this->Form->input('brn',['label' => __('Brn')]);

                                echo $this->Form->input('religion',['options'=>$religions,'class'=>'form-control','label'=>__('Religion')]);



                                echo $this->Form->input('present_address', ['type' => 'textarea', 'escape' => false,'label' => __('Present_address')]);
                                echo $this->Form->input('permanent_address',['type' => 'textarea', 'escape' => false,'label' => __('Permanent_address')]);
                                echo $this->Form->input('emergency_contact',['label' => __('Emergency_contact')]);
                                ?>

                            </div>
                            <div class="tab-pane" id="tab3">
                                <h3 class="block"><?= __('Previous History')?></h3>
                                <?php
                                echo $this->Form->input('application_type_id', ['options' => $applicationTypes, 'empty' => 'Select', 'class' => 'form-control division ', 'label' => __('ApplicationTypes')]);
                                echo  $this->Form->input('application_reason',['label' => __('Application_reason')]);
                                echo  $this->Form->input('start_date',['type'=>'text','class'=>'form-control  datepicker','label'=>__('Start Date')]);
                                echo  $this->Form->input('end_date',['type'=>'text','class'=>'form-control  datepicker','label' => __('End date')]);
                                echo $this->Form->input('document_file[]',['type'=>'file','multiple','label' => __('document_file')]);
                                echo $this->Form->input('is_foregin_tour',['type'=>'checkbox','label' => __('is_foregin_tour')]);
                                ?>
                                <div class=" history" style="display: none">
                                    <?php
                                    echo $this->Form->input('pasport_number',['label' => __('pasport_number')]);
                                    echo $this->Form->input('applicant_using_passport_validity',['label' => __('applicant_using_passport_validity')]);
                                    echo $this->Form->input('using_passport_issue_place',['label' => __('using_passport_issue_place')]);
                                    echo $this->Form->input('foregin_tour_country',['label' => __('foregin_tour_country')]);

                                    echo $this->Form->input('have_foregin_tour',['type'=>'checkbox','label' => __('have_foregin_tour')]);
                                    ?>
                                    <div class="last_tour" style="display: none">
                                        <?php
                                        echo $this->Form->input('last_foreign_tour_country',['label' => __('last_foreign_tour_country')]);
                                        echo $this->Form->input('last_foreign_tour_reason',['label' => __('last_foreign_tour_reason')]);
                                        echo $this->Form->input('last_foreign_tour_time',['type'=>'text','class'=>'form-control  datepicker','label' => __('last_foreign_tour_time')]);
                                        ?>
                                    </div>
                                </div>





                            </div>
                            <div class="tab-pane" id="tab4">
                                <h3 class="block"><?= __('Confirm your account')?></h3>
                                <h4 class="form-section"></h4>


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
        $('.datepicker').datepicker({
            dateFormat: 'dd-mm-yy'
        })

        $(document).on('change', '.location_type', function () {

            $('.applicantTypes').html('');
            var obj = $(this);
            var location_type_id = $(this).val();

                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_applicantTypes')?>',
                    type: 'POST',
                    data: {location_type_id: location_type_id},

                    success: function (data, status) {
                        $('.applicant_type').removeAttr('class', 'hide');
                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.applicantTypes').append("<option ><?= __('select') ?></option>");
                        $.each(data, function (key, value) {
                            obj.closest('.tab-pane').find('.applicantTypes').append($("<option></option>").attr("value", key).text(value));
                        });
                    },
                    error: function (xhr, desc, err) {
                        console.log("error");
                    }
                });

        });

        $(document).on('change', '.division', function () {
            $('.districts').html('');
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


        $(document).on('change', '.districts', function () {
            $('.upazilas').html('');
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

        $(document).on('change', '.upazilas', function () {
            $('.unions').html('');
            var obj = $(this);
            var applicantTypes_id = obj.closest('#tab1').find('.applicantTypes option:selected').val();

            var district_id = obj.closest('#tab1').find('.districts option:selected').val();

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



        $(document).on('change', '#city-corporation-id', function () {
            $('.city_corporation_wards').html('');
            var obj = $(this);
            var applicantTypes_id = obj.closest('#tab1').find('.applicantTypes option:selected').val();

            var district_id = obj.closest('#tab1').find(' .districts option:selected').val();

            var city_corporation_id = $(this).val();
           if( applicantTypes_id==9){
               $.ajax({
                   url: '<?= $this->Url->build('/CitizenCorner/ajax/get_city_corporation_wards')?>',
                   type: 'POST',
                   data: {city_corporation_id: city_corporation_id, district_id:district_id},

                   success: function (data, status) {
                       $('.city_corporation_ward').removeAttr('class', 'hide');
                       data = JSON.parse(data);
                       obj.closest('.tab-pane').find('.city_corporation_wards').append("<option ><?= __('select') ?></option>");
                       $.each(data, function (key, value) {
                           obj.closest('.tab-pane').find('.city_corporation_wards').append($("<option></option>").attr("value", key).text(value));
                       });
                   },
                   error: function (xhr, desc, err) {
                       console.log("error");
                   }
               });
           }
        });


        $(document).on('change', '.municipals', function () {
            $('.municipal_wards').html('');
            var obj = $(this);
            var applicantTypes_id = obj.closest('#tab1').find('.applicantTypes option:selected').val();

            var district_id = obj.closest('#tab1').find(' .districts option:selected').val();

            var municipal_id = $(this).val();
           if( applicantTypes_id==12){
               $.ajax({
                   url: '<?= $this->Url->build('/CitizenCorner/ajax/get_municipal_wards')?>',
                   type: 'POST',
                   data: {municipal_id: municipal_id, district_id:district_id},

                   success: function (data, status) {
                       $('.municipal_ward').removeAttr('class', 'hide');
                       data = JSON.parse(data);
                       obj.closest('.tab-pane').find('.municipal_wards').append("<option ><?= __('select') ?></option>");
                       $.each(data, function (key, value) {
                           obj.closest('.tab-pane').find('.municipal_wards').append($("<option></option>").attr("value", key).text(value));
                       });
                   },
                   error: function (xhr, desc, err) {
                       console.log("error");
                   }
               });
           }
        });


        $(document).on('change', '#union-id', function () {

            var obj = $(this);
            var applicantTypes_id = obj.closest('#tab1').find('.applicantTypes option:selected').val();

           if( applicantTypes_id==15){
               $('.ward').removeAttr('class', 'hide');
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