<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico"> -->
      <title>Books example for Bootstrap</title>
      <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <style>
         :root {
         --jumbotron-padding-y: 3rem;
         }
         .jumbotron {
         padding-top: var(--jumbotron-padding-y);
         padding-bottom: var(--jumbotron-padding-y);
         margin-bottom: 0;
         background-color: #fff;
         }
         @media (min-width: 768px) {
         .jumbotron {
         padding-top: calc(var(--jumbotron-padding-y) * 2);
         padding-bottom: calc(var(--jumbotron-padding-y) * 2);
         }
         }
         .jumbotron p:last-child {
         margin-bottom: 0;
         }
         .jumbotron-heading {
         font-weight: 300;
         }
         .jumbotron .container {
         max-width: 40rem;
         }
         footer {
         padding-top: 3rem;
         padding-bottom: 3rem;
         }
         footer p {
         margin-bottom: .25rem;
         }
         .box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05); }
      </style>
   </head>
   <body>
      <header>
         <div class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container d-flex justify-content-between">
               <a href="" class="navbar-brand d-flex align-items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="none" stroke="currentColor" class="mr-2">
                     <path fill-rule="evenodd" d="M3.214 1.072C4.813.752 6.916.71 8.354 2.146A.5.5 0 0 1 8.5 2.5v11a.5.5 0 0 1-.854.354c-.843-.844-2.115-1.059-3.47-.92-1.344.14-2.66.617-3.452 1.013A.5.5 0 0 1 0 13.5v-11a.5.5 0 0 1 .276-.447L.5 2.5l-.224-.447.002-.001.004-.002.013-.006a5.017 5.017 0 0 1 .22-.103 12.958 12.958 0 0 1 2.7-.869zM1 2.82v9.908c.846-.343 1.944-.672 3.074-.788 1.143-.118 2.387-.023 3.426.56V2.718c-1.063-.929-2.631-.956-4.09-.664A11.958 11.958 0 0 0 1 2.82z"></path>
                     <path fill-rule="evenodd" d="M12.786 1.072C11.188.752 9.084.71 7.646 2.146A.5.5 0 0 0 7.5 2.5v11a.5.5 0 0 0 .854.354c.843-.844 2.115-1.059 3.47-.92 1.344.14 2.66.617 3.452 1.013A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.276-.447L15.5 2.5l.224-.447-.002-.001-.004-.002-.013-.006-.047-.023a12.582 12.582 0 0 0-.799-.34 12.96 12.96 0 0 0-2.073-.609zM15 2.82v9.908c-.846-.343-1.944-.672-3.074-.788-1.143-.118-2.387-.023-3.426.56V2.718c1.063-.929 2.631-.956 4.09-.664A11.956 11.956 0 0 1 15 2.82z"></path>
                  </svg>
                  <strong>Books</strong>
               </a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarCollapse">
                  <ul class="navbar-nav mr-auto">
                     <li class="nav-item">
                        <a class="nav-link" href="/editor">Add book</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </header>
      <main role="main">
         <section class="jumbotron text-center">
            <div class="container">
               <h1 class="jumbotron-heading">Books</h1>
               <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
               <p>
                  <a href="/editor" class="btn btn-primary my-2">Add book</a>
               </p>
            </div>
         </section>
         <div class="album py-5 bg-light">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12 mb-3">
                     <input type="text" id="myFilter" class="form-control" onkeyup="myFunction()" placeholder="Search books by name...">
                  </div>
               </div>
               <div class="row" id="myItems">          
               @foreach ($books as $book)
                     <div class="col-lg-4">
                     <div class="card box-shadow mb-2">
                        <img class="card-img-top" src="storage/{{$book->id}}.jpg" onerror="this.onerror=null;this.src='img/no-image-available.jpg';" alt="Card image cap">
                        <div class="card-body">
                           <strong class="d-inline-block mb-2 text-primary text-lowercase">{{ $book->genre }}</strong>
                           <h5 class="card-title"><a href="books/{{ $book->id}}">{{ $book->name }}</a></h5>
                           <h6 class="card-subtitle mb-2 text-muted">{{ $book->email }}</h6>
                           <p class="card-text">{{ $book->abstract }}</p>
                           <ul class="list-group list-group-flush">
                            <li class="list-group-item">ISBN: {{ $book->isbn }}</li>
                            <li class="list-group-item">Length: {{ $book->length }} pages</li>
                            <li class="list-group-item">Publication date: {{ $book->publicationdate }}</li>
                          </ul>
                           <!-- <div class="text-center">
                              <div class="btn-group">
                                 <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                 <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                              </div>
                           </div> -->
                        </div>
                     </div>    
                     </div>      
                  @endforeach             
            </div>
         </div>
      </div>
      </main>
      <!-- Bootstrap core JavaScript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <!-- JS, Popper.js, and jQuery -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      <script>
         function myFunction() {
         var input, filter, cards, cardContainer, h5, title, i;
         input = document.getElementById("myFilter");
         filter = input.value.toUpperCase();
         cardContainer = document.getElementById("myItems");
         cards = cardContainer.getElementsByClassName("card");
         for (i = 0; i < cards.length; i++) {
             title = cards[i].querySelector(".card-body h5.card-title");
         if (title.innerText.toUpperCase().indexOf(filter) > -1) {
             cards[i].parentNode.style.display = "";
         } else {
             cards[i].parentNode.style.display = "none";
         }
         }
         }
      </script>
   </body>
</html>