<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
<?php endif; ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
    <?= Form::customLabel($name, $options['label'], $options['label_attr']) ?>
<?php endif; ?>

<?php if ($showField): ?>
    <?php if (isset($options['translatable']) && $options['translatable'] === true): ?>
    <div class="input-group justify-content-end">
    <?php endif; ?>

    <?php if ($options['url_show']): ?>
    <iframe src="<?= $options['url_show'] ?>" width="100%" height="600" frameborder="0"></iframe>
    <?php endif; ?>
    <visual-editor name="{{ $name }}" class="{{ $options['attr']['class'] }}" value="{{ $options['value'] }}" preview="{{ $options['url_preview'] }}" hidden></visual-editor>
    <button type="button" class="open_visual_editor">Afficher l'éditeur</button>

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
