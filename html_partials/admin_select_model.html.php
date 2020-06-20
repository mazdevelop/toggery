<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="<?= $name ?>">
            <?= $label; ?>
        </label>
        <select name="<?= $name ?>" id="<?= $name ?>" class="w-full">
            <?php foreach ($options as $option) : ?>
                <option value="<?= $option->id; ?>" <?= $option->id == (get_previous_input($name) ?? $model->{$name} ?? null) ? 'selected' : ''; ?>>
                    <?= $option->{$option_key_label}; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php if (get_previous_error($name)) : ?>
        <p class="text-red-500 text-xs italic p-1 mb-3">
            <?= get_previous_error($name); ?>
        </p>
    <?php endif; ?>
</div>