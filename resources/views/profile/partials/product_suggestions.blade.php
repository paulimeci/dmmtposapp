<!-- resources/views/partials/product_suggestions.blade.php -->
@foreach($products as $product)
    <div class="product-suggestion">{{ $product->name }}</div>
@endforeach
