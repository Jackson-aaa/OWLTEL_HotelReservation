<div>
    <label for="payment">Payment:</label>
    <select name="payment" id="edit-payment" required>
        <option value="" disabled selected>Select Type</option>
        @foreach ($row['payments'] as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
    </select>
</div>
<div>
    <label for="name">Name:</label>
    <input type="text" name="name" id="edit-name" required>
</div>
<div>
    <label for="description">Description:</label>
    <input type="text" name="description" id="edit-description" required>
</div>
<div>
    <label for="image">Icon Image:</label>
    <input type="file" name="image" id="edit-image" accept="image/*">
</div>
<div>
    <label for="image-preview">Current Image:</label>
    <img id="image-preview" src="" alt="Current Image" width="100" style="display: block;">
</div>
<div class="mt-3">
    <label for="extra_fee">Extra Fee:</label>
    <input type="checkbox" name="extra_fee" id="extra_fee" onchange="showExtraFee(this.checked, true)">
</div>
<div class="opacity-25" id="edit-extra_fee_name_container">
    <label class="ms-2 me-1" for="extra_fee_name">Name:</label>
    <input type="text" name="extra_fee_name" id="edit-extra_fee_name" disabled required>
</div>
<div class="opacity-25" id="edit-extra_fee_percentage_container">
    <label class="ms-2 me-1" for="extra_fee_percentage">Percentage:</label>
    <input type="number" name="extra_fee_percentage" id="edit-extra_fee_percentage" disabled required>
</div>
<div class="sub-container">
    <button class="sub-button" type="submit">Submit</button>
</div>