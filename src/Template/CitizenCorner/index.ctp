<?php
use Cake\Core\Configure;

$religions = \Cake\Core\Configure::read('religions');
?>

<style>
    label.mandetory:after {
        content: ' *';
        color: red;
        display: inline;
    }
</style>

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
												<i class="fa fa-check"></i><?= __('Account Setup') ?>  </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab2" data-toggle="tab" class="step">
												<span class="number">
												2 </span>
												<span class="desc">
												<i class="fa fa-check"></i> <?= __('Profile_Setup') ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab3" data-toggle="tab" class="step active">
												<span class="number">
												3 </span>
												<span class="desc">
												<i class="fa fa-check"></i><?= __('Billing_Setup') ?>  </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab4" data-toggle="tab" class="step">
												<span class="number">
												4 </span>
												<span class="desc">
												<i class="fa fa-check"></i> <?= __('Confirm') ?> </span>
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
                                echo $this->Form->input('location_type_id', ['options' => $locationTypes, 'empty' => 'Select', 'class' => 'form-control  location_type', 'label' => [__('Location Type'), 'escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                ?>

                                <div class="hide applicant_type" id="applicant_type">
                                    <?php
                                    echo $this->Form->input('applicant_type_id', ['empty' => 'Select', 'class' => 'form-control select_box applicantTypes', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);

                                    echo $this->Form->input('divsion_id', ['options' => $divisions, 'empty' => 'Select', 'class' => 'form-control select_box division divisions ', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    ?>
                                </div>


                                <div class="hide district" id="district">
                                    <?php
                                    echo $this->Form->input('district_id', ['empty' => 'Select', 'class' => 'form-control  select_box districts', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    ?>
                                </div>


                                <div class="hide upazila" id="upazila">
                                    <?php
                                    echo $this->Form->input('upazila_id', ['empty' => 'Select', 'class' => 'form-control select_box upazilas', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    ?>
                                </div>


                                <div class="hide city_corporation" id="city_corporation">
                                    <?php
                                    echo $this->Form->input('city_corporation_id', ['options' => [], 'empty' => 'Select', 'class' => 'form-control  select_box  city_corporations', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    ?>
                                </div>
                                <div class="hide city_corporation_ward" id="city_corporation_ward">
                                    <?php
                                    echo $this->Form->input('city_corporation_ward_id', ['options' => [], 'empty' => 'Select', 'class' => 'form-control select_box city_corporation_wards', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    ?>
                                </div>
                                <div class="hide municipal" id="municipal">
                                    <?php
                                    echo $this->Form->input('municipal_id', ['options' => [], 'empty' => 'Select', 'class' => 'form-control  select_box  municipals', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    ?>
                                </div>

                                <div class="hide municipal_ward" id="municipal_ward">
                                    <?php
                                    echo $this->Form->input('municipal_ward_id', ['options' => [], 'empty' => 'Select', 'class' => 'form-control select_box municipal_wards', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    ?>
                                </div>

                                <div class="hide union" id="union">
                                    <?php
                                    echo $this->Form->input('union_id', ['options' => [], 'empty' => 'Select', 'class' => 'form-control  select_box  unions', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    ?>
                                </div>


                                <div class="hide ward" id="ward">
                                    <?php
                                    echo $this->Form->input('union_ward', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    ?>
                                </div>


                            </div>
                            <div class="tab-pane" id="tab2">


                                <h3 class="block"><?= __('Provide your profile details') ?></h3>

                                <?php
                                echo $this->Form->input('applicant_name_bn', ['required' => 'required', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('applicant_name_en', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('mother_name_bn', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('mother_name_en', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('father_name_bn', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('father_name_en', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('phone', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('email', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('cellphone', ['label' => __('Cellphone')]);
                                echo $this->Form->input('nid', ['label' => __('Nid')]);
                                echo $this->Form->input('brn', ['label' => __('Brn')]);

                                echo $this->Form->input('religion', ['options' => $religions, 'class' => 'form-control', 'label' => __('Religion')]);


                                echo $this->Form->input('present_address', ['type' => 'textarea', 'escape' => false, 'label' => __('Present_address')]);
                                echo $this->Form->input('permanent_address', ['type' => 'textarea', 'escape' => false, 'label' => __('Permanent_address')]);
                                echo $this->Form->input('emergency_contact', ['label' => __('Emergency_contact')]);
                                ?>

                            </div>
                            <div class="tab-pane" id="tab3">
                                <h3 class="block"><?= __('Previous History') ?></h3>
                                <?php
                                echo $this->Form->input('application_type_id', ['options' => $applicationTypes, 'required' => 'required', 'empty' => 'Select', 'class' => 'form-control division ', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('application_reason', ['label' => __('Application_reason')]);
                                echo $this->Form->input('start_date', ['type' => 'text', 'class' => 'form-control ', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('end_date', ['type' => 'text', 'class' => 'form-control ', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('document_file[]', ['type' => 'file', 'multiple', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right'], 'required' => 'required']);
                                echo $this->Form->input('is_foregin_tour', ['type' => 'checkbox', 'label' => __('is_foregin_tour')]);
                                ?>
                                <div class=" history" style="display: none">
                                    <?php
                                    echo $this->Form->input('pasport_number', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    echo $this->Form->input('applicant_using_passport_validity', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    echo $this->Form->input('using_passport_issue_place', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    echo $this->Form->input('foregin_tour_country', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);

                                    echo $this->Form->input('have_foregin_tour', ['type' => 'checkbox', 'label' => __('have_foregin_tour')]);
                                    ?>
                                    <div class="last_tour" style="display: none">
                                        <?php
                                        echo $this->Form->input('last_foreign_tour_country', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                        echo $this->Form->input('last_foreign_tour_reason', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                        echo $this->Form->input('last_foreign_tour_time', ['type' => 'text', 'class' => 'form-control  datepicker', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                        ?>
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane" id="tab4">
                                <h3 class="block"><?= __('Confirm your account') ?></h3>
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

        $('#location-type-id').val('');

        $(document).on('change', '.location_type', function () {

            $('#district').hide();
            $('#upazila').hide();
            $('#city_corporation').hide();
            $('#city_corporation_ward').hide();
            $('#municipal').hide();
            $('#municipal_ward').hide();
            $('#union').hide();
            $('#ward').hide();


            $('.applicantTypes').html('');
            $('.divisions').val('');
            var obj = $(this);
            var location_type_id = $(this).val();

            $.ajax({
                url: '<?= $this->Url->build('/CitizenCorner/ajax/get_applicantTypes')?>',
                type: 'POST',
                data: {location_type_id: location_type_id},

                success: function (data, status) {
                    $('.applicant_type').removeAttr('class', 'hide');
                    data = JSON.parse(data);
                    obj.closest('.tab-pane').find('.applicantTypes').append("<option value=''><?= __('select') ?></option>");
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

            $('#upazila').hide();
            $('#city_corporation').hide();
            $('#city_corporation_ward').hide();
            $('#municipal').hide();
            $('#municipal_ward').hide();
            $('#union').hide();
            $('#ward').hide();

            $('#district').show();
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
                        obj.closest('.tab-pane').find('.districts').append("<option value=''><?= __('select') ?></option>");
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

            $('#union').hide();
            $('#ward').hide();
            $('.upazilas').html('');
            $('.city_corporations').html('');
            $('.municipals').html('');
            var obj = $(this);
            var applicantTypes_id = obj.closest('#tab1').find('.applicantTypes option:selected').val();

            var district_id = $(this).val();

            if (applicantTypes_id > 4 && applicantTypes_id < 8 || applicantTypes_id > 13) {

                $('#upazila').show();
                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_upazilas')?>',
                    type: 'POST',
                    data: {district_id: district_id},

                    success: function (data, status) {
                        $('.upazila').removeAttr('class', 'hide');

                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.upazilas').append("<option value=''><?= __('select') ?></option>");
                        $.each(data, function (key, value) {
                            obj.closest('.tab-pane').find('.upazilas').append($("<option></option>").attr("value", key).text(value));
                        });
                    },
                    error: function (xhr, desc, err) {
                        console.log("error");
                    }
                });
            } else if (applicantTypes_id > 7 && applicantTypes_id < 11) {
                $('#city_corporation').show();
                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_city_corporations')?>',
                    type: 'POST',
                    data: {district_id: district_id},

                    success: function (data, status) {
                        $('.city_corporation').removeAttr('class', 'hide');
                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.city_corporations').append("<option value=''><?= __('select') ?></option>");
                        $.each(data, function (key, value) {
                            obj.closest('.tab-pane').find('.city_corporations').append($("<option></option>").attr("value", key).text(value));
                        });
                    },
                    error: function (xhr, desc, err) {
                        console.log("error");
                    }
                });
            } else if (applicantTypes_id > 10 && applicantTypes_id < 14) {
                $('#municipal').show();
                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_municipals')?>',
                    type: 'POST',
                    data: {district_id: district_id},

                    success: function (data, status) {
                        $('.municipal').removeAttr('class', 'hide');
                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.municipals').append("<option value=''><?= __('select') ?></option>");
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
            if (applicantTypes_id > 13) {
                $('#union').show('');
                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_unions')?>',
                    type: 'POST',
                    data: {upazila_id: upazila_id, district_id: district_id},

                    success: function (data, status) {
                        $('.union').removeAttr('class', 'hide');
                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.unions').append("<option value=''><?= __('select') ?></option>");
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
            if (applicantTypes_id == 9) {
                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_city_corporation_wards')?>',
                    type: 'POST',
                    data: {city_corporation_id: city_corporation_id, district_id: district_id},

                    success: function (data, status) {
                        $('.city_corporation_ward').removeAttr('class', 'hide');
                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.city_corporation_wards').append("<option value=''><?= __('select') ?></option>");
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
            if (applicantTypes_id == 12) {
                $('#municipal_ward').show();
                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_municipal_wards')?>',
                    type: 'POST',
                    data: {municipal_id: municipal_id, district_id: district_id},

                    success: function (data, status) {
                        $('.municipal_ward').removeAttr('class', 'hide');
                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.municipal_wards').append("<option value=''><?= __('select') ?></option>");
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

            if (applicantTypes_id == 15) {
                $('#ward').show();
                $('.ward').removeAttr('class', 'hide');
            }
        });


        $("#is-foregin-tour").on("click", function () {
            if ($(this).is(':checked')) {
                $('.history').show();
                $('#pasport-number').attr('required', 'required');
                $('#applicant-using-passport-validity').attr('required', 'required');
                $('#using-passport-issue-place').attr('required', 'required');
                $('#foregin-tour-country').attr('required', 'required');
            } else {
                $('.history').hide();
                $('#pasport-number').removeAttr('required', 'required');
                $('#applicant-using-passport-validity').removeAttr('required', 'required');
                $('#using-passport-issue-place').removeAttr('required', 'required');
                $('#foregin-tour-country').removeAttr('required', 'required');
            }
        });

        $("#have-foregin-tour").on("click", function () {
            if ($(this).is(':checked')) {
                $('.last_tour').show();
                $('#last-foreign-tour-country').attr('required', 'required');
                $('#last-foreign-tour-reason').attr('required', 'required');
                $('#last-foreign-tour-time').attr('required', 'required');
            } else {
                $('.last_tour').hide();
                $('#last-foreign-tour-country').removeAttr('required', 'required');
                $('#last-foreign-tour-reason').removeAttr('required', 'required');
                $('#last-foreign-tour-time').removeAttr('required', 'required');
            }
        });

        //valudation relatted
    });

    $(function () {
        $("#start-date").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function (selectedDate) {
                $("#end-date").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#end-date").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function (selectedDate) {
                $("#start-date").datepicker("option", "maxDate", selectedDate);
            }
        });
    });

    function isValidForm() {
        var response = true;
        if ($('#tab1').hasClass('active')) {
            var location_type = $('#location-type-id ').val();
            var applicant_type = $('#applicant-type-id').val();
            var divsion_id = $('#divsion-id').val();
            var district_id = $('#district-id').val();
            var upazila_id = $('#upazila-id').val();
            var city_corporation_id = $('#city-corporation-id').val();
            var city_corporation_ward_id = $('#city-corporation-ward-id').val();
            var municipal_id = $('#municipal-id').val();
            var municipal_ward_id = $('#municipal-ward-id').val();
            var union_id = $('#union-id').val();
            var union_ward = $('#union-ward').val();

            if (!location_type) {
                response = false;
                alert('please select location_type');
            }
            if (location_type == 1) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                }
            } else if (location_type == 2) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                } else if (!upazila_id) {
                    response = false;
                    alert('please select upazila');
                }
            } else if (location_type == 3) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                } else if (!city_corporation_id) {
                    response = false;
                    alert('please select city_corporation');
                }
            } else if (location_type == 4) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                } else if (!city_corporation_id) {
                    response = false;
                    alert('please select city_corporation');
                } else if (!city_corporation_ward_id) {
                    response = false;
                    alert('please select city_corporation_ward');
                }
            } else if (location_type == 5) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                } else if (!municipal_id) {
                    response = false;
                    alert('please select municipal');
                }
            } else if (location_type == 6) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                } else if (!municipal_id) {
                    response = false;
                    alert('please select municipal');
                } else if (!municipal_ward_id) {
                    response = false;
                    alert('please select municipal_ward');
                }
            } else if (location_type == 7) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                } else if (!upazila_id) {
                    response = false;
                    alert('please select upazila');
                } else if (!union_id) {
                    response = false;
                    alert('please select union');
                }
            } else if (location_type == 8) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                } else if (!upazila_id) {
                    response = false;
                    alert('please select upazila');
                } else if (!union_id) {
                    response = false;
                    alert('please select union');
                } else if (!union_ward) {
                    response = false;
                    alert('please select union_ward');
                }
            }
        }
        else if ($('#tab2').hasClass('active')) {
            response = true;
        }
        else if ($('#tab3').hasClass('active')) {
            response = true;
        }
        return response;
    }
</script>