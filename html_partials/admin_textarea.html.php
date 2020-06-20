<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="<?= $name ?>">
            <?= $label; ?>
        </label>
        <textarea class="appearance-none border border-red-500 h-64 block w-full bg-gray-200 text-gray-700 border border-gray-200
            rounded py-3 px-4 mb-3 leading-tight focus:outline-none 
            focus:bg-white focus:border-gray-500" id="<?= $name ?>" type="text" name="<?= $name ?>"><?= get_previous_input($name) ?? $model->{$name} ?? ''; ?></textarea>
    </div>
    <?php if (get_previous_error($name)) : ?>
        <p class="text-red-500 text-xs italic p-1 mb-3">
            <?= get_previous_error($name); ?>
        </p>
    <?php endif; ?>
</div>