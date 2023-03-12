<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Keluh Kesah Penduduk Planet Depok</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{asset('frontend/assets/favicon.ico')}}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('frontend/css/styles.css')}}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="{{asset('frontend/assets/img/navbar-logo.svg')}}" alt="..." /></a>
                {{-- <a class="navbar-brand" href="#page-top"><img src="https://icons8.com/icon/DwQljUGqOi7K/soldier-man" alt="..." /></a> --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Data Akun</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Laporan Ku</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">FORM Aduan</a></li>
                        @if (Auth::guard('masyarakat')->check())
                            {{-- <li class="nav-item"><a class="nav-link" href="{{url('myaccount')}}">My Account</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('logout')}}">Logout</a></li> --}}
                            <div class="dropdown">
                                <a type="button" class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                  {{auth()->guard('masyarakat')->user()->nama}}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="{{url('myaccount')}}">My Account</a></li>
                                    <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                                </ul>
                            </div>
                        @else
                        <li class="nav-item"><a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Register</a></li> --}}
                        {{-- <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login Di sini YGY</a></li> --}}
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Welcome To Our Studio!</div>
                <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
                @if (Auth::guard('masyarakat')->check())
                <a class="btn btn-primary btn-xl text-uppercase" href="#contact">Daftar Pengaduan</a>
                @else
                <a type="button" class="btn btn-primary btn-xl text-uppercase" href="javascript:void()" data-bs-toggle="modal" data-bs-target="#loginModal">Login Untuk Buat Pengaduan</a>
                @endif
            </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">data akun</h2>
            </div>
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                      <label for="" class="form-label">NIK</label>
                                      <input type="text"
                                        class="form-control" name="" id="" aria-describedby="helpId" placeholder="" required value="{{$user->nik}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                      <label for="" class="form-label">Name</label>
                                      <input type="text"
                                        class="form-control" name="" id="" aria-describedby="helpId" placeholder="" required value="{{$user->nama}}">
                                    </div>
                                    <div class="mb-3">
                                      <label for="" class="form-label">Email</label>
                                      <input type="text"
                                        class="form-control" name="" id="" aria-describedby="helpId" placeholder="" required value="{{$user->email}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                      <label for="" class="form-label">NO telfon</label>
                                      <input type="text"
                                        class="form-control" name="" id="" aria-describedby="helpId" placeholder="" required value="{{$user->telp}}">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if (auth()->guard('masyarakat')->check())
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">daftar laporan</h2>
                    <h3 class="section-subheading text-muted">berikut adalah daftar laporan anda.</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">NO</th>
                                                <th scope="col" class="text-center">Tanggal Aduan</th>
                                                <th scope="col" class="text-center">Judul Aduan</th>
                                                <th scope="col" class="text-center">Status</th>
                                                <th scope="col" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pengaduan as $k=>$v)
                                            <tr class="">
                                                <td scope="row" class="text-center">{{$k+1}}</td>
                                                {{-- <td>{{$v->tgl_pengaduan->format('j F,Y')}}</td> --}}
                                                <td class="text-center">{{\Carbon\Carbon::parse($v->tgl_pengaduan)->format('j F , Y')}}</td>
                                                <td class="text-center">{{$v->judul_pengaduan}}</td>
                                                <td class="text-center">
                                                    @if ($v->status == '0')
                                                    <span class="badge bg-danger">Pending</span>                                                    
                                                    @elseif($v->status == 'proses')
                                                    <span class="badge bg-warning text-dark">Proses</span>
                                                    @else
                                                    <span class="badge bg-success">Selesai</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="portfolio-link text-light" data-bs-toggle="modal" href="#modal-{{$k+1}}" title="Detail"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            <div class="portfolio-modal modal fade" id="modal-{{$k+1}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="close-modal" data-bs-dismiss="modal"><img src="{{asset('frontend/assets/img/close-icon.svg')}}" alt="Close modal" /></div>
                                                        <div class="container">
                                                            <div class="row justify-content-center">
                                                                <div class="col-lg-8">
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                          <label for="" class="form-label text-start">Judul Laporan</label>
                                                                          <input type="text"
                                                                            class="form-control" name="" id="" aria-describedby="helpId" placeholder="" value="{{$v->judul_pengaduan}}" disabled>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                          <label for="" class="form-label text-start">Tanggal Pengaduan</label>
                                                                          <input type="text"
                                                                            class="form-control" name="" id="" aria-describedby="helpId" placeholder="" value="{{\Carbon\Carbon::parse($v->tgl_pengaduan)->format('j F , Y')}}" disabled>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                          <label for="" class="form-label text-start">Status : @if($v->status == '0') <span class="badge bg-danger">Pending</span> @elseif($v->status == 'proses') <span class="badge-bg-warning">Proses</span> @else <span class="badge bg-success">Selesai</span> @endif</label>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                          <label for="" class="form-label">Isi Laporan</label>
                                                                          <textarea class="form-control" name="" id="" rows="3" disabled>
                                                                            {{$v->isi_laporan}}
                                                                          </textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="">FOTO Aduan</label>
                                                                            <img src="{{asset('Dokumentasi/Pengaduan/'.$v->foto)}}" alt="" class="img-fluid">
                                                                        </div>
                                                                        <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                                                            <i class="fas fa-xmark me-1"></i>
                                                                            Close Project
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!-- Contact-->
        @if (Auth::guard('masyarakat')->check())
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">FORM Pengaduan</h2>
                    <h3 class="section-subheading text-muted text-capitalize">buat pengaduan dengan mengisi form di bawah ini.</h3>
                </div>
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->
                <form id="contactForm" action="{{url('kirim-pengaduan')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            {{-- <input type="hidden" name="tgl_pengaduan" value="{{$data['tanggal']}}"> --}}
                            {{-- <input type="hidden" name="nik" value="{{Auth::guard('masyarakat')->user()->nik}}"> --}}
                            <div class="form-group">
                                <!-- Name input-->
                                <input type="text" readonly name="tgl_pengaduan" value="{{$data['tanggal']}}">
                                <div class="invalid-feedback" data-sb-feedback="name:required">A Judul Pengaduan is required.</div>
                                @if ($errors->has('judul_pengaduan'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('judul_pengaduan') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" name="judul_pengaduan" value="{{old('judul_pengaduan')}}" id="judul_pengaduan" type="text" placeholder="Judul Pengaduan" data-sb-validations="required" required/>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A Judul Pengaduan is required.</div>
                                @if ($errors->has('judul_pengaduan'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('judul_pengaduan') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" id="foto" type="file" name="foto" placeholder="Foto" data-sb-validations="required" required accept="image/*"/>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A Foto is required.</div>
                                @if ($errors->has('foto'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('foto') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <!-- Category input-->
                                <select name="category" id="" class="form-control" required>
                                    <option value="" selected>--- Pilih Category --- </option>
                                    @foreach ($data['category'] as $v)
                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                                @if ($errors->has('category'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{-- <div class="form-group">
                                <!-- Email address input-->
                                <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div> --}}
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <!-- Message input-->
                                <textarea class="form-control" id="message" placeholder="Your Message *" data-sb-validations="required" name="isi_laporan" required>{{old('isi_laporan')}}</textarea>
                                <div class="invalid-feedback" data-sb-feedback="message:required">Isi Lpaoran is required.</div>
                                @if ($errors->has('isi_laporan'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('isi_laporan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center text-white mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            To activate this form, sign up at
                            <br />
                            <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                    <!-- Submit Button-->
                    <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit">Send Message</button></div>
                </form>
            </div>
        </section>
        @endif
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Modal Lodgin -->
        <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{route('post-log-user')}}">
                <div class="modal-body">
                    <h4 class="text-center text-uppercase">form login</h4>
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control p_input" name="email">
                        </div>
                        <div class="form-group">
                            <label>Password </label>
                            <input type="password" class="form-control p_input" name="password">
                        </div>
                        {{-- <p class="sign-up">Don't have an Account? <a class="text-secondary text-decoration-none" type="button" data-bs-toggle="modal" data-bs-target="#registerModal">Register Here</a></p> --}}
                        <p class="sign-up">Don't have an Account? <a class="text-secondary text-decoration-none" href="{{url('register')}}">Register Here</a></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        <!-- Portfolio Modals-->
        <!-- Portfolio item 1 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="{{asset('frontend/assets/img/close-icon.svg')}}" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="{{asset('frontend/assets/img/portfolio/1.jpg')}}" alt="..." />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Threads
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Illustration
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 2 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="{{asset('frontend/assets/img/close-icon.svg')}}" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="{{asset('frontend/assets/img/portfolio/2.jpg')}}" alt="..." />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Explore
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Graphic Design
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 3 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="{{asset('frontend/assets/img/close-icon.svg')}}" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="{{asset('frontend/assets/img/portfolio/3.jpg')}}" alt="..." />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Finish
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Identity
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 4 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="{{asset('frontend/assets/img/close-icon.svg')}}" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="{{asset('frontend/assets/img/portfolio/4.jpg')}}" alt="..." />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Lines
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Branding
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 5 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="{{asset('frontend/assets/img/close-icon.svg')}}" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="{{asset('frontend/assets/img/portfolio/5.jpg')}}" alt="..." />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Southwest
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Website Design
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 6 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="{{asset('frontend/assets/img/close-icon.svg')}}" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="{{asset('frontend/assets/img/portfolio/6.jpg')}}" alt="..." />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Window
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Photography
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // $(document).ready(function () {
            //     $('#registerModal').modal('show');
            // });
            $(function ($) {  
                $.fn.inputFilter = function(callback, errMsg) {
                    return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function(e) {
                    if (callback(this.value)) {
                        // Accepted value
                        if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
                        $(this).removeClass("input-error");
                        this.setCustomValidity("");
                        }
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        // Rejected value - restore the previous one
                        $(this).addClass("input-error");
                        this.setCustomValidity(errMsg);
                        this.reportValidity();
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        // Rejected value - nothing to restore
                        this.value = "";
                    }
                    });
                };
                $(document).ready(function() {
                    $("#nik_regis").inputFilter(function(value) {
                        return /^\d*$/.test(value);    // Allow digits only, using a RegExp
                    },"Only digits allowed");
                });
            });
        </script>
        @if (Session::has('registFail'))
            <script>
                alert('gagal regist');
                $('#registerModal').modal('show');
            </script>
        @endif
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('frontend/js/scripts.js')}}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
