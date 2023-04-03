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
        {{-- Sweetalert CDN --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                {{-- <a class="navbar-brand" href="#page-top"><img src="{{asset('frontend/assets/img/navbar-logo.svg')}}" alt="..." /></a> --}}
                <a href="{{url('/')}}" class="navbar-brand">Pengaduan <br>Masyarakat</a>
                {{-- <a class="navbar-brand" href="#page-top"><img src="https://icons8.com/icon/DwQljUGqOi7K/soldier-man" alt="..." /></a> --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">Statistic</a></li>
                        @if (Auth::guard('masyarakat')->check())
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                            {{-- <li class="nav-item"><a class="nav-link" href="{{url('myaccount')}}">My Account</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('logout')}}">Logout</a></li> --}}
                            <div class="dropdown">
                                <a type="button" class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                  {{auth()->guard('masyarakat')->user()->nama}}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="{{url('laporanku')}}">laporanku</a></li>
                                  <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                                </ul>
                            </div>
                        @else
                        <li class="nav-item"><a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Register</a></li> --}}
                        {{-- <li class="nav-item"p><a class="nav-link" href="{{route('login')}}">Login Di sini YGY</a></li> --}}
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Welcome!</div>
                <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
                @if (Auth::guard('masyarakat')->check())
                <a class="btn btn-primary btn-xl text-uppercase" href="#contact">Buat Pengaduan</a>
                @else
                <a type="button" class="btn btn-primary btn-xl text-uppercase" href="javascript:void()" data-bs-toggle="modal" data-bs-target="#loginModal">Login Untuk Buat Pengaduan</a>
                @endif
            </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Services</h2>
                    <h3 class="section-subheading text-muted text-capitalize">wadah aduan penduduk planet depok.</h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-clipboard-list fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Form</h4>
                        <p class="text-muted">Mudah Dalam Pengisian FORM !!!</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-user fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Responsive Admin</h4>
                        <p class="text-muted text-capitalize">Petugas Akan Menanggapi Laporan Anda Secara Cepat, dan Tepat.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Privacy Security</h4>
                        <p class="text-muted text-capitalize">kami menjamin keamanan data pemberi aduan.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">About</h2>
                    <h3 class="section-subheading text-muted text-capitalize">tahap-tahap proses aduan.</h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image">
                            {{-- <i class="fas fa-sign-in-alt"></i> --}}
                            <img class="rounded-circle img-fluid" src="{{asset('frontend/assets/img/about/1.jpg')}}" alt="..." />
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>LOGIN</h4>
                                {{-- <h4 class="subheading text-capitalize">jika anda belum mempunyai akun, <a href="{{url('register')}}" style="text-decoration: none">Daftar Di Sini</a> </h4> --}}
                            </div>
                            <div class="timeline-body"><p class="text-muted text-capitalize">jika anda belum mempunyai akun, <a href="{{url('register')}}" style="text-decoration: none">Daftar Di Sini</a></p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{asset('frontend/assets/img/about/2.jpg')}}" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>ISI FORM</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted text-capitalize">Setelah Login silahkan mengisi form dengan format yang telah disediakan.</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{asset('frontend/assets/img/about/3.jpg')}}" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>PROSES </h4>
                                {{-- <h4 class="subheading">Transition to Full Service</h4> --}}
                            </div>
                            <div class="timeline-body"><p class="text-muted text-capitalize">setelah mengisi form, petugas akan mulai memproses laporan mu.</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{asset('frontend/assets/img/about/4.jpg')}}" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>CEK ADUAN MU</h4>
                                {{-- <h4 class="subheading">Phase Two Expansion</h4> --}}
                            </div>
                            <div class="timeline-body"><p class="text-muted text-capitalize">tunggu beberapa hari, petugas akan memberi tanggapan pada laporan mu (bisa dicek di halaman my account setelah login).</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Be Part
                                <br />
                                Of Our
                                <br />
                                Story!
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Our Amazing statistic</h2>
                    {{-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> --}}
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="team-member">
                            <h4>{{$data['total_aduan']}}</h4>
                            <p class="text-muted text-capitalize">Total Aduan Yang Dibuat</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <h4>{{$data['total_user']}}</h4>
                            <p class="text-muted text-capitalize">total masyarakat yang sudah bergabung</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <h4>{{$data['aduan_clear']}}</h4>
                            <p class="text-muted text-capitalize">total pengaduan yang selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
        <!-- Modal Register -->
        <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="modal-header">
                                <h5 class="modal-title" id="registerModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{url('register/post')}}">
                                        @csrf
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="text"  class="form-control p_input" name="nik" minlength="16" maxlength="16" required value="{{old('nik')}}">
                                            @if ($errors->has('nik'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('nik') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control p_input" name="nama" required value="{{old('nama')}}">
                                            @if ($errors->has('nama'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('nama') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>NO Telfon</label>
                                            <input type="text" class="form-control p_input" name="telp" minlength="11" maxlength="13" required value="{{old('telp')}}">
                                            {{-- <input type="text" placeholder="Search For . . . " pattern= "[0-9]" value="{{ old('telp') }}" minlength="11" maxlength="13" name="telp" class="@error('telp') is-invalid @enderror form-control p_input" required  oninvalid="this.setCustomValidity('Please Fill With Number !!!')" onvalid="this.setCustomValidity('')"> --}}
                                            @if ($errors->has('telp'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('telp') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control p_input" name="email" required value="{{old('email')}}">
                                            </div>
                                            @if ($errors->has('email'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control p_input" name="email" required value="{{old('email')}}">
                                            </div>
                                            @if ($errors->has('email'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <p class="sign-up text-center">Already have an Account?<a href="{{url('login')}}"> Login</a></p>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Register</button>
                                        </div>
                                    </form>
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
        @if (Session::has('loginFail'))
            <script>
                // alert('gagal regist');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Login Gagal!',
                })
                $('#loginModal').modal('show');
            </script>
        @endif
        @if (Session::has('loginDone'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil...',
                })
            </script>
        @endif
        @if (Session::has('aduanDone'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Aduan Berhasil Dibuat...',
                })
            </script>
        @endif
        @if (Session::has('RegisterDone'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Akun Berhasil Dibuat !!!',
                })
            </script>
        @endif
        @if (Session::has('registFail'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Registrasi Gagal !!!',
                })
            </script>
        @endif
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('frontend/js/scripts.js')}}"></script>
        <script src="{{asset('js/alert.js')}}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
