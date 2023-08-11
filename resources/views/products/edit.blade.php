<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product Form CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Product</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('products.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product Name:</strong>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                            placeholder="Product name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product Description:</strong>
                        <input type="text" name="description" class="form-control" placeholder="Product Description"
                            value="{{ $product->description }}">
                        @error('description')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product Price:</strong>
                        <input type="number" name="price" class="form-control" placeholder="Product Price"
                            value="{{ $product->price }}">
                        @error('price')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Category:</strong>
                <select name="category_name" class="form-control">
                  @foreach ($categories as $category)
               <option value="{{ $category->name }}" {{ optional($product->category)->name === $category->name ? 'selected' : '' }}>
                 {{ $category->name }}
               </option>
                 @endforeach
               </select>
                 @error('category_name')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                 @enderror
            </div>
       </div>

       <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                  <strong>Product Color:</strong>
                  <select name="colors[]" class="form-control" multiple>
                    @foreach ($colors as $color)
                  <option value="{{ $color->id }}" {{ in_array($color->id, $product->colors->pluck('id')->toArray()) ? 'selected' : '' }}>
                      {{ $color->name }}
                    </option>
                   @endforeach
                </select>
                   @error('colors')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
            </div>

         </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product Status:</strong>
                        <input type="number" name="status" class="form-control" placeholder="Product Status"
                            value="{{ $product->status }}">
                        @error('status')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary ml-3">Submit</button>
         </div>
         
        </form>
    </div>
</body>

</html>
