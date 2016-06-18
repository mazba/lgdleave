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
                                        <th><?= __('Application Code') ?></th>
                                        <th><?= __('Name') ?></th>
                                        <th><?= __('Phone') ?></th>
                                        <th><?= __('Email') ?></th>
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
                                                <td><?= $detail['temporary_id'];?></td>
                                                <td><?= $detail['applicant_name_bn'];?></td>
                                                <td><?= $detail['phone'];?></td>
                                                <td><?= $detail['email'];?></td>
                                                <td><?= $detail['application_types']['title_bn'];?></td>
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
    function print_rpt() {
        URL = "<?php echo $this->request->webroot; ?>page/Print_a4_Eng.php?selLayer=PrintArea";
        day = new Date();
        id = day.getTime();
        eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=yes,scrollbars=yes ,location=0,statusbar=0 ,menubar=yes,resizable=1,width=880,height=600,left = 20,top = 50');");
    }
</script>
