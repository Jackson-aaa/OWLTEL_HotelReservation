<div>
    <label for=" name">Name:</label>
    <input type="text" name="name" id="edit-name" required>
</div>
<div>
    <label for="location_id">Location ID:</label>
    <input type="text" name="location_id" id="edit-location_id">
</div>
<div>
    <label for="type">Type:</label>
    <select name="type" id="edit-type" required>
        <option value="" disabled>Select Type</option>
        <option value="country">Country</option>
        <option value="region">Region</option>
        <option value="city">City</option>
        <option value="place">Place</option>
    </select>
</div>
<div>
    <label for="description">Description:</label>
    <textarea name="description" id="edit-description" required></textarea>
</div>
<div>
    <label for="image">Image:</label>
    <input type="file" name="image" id="edit-image" accept="image/*">
</div>
<div>
    <label for="image-preview">Current Image:</label>
    <img id="image-preview" src="" alt="Current Image" width="100" style="display: block;">
</div>
<div class="sub-container">
    <button class="sub-button" type="submit">Submit</button>
</div>