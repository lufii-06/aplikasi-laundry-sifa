 <div class="main-header">
     <div class="main-header-logo">
         <!-- Logo Header -->
         <div class="logo-header" data-background-color="dark">
             Dita Laundry
             <div class="nav-toggle">
                 <button class="btn btn-toggle toggle-sidebar">
                     <i class="gg-menu-right"></i>
                 </button>
                 <button class="btn btn-toggle sidenav-toggler">
                     <i class="gg-menu-left"></i>
                 </button>
             </div>
             <button class="topbar-toggler more">
                 <i class="gg-more-vertical-alt"></i>
             </button>
         </div>
         <!-- End Logo Header -->
     </div>
     <!-- Navbar Header -->
     <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">

         <div class="container-fluid d-flex justify-content-between">
             <?php echo $this->renderSection('breadcrumb') ?>
             <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                 <li class="nav-item topbar-user dropdown hidden-caret">
                     <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                         <div class="avatar-sm">
                             <img src="<?php echo base_url() ?>/assets/img/user-default.jpg" alt="..."
                                 class="avatar-img rounded-circle">
                         </div>
                         <span class="profile-username">
                             <span class="op-7">Hi,</span> <span
                                 class="fw-bold"><?php echo session()->get('user')->level ?? 'Silahkan Login' ?></span>
                         </span>
                     </a>
                     <ul class="dropdown-menu dropdown-user animated fadeIn">
                         <div class="dropdown-user-scroll scrollbar-outer">
                             <li class="<?php echo session()->get('isLoggedIn') ? '' : 'd-none' ?>">
                                 <div class="user-box">
                                     <div class="avatar-lg"><img
                                             src="<?php echo base_url() ?>/assets/img/user-default.jpg"
                                             alt="image profile" class="avatar-img rounded"></div>
                                     <div class="u-text">
                                         <h4 class="">
                                             Username
                                             :<?php echo session()->get('user')->username ?? '' ?></h4>
                                     </div>
                                 </div>
                             </li>
                             <li>
                                 <div class="dropdown-divider"></div>
                                 <?php if (session()->get('isLoggedIn')): ?>
                                 <!-- Jika sudah login -->
                                 <a class="dropdown-item" href="/logout">Logout</a>
                                 <?php else: ?>
                                 <!-- Jika belum login -->
                                 <a class="dropdown-item" href="/login">Login</a>
                                 <?php endif; ?>
                             </li>
                         </div>
                     </ul>
                 </li>
             </ul>
         </div>
     </nav>
     <!-- End Navbar -->
 </div>