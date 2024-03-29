<?php if (isset($options['multiple']) && $options['multiple']): ?>
<?php $options['attr']['name'] = $name; ?>
<?php endif; ?>

<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
<?php endif; ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
    <?= Form::customLabel($options['real_name'], $options['label'], $options['label_attr']) ?>
<?php endif; ?>

<?php if ($showField): ?>
    <?php if (isset($options['translatable']) && $options['translatable'] === true): ?>
    <div class="input-group">
    <?php endif; ?>

        <?php $emptyVal = $options['empty_value'] ? ['' => $options['empty_value']] : null; ?>
        <?= Form::select($options['real_name'], (array)$emptyVal + $options['choices'], $options['selected'], $options['attr']) ?>

    <?php if (isset($options['translatable']) && $options['translatable'] === true): ?>
        @include('vendor.laravel-form-builder.translatable')
    </div>
    <?php endif; ?>

    @include('vendor.laravel-form-builder.help_block')
<?php endif; ?>

@include('vendor.laravel-form-builder.errors')

<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    </div>
    <?php endif; ?>
<?php endif; ?>
