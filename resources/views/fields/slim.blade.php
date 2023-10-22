<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
<?php endif; ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
    <?= Form::customLabel($name, $options['label'], $options['label_attr']) ?>
<?php endif; ?>

<?php if ($showField): ?>
    <div class="slim"
         data-min-size="300,300"
         data-force-size="300,300"
         data-label="Drop your avatar here"
         data-instant-edit="true"
         style="width: 300px; height: 300px;">

        <?php if (!empty($options['value'])): ?>
        <img src="<?= $options['value'] ?>" alt="">
        <?php endif; ?>

        <input type="file" name="slim[]" />
    </div>

    @include('vendor.laravel-form-builder.help_block')
<?php endif; ?>

@include('vendor.laravel-form-builder.errors')

<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    </div>
    <?php endif; ?>
<?php endif; ?>
