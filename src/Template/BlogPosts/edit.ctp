<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $blogPost->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $blogPost->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Blog Posts'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="blogPosts form large-9 medium-8 columns content">
    <?= $this->Form->create($blogPost) ?>
    <fieldset>
        <legend><?= __('Edit Blog Post') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('post');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
