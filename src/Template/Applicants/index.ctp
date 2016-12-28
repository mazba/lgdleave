<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-coffee"></i><?= __('Applicant List')?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('New Applicant'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary']); ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable" id="dataTable">

                </div>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>
<?php
echo $this->element('jq_grid');
?>
<!--SCRIPT-->
<script type="text/javascript">
    $(document).ready(function ()
    {
        var url = "<?php echo $this->request->webroot; ?>Applicants";

        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
                { name: 'id', type: 'int' },
                { name: 'location_type', type: 'string' },
                { name: 'area_district', type: 'string' },
                { name: 'area_division', type: 'string' },
                { name: 'applicant_type', type: 'string' },
            ],
            id: 'id',
            url: url
        };

        var dataAdapter = new $.jqx.dataAdapter(source);
        var myCustomFormatter = function(cellVal,options,rowObject) {
            console.log(cellVal)
            return "<input style='height:22px;' type='button' value='Edit' onclick=\"window.location.href='editItem.asp?ID="+cellVal+"'\"  />";
        };
        $("#dataTable").jqxGrid(
            {
                width: '100%',
                source: dataAdapter,
                pageable: true,
                filterable: true,
                sortable: true,
                showfilterrow: true,
                columnsresize: true,
                rowsheight: 40,
                pagesize:15,
                pagesizeoptions: ['100', '200', '300', '500','1000','1500'],
//                selectionmode: 'checkbox',
                altrows: true,
                autoheight: true,
                columns: [
                    { text: '<?= __('ID') ?>', dataField: 'id',width:'5%'},
                    { text: '<?= __('Location Type') ?>', dataField: 'location_type',filtertype:'list',width:'15%'},
                    { text: '<?= __('Applicant Type') ?>', dataField: 'applicant_type',filtertype:'list',width:'20%'},
                    { text: '<?= __('Divisions') ?>', dataField: 'area_division',filtertype:'list',width:'10%'},
                    { text: '<?= __('Districts') ?>', dataField: 'area_district',filtertype:'list',width:'10%'},

                    {
                        text: '<?= __('') ?>',

                        filtertype: 'none',
                        columntype: 'button',
                        cellsrenderer: function () {
                            return "<?= __('View') ?>";
                        },
                        buttonclick: function (row) {
                            id = $("#dataTable").jqxGrid('getrowid', row);
                            window.location = "<?php echo $this->request->webroot; ?>Applicants/view/" + id;
                        },
                        width:'13.33%'
                    } ,
                    {
                        text: '<?= __('') ?>',

                        filtertype: 'none',
                        columntype: 'button',
                        cellsrenderer: function () {
                            return "<?= __('Edit') ?>";
                        },
                        buttonclick: function (row) {
                            id = $("#dataTable").jqxGrid('getrowid', row);
                            window.location = "<?php echo $this->request->webroot; ?>Applicants/edit/" + id;
                        },
                        width:'13.33%'
                    },
                    {
                        text: '<?= __('') ?>',

                        filtertype: 'none',
                        columntype: 'button',
                        cellsrenderer: function () {
                            return "<?= __('Transfer') ?>";
                        },
                        buttonclick: function (row) {
                            id = $("#dataTable").jqxGrid('getrowid', row);
                            window.location = "<?php echo $this->request->webroot; ?>Applicants/transfer/" + id;

                        },
                        width:'13.33%'
                    },

                ]
            });
    });
</script>
