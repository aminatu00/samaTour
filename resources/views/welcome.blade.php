<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sama Tour</title>
  <meta name="description" content="Application de gestion des files d'attente dans les hôpitaux">
  <meta name="keywords" content="hospital, file d'attente, réservation ticket, application">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center me-auto">
          <h1 class="sitename">Sama Tour</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#hero" class="active">Accueil<br></a></li>
            <li><a href="#about">À propos</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#departments">Départements</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="cta-btn d-none d-sm-block" href="{{ route('login') }}">Connexion</a>
        <a class="cta-btn d-none d-sm-block" href="{{ route('register') }}">Inscription</a>

      </div>

    </div>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">
      <img src="assets/img/fond.jpg" alt="" data-aos="fade-in">
      <div class="container position-relative">
        <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
          <h2>Bienvenue sur Sama Tour</h2>
          <p>Réservez votre ticket en ligne et suivez votre rang en temps réel.</p>
        </div><!-- End Welcome -->
      </div>
    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">
      <div class="container">
        <div class="row gy-4 gx-5">
          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
            <img src="assets/img/a.webp" class="img-fluid" alt="">
            <a href="" class="glightbox pulsating-play-btn"></a>
          </div>

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <h3>À propos de Sama Tour</h3>
            <p>Notre application simplifie la gestion des files d'attente dans les hôpitaux, offrant une solution moderne et efficace pour réduire le stress et améliorer la transparence du processus d’accueil.</p>
            <ul>
              <li>
                <i class="fa-solid fa-vial-circle-check"></i>
                <div>
                  <h5>Réservation de ticket en ligne</h5>
                  <p>Réservez votre ticket de passage sans avoir à vous déplacer.</p>
                </div>
              </li>
              <li>
                <i class="fa-solid fa-pump-medical"></i>
                <div>
                  <h5>Suivi en temps réel</h5>
                  <p>Suivez votre rang dans la file d’attente à tout moment.</p>
                </div>
              </li>
              <li>
                <i class="fa-solid fa-heart-circle-xmark"></i>
                <div>
                  <h5>Gestion des priorités</h5>
                  <p>Les urgences, les femmes enceintes et les personnes âgées sont priorisées.</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section><!-- /About Section -->

    <!-- Services Section -->
    <section id="services" class="services section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Découvrez les services de Sama Tour pour une gestion optimale des files d'attente</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-ticket-alt"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Réservation en ligne</h3>
              </a>
              <p>Réservez votre place dans la file d’attente depuis votre téléphone.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-clock"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Suivi en temps réel</h3>
              </a>
              <p>Suivez l’évolution de votre rang en temps réel grâce à l’application.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-bell"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Notifications</h3>
              </a>
              <p>Recevez des notifications quand votre tour approche.</p>
            </div>
          </div><!-- End Service Item -->
        </div>
      </div>
    </section><!-- /Services Section -->

    <!-- Departments Section -->
   <section id="departments" class="departments section">

      <!-- Titre de la section -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Départements</h2>
        <p>Les besoins des patients sont divers et spécifiques, c'est pourquoi chaque département est spécialisé dans un domaine particulier de la santé.</p>
      </div><!-- Fin du titre de la section -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" href="#departments-tab-1">Cardiologie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-2">Neurologie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-3">Hépatologie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-4">Pédiatrie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-5">Soins Oculaires</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="departments-tab-1">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Cardiologie</h3>
                    <p class="fst-italic">Un département axé sur la santé cardiaque, offrant une prise en charge des pathologies du cœur.</p>
                    <p>Nos spécialistes en cardiologie offrent des soins adaptés à chaque patient, avec des traitements de pointe pour les maladies cardiaques. De l'évaluation à la réhabilitation, nos équipes sont là pour vous accompagner.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/departments-1.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="departments-tab-2">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Neurologie</h3>
                    <p class="fst-italic">Un département dédié au traitement des troubles du système nerveux central et périphérique.</p>
                    <p>La neurologie se concentre sur les maladies affectant le cerveau, la moelle épinière et les nerfs. Nos neurologues sont spécialisés dans l'évaluation, le diagnostic et le traitement des pathologies neurologiques complexes.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/departments-2.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="departments-tab-3">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Hépatologie</h3>
                    <p class="fst-italic">Des soins spécialisés pour les maladies du foie et des voies biliaires.</p>
                    <p>Notre département d'hépatologie s'assure du diagnostic, du traitement et du suivi des pathologies hépatiques, incluant les hépatites et les troubles du foie. Les patients bénéficient d'un suivi personnalisé et d'un accès à des traitements modernes.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/departments-3.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="departments-tab-4">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Pédiatrie</h3>
                    <p class="fst-italic">Un département spécialisé dans les soins aux enfants, de la naissance à l'adolescence.</p>
                    <p>Nos pédiatres sont dédiés à la santé des enfants, en veillant à leur développement physique et mental. Nous offrons des soins préventifs, des vaccinations, ainsi que des traitements pour diverses maladies infantiles.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/departments-4.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="departments-tab-5">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Soins Oculaires</h3>
                    <p class="fst-italic">Des soins spécialisés pour le diagnostic et le traitement des affections oculaires.</p>
                    <p>Le département de soins oculaires offre des services de diagnostic et de traitement des maladies des yeux, incluant la cataracte, le glaucome, ainsi que la correction des troubles de la vision à travers des interventions chirurgicales ou des traitements médicaux.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/departments-5.jpg" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Section Départements -->

  </main>

  <footer id="footer" class="footer light-background">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Sama Tour</span>
          </a>
          
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
