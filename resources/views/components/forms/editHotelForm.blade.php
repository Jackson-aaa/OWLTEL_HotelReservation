<div>
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
</div>
<div>
    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea>
</div>
<div>
    <label for="address">Address:</label>
    <textarea name="address" id="address" required></textarea>
</div>
<div>
    <label for="location_id">Location ID:</label>
    <select name="location_id" id="location_id" required>
        <option value="" disabled selected>Select Location ID</option>
        @foreach ($row['location_id'] as $item)
        <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
    </select>
</div>

<div>
    <label for="image-preview">Current Image:</label>
    <img id="image-preview" src="" alt="Current Image" width="100" style="display: block;">
</div>
<div>
    <label for="initial_price">Initial Price:</label>
    <input type="text" name="initial_price" id="initial_price">
</div>
<div class="sub-container">
    <button class="sub-button" type="submit">Submit</button>
</div>