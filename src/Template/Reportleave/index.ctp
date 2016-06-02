<?php
use Cake\Core\Configure;
$status = array_flip(Configure::read('application_status'));
foreach($status as &$value){
    $value=__($value);
}
//$user = $this->request->Session()->read('Auth')['User'];
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= $this->Url->build(('/Dashboard'), true); ?>"><?= __('Dashboard') ?></a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <?= $this->Html->link(__(' Leave Report'), ['action' => 'index']) ?>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus-square-o fa-lg"></i><?= __('Report') ?>
                </div>

            </div>

            <div class="portlet-body"  id="tab1">
                <?= $this->Form->create('',['class' => 'form-horizontal', 'role' => 'form', 'action'=>'index']) ?>
                <div class="row">
                    <div class="col-md-7 col-md-offset-2 tab-pane">
                        <?php
                        echo $this->Form->input('location_type_id', ['options' => $locationTypes, 'empty' => __('Select'), 'class' => 'form-control  location_type', 'label' => [__('Location Type'), 'escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                        ?>
                        <div class="hide applicant_type" id="applicant_type">
                            <?php
                            echo $this->Form->input('applicant_type_id', ['options' => '', 'empty' => __('Select'), 'class' => 'form-control select_box applicantTypes', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);

                            echo $this->Form->input('divsion_id', ['options' => $divisions, 'empty' => __('Select'), 'class' => 'form-control select_box division divisions ', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                            ?>
                        </div>


                        <div class="hide district" id="district">
                            <?php
                            echo $this->Form->input('district_id', ['empty' => __('Select'), 'class' => 'form-control  select_box districts', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                            ?>
                        </div>


                        <div class="hide upazila" id="upazila">
                            <?php
                            echo $this->Form->input('upazila_id', ['empty' => __('Select'), 'class' => 'form-control select_box upazilas', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                            ?>
                        </div>


                        <div class="hide city_corporation" id="city_corporation">
                            <?php
                            echo $this->Form->input('city_corporation_id', ['options' => [], 'empty' => __('Select'), 'class' => 'form-control  select_box  city_corporations', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                            ?>
                        </div>
                        <div class="hide city_corporation_ward" id="city_corporation_ward">
                            <?php
                            echo $this->Form->input('city_corporation_ward_id', ['options' => [], 'empty' => __('Select'), 'class' => 'form-control select_box city_corporation_wards', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                            ?>
                        </div>
                        <div class="hide municipal" id="municipal">
                            <?php
                            echo $this->Form->input('municipal_id', ['options' => [], 'empty' => __('Select'), 'class' => 'form-control  select_box  municipals', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                            ?>
                        </div>

                        <div class="hide municipal_ward" id="municipal_ward">
                            <?php
                            echo $this->Form->input('municipal_ward_id', ['options' => [], 'empty' => __('Select'), 'class' => 'form-control select_box municipal_wards', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                            ?>
                        </div>

                        <div class="hide union" id="union">
                            <?php
                            echo $this->Form->input('union_id', ['options' => [], 'empty' => __('Select'), 'class' => 'form-control  select_box  unions', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                            ?>
                        </div>


                        <div class="hide ward" id="ward">
                            <?php
                            echo $this->Form->input('union_ward', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                            ?>
                        </div>

                        <?php
                        echo $this->Form->input('application_type_id', ['options' => $applicationTypes, 'empty' => __('Select'),  'class' => 'form-control', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                        echo $this->Form->input('status', ['label'=>__('Status'),'options' => $status,'empty' => __('Select')]);
                        echo $this->Form->input('from_date',['class'=>'form-control from_date datepicker']);
                        echo $this->Form->input('to_date', ['class'=>'form-control to_date datepicker']);
                        ?>
                    </div>
                    <div class="col-md-12 text-center">
                        <?= $this->Form->button(__('Search'), ['class' => 'btn blue', 'style' => 'margin:20px']) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php if(isset($reportData)):?>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green-seagreen">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus-square-o fa-lg"></i><?= __('Report View') ?>
                    </div>
                </div>

                <div class="portlet-body">

                    <div id="PrintArea">
                        <div class="row">
                            <h3 class="text-center">স্থানীয় সরকার পল্লী উন্নয়ন বিভাগ</h3>
                        </div>
                        <div class="row">
                            <h4 class="text-center"><?= __('Report') ?></h4>
                        </div>


                        <div class="row">
                            <div class="col-md-12 report-table" style="overflow: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr style="border-top: 3px solid #ddd">
                                        <th><?= __('Sl#') ?></th>
                                        <th><?= __('Name') ?></th>
                                        <th><?= __('Phone') ?></th>
                                        <th><?= __('Email') ?></th>
                                        <th><?= __('Location Type') ?></th>
                                        <th><?= __('Application Type') ?></th>
                                        <th><?= __('Start Date') ?></th>
                                        <th><?= __('End Date') ?></th>
                                        <th><?= __('Status') ?></th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php if(sizeof($reportData)>0):?>
                                        <?php foreach($reportData as $key=>$detail):?>
                                            <tr>
                                                <td><?php echo $this->System->eng_to_bangla_code($key+1) ;?></td>
                                                <td><?= $detail['applicant_name_bn'];?></td>
                                                <td><?= $detail['phone'];?></td>
                                                <td><?= $detail['email'];?></td>
                                                <td><?= $detail['location_type']['title_bn'];?></td>
                                                <td><?= $detail['application_type']['title_bn'];?></td>
                                                <td><?= $detail['start_date']?date('d-m-y', $detail['start_date']):'Not Set';?></td>
                                                <td><?= $detail['end_date']?date('d-m-y', $detail['end_date']):'Not Set';?></td>
                                                <td><?= $status[$detail['status']];?></td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php else:?>
                                        <tr><td class="text-center alert-danger" colspan="12"><?= __('No Data Found')?></td></tr>
                                    <?php endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>

<style>
    .ui-datepicker-month
    {
        color: dimgrey !important;
    }
</style>

<script type="text/javascript">

    $(function() {
        $( ".from_date" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            dateFormat: 'dd-mm-yy',
            numberOfMonths: 3,
            onClose: function( selectedDate ) {
                $( ".to_date" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( ".to_date" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            dateFormat: 'dd-mm-yy',
            numberOfMonths: 3,
            onClose: function( selectedDate ) {
                $( ".from_date" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });

    $(document).ready(function () {

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
                url: '<?= $this->Url->build('/Reportleave/ajax/get_applicantTypes')?>',
                type: 'POST',
                data: {location_type_id: location_type_id},

                success: function (data, status) {
                    $('.applicant_type').removeAttr('class', 'hide');
                    data = JSON.parse(data);
                    obj.closest('.tab-pane').find('.applicantTypes').append("<option value=''><?= __('Select') ?></option>");
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
            //   $('#district-id').html('');
            var obj = $(this);

            var applicantTypes_id = obj.closest('.tab-pane').find('.applicantTypes').val();
            var division_id = obj.val();


            if (applicantTypes_id < 100) {
                $.ajax({
                    url: '<?= $this->Url->build('/Reportleave/ajax/get_districts')?>',
                    type: 'POST',
                    data: {division_id: division_id},

                    success: function (data, status) {
                        $('.district').removeAttr('class', 'hide');


                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('#district-id').find('option')
                            .remove()
                            .end()
                            .append("<option value=''><?= __('Select') ?></option>");
                        $.each(data, function (key, value) {
                            obj.closest('.tab-pane').find('#district-id').append($("<option></option>").attr("value", key).text(value));
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
                    url: '<?= $this->Url->build('/Reportleave/ajax/get_upazilas')?>',
                    type: 'POST',
                    data: {district_id: district_id},

                    success: function (data, status) {
                        $('.upazila').removeAttr('class', 'hide');

                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.upazilas').append("<option value=''><?= __('Select') ?></option>");
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
                    url: '<?= $this->Url->build('/Reportleave/ajax/get_city_corporations')?>',
                    type: 'POST',
                    data: {district_id: district_id},

                    success: function (data, status) {
                        $('.city_corporation').removeAttr('class', 'hide');
                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.city_corporations').append("<option value=''><?= __('Select') ?></option>");
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
                    url: '<?= $this->Url->build('/Reportleave/ajax/get_municipals')?>',
                    type: 'POST',
                    data: {district_id: district_id},

                    success: function (data, status) {
                        $('.municipal').removeAttr('class', 'hide');
                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.municipals').append("<option value=''><?= __('Select') ?></option>");
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
                    url: '<?= $this->Url->build('/Reportleave/ajax/get_unions')?>',
                    type: 'POST',
                    data: {upazila_id: upazila_id, district_id: district_id},

                    success: function (data, status) {
                        $('.union').removeAttr('class', 'hide');
                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.unions').append("<option value=''><?= __('Select') ?></option>");
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
                    url: '<?= $this->Url->build('/Reportleave/ajax/get_city_corporation_wards')?>',
                    type: 'POST',
                    data: {city_corporation_id: city_corporation_id, district_id: district_id},

                    success: function (data, status) {
                        $('.city_corporation_ward').removeAttr('class', 'hide');
                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.city_corporation_wards').append("<option value=''><?= __('Select') ?></option>");
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
                    url: '<?= $this->Url->build('/Reportleave/ajax/get_municipal_wards')?>',
                    type: 'POST',
                    data: {municipal_id: municipal_id, district_id: district_id},

                    success: function (data, status) {
                        $('.municipal_ward').removeAttr('class', 'hide');
                        data = JSON.parse(data);
                        obj.closest('.tab-pane').find('.municipal_wards').append("<option value=''><?= __('Select') ?></option>");
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


        //For add new file option

        $(document).on('click', '.add_file', function () {

            var index = $('.file_div').data('index_no');
            $('.file_div').data('index_no', index + 1);


            $('.file_div:last').clone()
                .find("input:text, input:file").val("").end()
                .appendTo('#file_wrapper');
        });

        $(document).on('click', '.remove_file', function () {
            var obj = $(this);
            var count = $('.file_div').length;
            if (count > 1) {
                obj.closest('.file_div').remove();
            }
        });


        //valudation relatted
    });

    function print_rpt() {
        URL = "<?php echo $this->request->webroot; ?>page/Print_a4_Eng.php?selLayer=PrintArea";
        day = new Date();
        id = day.getTime();
        eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=yes,scrollbars=yes ,location=0,statusbar=0 ,menubar=yes,resizable=1,width=880,height=600,left = 20,top = 50');");
    }
</script>
