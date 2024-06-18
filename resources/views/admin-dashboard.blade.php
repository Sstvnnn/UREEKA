<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<form action="{{route('addBook')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title">
    </div>
    <div class="form-group">
        <label for="isbn">ISBN</label>
        <input type="text" name="isbn" class="form-control" id="isbn">
    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" name="author" class="form-control" id="author">
    </div>
    <div class="form-group">
        <label for="publication_year">Publication Year</label>
        <input type="text" name="publication_year" class="form-control" id="publication_year">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div class="grid" style="display:grid; grid-template-columns:repeat(5, 1fr);">
    @foreach($books as $book)
        <div class="card" style="width: 18rem; margin: 1rem;">
            <div class="card-body" >
                <h5 class="card-title">{{ $book->title }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $book->author }}</h6>
                <span class="card-text">{{ $book->isbn }}</span>
                <span class="card-text">{{ $book->publication_year }}</span>
                <button type="button" class="btn btn-danger" style="display:block; margin:1rem 0 0 0;">Delete</button>
            </div>
        </div>
    @endforeach
</div>

</body>
</html>
