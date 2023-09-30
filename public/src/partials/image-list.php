<?php if (!empty($product['image_path'])): ?>
    <p>Uploaded Images:</p>
    <span class="image-description">(Check to remove the selected images)</span>
    <ul>
        <?php $imageNames = json_decode($product['image_path'], true); ?>
        <?php foreach ($imageNames as $imageName): ?>
            <li>
                <input type="checkbox" name="remove_images[]" value="<?php echo $imageName; ?>">
                <?php echo $imageName; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
