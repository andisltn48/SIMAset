<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://kit.fontawesome.com/767ff093f8.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png/x-icon" href="{{ asset('img/logo-itk-text.png') }}">
    <title>SIM-Aset @isset($title)
            - {{ $title }}
        @endisset</title>

    <script src="//code.jquery.com/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div id="wrapper">
        <div class="container">
            <div class="row shadow mt-3 p-4 bg-white rounded text-center">
                <div class="news-title fw-bolder fs-2">
                    Rapat Hokage
                </div>
                <div class="news-time mt-3 fs-5 text-dark">
                    Selasa, 69-69-6666
                </div>
            </div>
            <div class="row">
                <div class="col-8 me-3 shadow mt-3 p-3 bg-white rounded">
                    <div class="d-flex justify-content-center align-items-center">
                        <figure class=" news-image">
                            <img class="shadow rounded" src="{{ asset('img/rapat-hokage.jpeg') }}" alt="">
                            <figcaption class="image-description p-2">
                                <ul>
                                    <li><i class="fas fa-newspaper me-4 mt-2"></i><span class="title-activity">Rapat
                                            Hokage</span></li>
                                    <li><i class="fas fa-calendar-day me-4 mt-2"></i>Selasa, 69-69-6666</li>
                                    <li><i class="fas fa-location-arrow me-4 mt-2"></i><span class="title-location">Desa
                                            Konoha</span></li>
                                </ul>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="publisher ps-3 pe-3 mt-3 row">
                        <div class="col" style="max-width: 6vw">
                            <img style="width: 4vw; margin-right: 1vw" src="{{ asset('img/publisher.png') }}" alt="">
                        </div>
                        <div class="col align-items-center" style="margin-left: -25px">
                            <h5 class="mt-2 card-title fw-bold text-primary">Erza Bawu</h5>
                            <h6 class="card-subtitle mb-2 text-muted"><i
                                    class="fas fa-location-arrow me-4"></i>Balikpapan
                            </h6>
                            <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-calendar-day me-4"></i>Selasa,
                                96-96-9999</h6>
                        </div>
                        <hr>
                    </div>
                    <div class="content-news ps-3 pe-3">
                        <p class="news-description-text"><span class="fw-bolder">Lorem Ipsum</span> is simply dummy
                            text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                            dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                            it to make a type specimen book. It has survived not only five centuries, but also the leap
                            into electronic typesetting, remaining essentially unchanged. It was popularised in the
                            1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently
                            with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.is
                            simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                            industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                            passages, and more recently with desktop publishing software like Aldus PageMaker including
                            versions of Lorem Ipsum.is simply dummy text of the printing and typesetting industry. Lorem
                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                            printer took a galley of type and scrambled it to make a type specimen book. It has survived
                            not only five centuries, but also the leap into electronic typesetting, remaining
                            essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                            containing Lorem Ipsum passages, and more recently with desktop publishing software like
                            Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <p class="news-description-text"><img style="width: 40%; float:left; margin-right: 1vw"
                                src="{{ asset('img/rapat-hokage-2.jpeg') }}" alt=""><span class="fw-bolder">Lorem
                                Ipsum</span> is simply dummy
                            text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                            dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                            it to make a type specimen book. It has survived not only five centuries, but also the leap
                            into electronic typesetting, remaining essentially unchanged. It was popularised in the
                            1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently
                            with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.is
                            simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                            industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                            passages, and more recently with desktop publishing software like Aldus PageMaker including
                            versions of Lorem Ipsum.is simply dummy text of the printing and typesetting industry. Lorem
                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                            printer took a galley of type and scrambled it to make a type specimen book. It has survived
                            not only five centuries, but also the leap into electronic typesetting, remaining
                            essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                            containing Lorem Ipsum passages, and more recently with desktop publishing software like
                            Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                </div>
                <div class="col another-news ">
                    {{-- <div class="card shadow mt-3 p-3 bg-white rounded">
                        <div class="card-body">
                            <h5 class="card-title">Rapat Hokage 2</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Selasa, 96-96-9999</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content. Erja kntl</p>
                            <a href="#" class="card-link btn btn-primary">Selengkapnya</a>
                        </div>
                    </div> --}}
                    <div class="shadow mt-3 p-3 bg-white rounded card">
                        <div class="bg-white card-header text-primary fw-bolder fs-3">
                            Lastest News
                        </div>
                        <div id="example">
                            <div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Rapat Hokage 2</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Posted - Selasa, 96-96-9999</h6>
                                    <img style="width: 50%; margin-right: 1vw"
                                            src="{{ asset('img/rapat-hokage-2.jpeg') }}" alt="">
                                    <a href="#" class="card-link btn btn-primary">Selengkapnya</a>
                                </div>
                                <hr>
                            </div>
                            <div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Perang Ninja 3</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Posted - Jumat, 96-96-9999</h6>
                                    <img style="width: 50%; margin-right: 1vw"
                                            src="{{ asset('img/perang ninja 3.jpg') }}" alt="">
                                    <a href="#" class="card-link btn btn-primary">Selengkapnya</a>
                                </div>
                                <hr>
                            </div>
                            <div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Perang Ninja 3</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Posted - Jumat, 96-96-9999</h6>
                                    <img style="width: 50%; margin-right: 1vw"
                                            src="{{ asset('img/perang ninja 3.jpg') }}" alt="">
                                    <a href="#" class="card-link btn btn-primary">Selengkapnya</a>
                                </div>
                                <hr>
                            </div>
                            <div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Perang Ninja 3</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Posted - Jumat, 96-96-9999</h6>
                                    <img style="width: 50%; margin-right: 1vw"
                                            src="{{ asset('img/perang ninja 3.jpg') }}" alt="">
                                    <a href="#" class="card-link btn btn-primary">Selengkapnya</a>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/jquery.paginate.js') }}"></script>

<script>
    //call paginate
    $('#example').paginate();
</script>

</html>
