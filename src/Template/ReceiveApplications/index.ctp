<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-coffee"></i>All Pending Applications
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
        var url = "<?php echo $this->request->webroot; ?>ReceiveApplications";

        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
                { name: 'id', type: 'int' },
                { name: 'temporary_id', type: 'string' },
                { name: 'location_type', type: 'string' },
                { name: 'area_district', type: 'string' },
                { name: 'area_division', type: 'string' },
                { name: 'applicant_type', type: 'string' },
                { name: 'application_type', type: 'string' }
            ],
            id: 'id',
            url: url
        };

        var dataAdapter = new $.jqx.dataAdapter(source);

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
                    { text: '<?= __('Application Id') ?>', dataField: 'temporary_id',width:'20%'},
                    { text: '<?= __('Location Type') ?>', dataField: 'location_type',width:'12%'},
                    { text: '<?= __('Division') ?>', dataField: 'area_division',width:'10%'},
                    { text: '<?= __('District') ?>', dataField: 'area_district',width:'10%'},
                    { text: '<?= __('Applicant Type') ?>', dataField: 'applicant_type',width:'15%'},
                    { text: '<?= __('Application Type') ?>', dataField: 'application_type',width:'15%'},
                    { text: '<?= __('Actions') ?>', cellsalign: 'center',dataField: 'action',width:'18%'}
                ]
            });
    });
</script>
