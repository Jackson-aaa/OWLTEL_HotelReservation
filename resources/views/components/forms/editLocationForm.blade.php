<div>
    <label for=" name">Name:</label>
    <input type="text" name="name" id="edit-name" required>
</div>
<div>
    <label for="type">Type:</label>
    <select name="type" id="edit-type" required>
        <option value="country">Country</option>
        <option value="region">Region</option>
        <option value="city">City</option>
        <option value="place">Place</option>
    </select>
</div>
<div>
    <label for="location_id">Location ID:</label>
    <select name="location_id" id="edit-location_id">
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


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const typeSelect = document.getElementById('edit-type');
        const locationSelect = document.getElementById('edit-location_id');
        const locations = @json($row['locations']);

        typeSelect.addEventListener('change', () => {
            const selectedType = typeSelect.value;
            console.log("seltype", selectedType);

            locationSelect.innerHTML = '<option value="" disabled selected>Select Location ID</option>';

            if (!selectedType || selectedType === 'country') {
                locationSelect.disabled = true;
            } else {
                locationSelect.disabled = false;

                let parentType = '';
                if (selectedType === 'region') parentType = 'country';
                if (selectedType === 'city') parentType = 'region';
                if (selectedType === 'place') parentType = 'city';

                const filteredLocations = locations.filter(location => location.type === parentType);

                filteredLocations.forEach(location => {
                    const option = document.createElement('option');
                    option.value = location.id;
                    option.textContent = location.name;
                    locationSelect.appendChild(option);
                });
            }
        });
    });
</script>