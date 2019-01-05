@component('mail::message')
# Product Details

<img src="{{ Storage::url($product->image) }}" alt="Image">

<h2>{{ $product->name }}</h2>

<p><strong>$ {{ $product->price }}</strong></p>

<p>{{ $product->retailer->name }}</p>

{{ $product->description }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent