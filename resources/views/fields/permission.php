<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
<?php endif; ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
    <?= Form::customLabel($options['real_name'], $options['label'], $options['label_attr']) ?>
<?php endif; ?>

<?php if ($showField): ?>
    <?php $current_module = ''; ?>

    <div class="table-responsive">
        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <tbody class="text-gray-600 fw-bold">
                <?php foreach ((array)$options['children'] as $key => $child): ?>
                <?php $child_options = $child->getOptions(); ?>
                <?php $child_options_label = $child_options['label']; ?>
                <?php $child_options_module = explode(':', $child_options_label)[0]; ?>

                <?php if ($child_options_module != $current_module): ?>
                <?php if ($current_module != ''): ?>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>

                <?php $current_module = $child_options_module; ?>
                <tr>
                    <td><?= $current_module; ?></td>
                    <td>
                        <div class="d-flex">
                <?php endif; ?>
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                <?= $child->render($options['choice_options'], false, true, false) ?>
                                <span class="form-check-label"><?= explode(':', $child_options_label)[1] ?></span>
                            </label>
                <?php endforeach; ?>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php include realpath(__DIR__ . '/../vendor/laravel-form-builder/help_block.php') ?>
<?php endif; ?>

<?php include realpath(__DIR__ . '/../vendor/laravel-form-builder/errors.php') ?>

<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    </div>
    <?php endif; ?>
<?php endif; ?>
