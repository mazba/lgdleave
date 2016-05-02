<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $applicantTypesOfficeUnit->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $applicantTypesOfficeUnit->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Applicant Types Office Units'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applicant Types'), ['controller' => 'ApplicantTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Applicant Type'), ['controller' => 'ApplicantTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Office Units'), ['controller' => 'OfficeUnits', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Office Unit'), ['controller' => 'OfficeUnits', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantTypesOfficeUnits form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantTypesOfficeUnit) ?>
    <fieldset>
        <legend><?= __('Edit Applicant Types Office Unit') ?></legend>
        <?php
            echo $this->Form->input('applicant_type_id', ['options' => $applicantTypes]);
            echo $this->Form->input('office_unit_id', ['options' => $officeUnits]);
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
