@inject('countries', 'App\Http\Utilities\Country')

{{ csrf_field() }}

<div class="form-group">
	<label for="biodata">Introduce yourself:</label>
	<textarea type="text" name="biodata" id="biodata" class="form-control" rows="10" required>{{ old('biodata') }}</textarea>
</div>

<div class="form-group">
	<label for="name">Name:</label>
	<input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
</div>

<div class="form-group">
	<label for="age">Age:</label>
	<input type="integer" name="age" id="age" class="form-control" min="15" value="{{ old('age') }}" required>
</div>

<div class="form-group">
	<label for="contac">Contact No. :</label>
	<input type="text" name="contact" id="contact" class="form-control" value="{{ old('contact') }}" required>
</div>

<div class="form-group">
	<label for="location">Location: (example Bangsar Shopping Center, KLCC Convention Center)</label>
	<input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
</div>

<div class="form-group">
	<label for="street">Street:</label>
	<input type="text" name="street" id="street" class="form-control" value="{{ old('street') }}" required>
</div> 

<div class="form-group">
	<label for="city">City:</label>
	<input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" required>
</div> 

<div class="form-group">
	<label for="zip">Zip:</label>
	<input type="text" name="zip" id="zip" class="form-control" value="{{ old('zip') }}" required>
</div> 

<div class="form-group">
	<label for="state">State:</label>
	<input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}" required>
</div>	

<div class="form-group">
	<label for="country">Country:</label>
	<select name="country" id="country" class="form-control" required>
		@foreach ($countries::all() as $code => $name)
			<option value="{{ $code }}">{{ $name }}</option>
		@endforeach
	</select>
</div> 


<div class="form-group">
	<button type="submit" class="btn btn-primary">Submit</button>
</div> 