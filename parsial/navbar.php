    <!-- ====== NavbarStart --> <!--  -->
    <div class="ud-header absolute left-0 top-0 z-40 flex w-full items-center bg-transparent">
      <div class="container">
        <div class="relative -mx-4 flex items-center justify-between">
          <div class="w-60 max-w-full px-4">
            <a href="<?php echo BASE_URL; ?>" class="navbar-logo block w-full py-5">
              <img src="<?php echo ASSETS_URL; ?>images/logo/logo-white.png" alt="logo" class="header-logo w-full" />
            </a>
          </div>
          <div class="flex w-full items-center justify-between px-4">
            <div>
              <button id="navbarToggler" class="absolute right-4 top-1/2 block -translate-y-1/2 rounded-lg px-3 py-[6px] ring-primary focus:ring-2 lg:hidden">
                <span class="relative my-[6px] block h-[2px] w-[30px] bg-white"></span>
                <span class="relative my-[6px] block h-[2px] w-[30px] bg-white"></span>
                <span class="relative my-[6px] block h-[2px] w-[30px] bg-white"></span>
              </button>
              <nav id="navbarCollapse" class="absolute right-4 top-full hidden w-full max-w-[250px] rounded-lg bg-white py-5 shadow-lg dark:bg-dark-2 lg:static lg:block lg:w-full lg:max-w-full lg:bg-transparent lg:px-4 lg:py-0 lg:shadow-none dark:lg:bg-transparent xl:px-6">
                <ul class="blcok lg:flex 2xl:ml-20">
                  <li class="group relative">
                    <a href="<?php echo BASE_URL; ?>" class="ud-menu-scroll mx-8 flex py-2 text-base font-medium text-dark group-hover:text-primary dark:text-white lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70"> Beranda </a>
                  </li>
                  <li class="group relative">
                    <a href="<?php echo BASE_URL; ?>kegiatan" class="ud-menu-scroll mx-8 flex py-2 text-base font-medium text-dark group-hover:text-primary dark:text-white lg:ml-7 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10"> Kegiatan </a>
                  </li>
                  <li class="group relative">
                    <a href="<?php echo BASE_URL; ?>artikel" class="ud-menu-scroll mx-8 flex py-2 text-base font-medium text-dark group-hover:text-primary dark:text-white lg:ml-7 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10"> Artikel </a>
                  </li>
                  <li class="group relative">
                    <a href="<?php echo BASE_URL; ?>gallery" class="ud-menu-scroll mx-8 flex py-2 text-base font-medium text-dark group-hover:text-primary dark:text-white lg:ml-7 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10"> Galeri </a>
                  </li>
                  <li class="group relative">
                    <a href="<?php echo BASE_URL; ?>hubungi_kami" class="ud-menu-scroll mx-8 flex py-2 text-base font-medium text-dark group-hover:text-primary dark:text-white lg:ml-7 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10"> Hubungi </a>
                  </li>
                  <?php if (isset($_SESSION['user'])): ?>
                  <?php if ($_SESSION['user']['role'] == 'SuperAdmin'): ?>
                  <li class="submenu-item group relative">
                    <a href="javascript:void(0)" class="relative mx-12 flex items-center justify-between py-2 text-base font-medium text-dark group-hover:text-primary dark:text-white lg:ml-8 lg:mr-0 lg:inline-flex lg:py-6 lg:pl-0 lg:pr-4 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10"> Manage <svg class="ml-2 fill-current" width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.99999 14.9C7.84999 14.9 7.72499 14.85 7.59999 14.75L1.84999 9.10005C1.62499 8.87505 1.62499 8.52505 1.84999 8.30005C2.07499 8.07505 2.42499 8.07505 2.64999 8.30005L7.99999 13.525L13.35 8.25005C13.575 8.02505 13.925 8.02505 14.15 8.25005C14.375 8.47505 14.375 8.82505 14.15 9.05005L8.39999 14.7C8.27499 14.825 8.14999 14.9 7.99999 14.9Z" />
                      </svg>
                    </a>                    
                    <div class="submenu relative left-0 top-full hidden w-[250px] rounded-sm bg-white p-4 transition-[top] duration-300 group-hover:opacity-100 dark:bg-dark-2 lg:invisible lg:absolute lg:top-[110%] lg:block lg:opacity-0 lg:shadow-lg lg:group-hover:visible lg:group-hover:top-full">
                      <a href="<?php echo BASE_URL; ?>superadmin/dashboard" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> Dashboard </a>
                      <a href="<?php echo BASE_URL; ?>superadmin/manage_users" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> Pengguna </a>
                      <a href="<?php echo BASE_URL; ?>superadmin/manage_admin" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> Admin </a>
                      <a href="<?php echo BASE_URL; ?>superadmin/manage_articles" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> Artikel </a>
                      <a href="<?php echo BASE_URL; ?>superadmin/manage_events" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> Kegiatan </a>
                      <a href="<?php echo BASE_URL; ?>superadmin/manage_gallery" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> Galeri </a>
                      <a href="<?php echo BASE_URL; ?>superadmin/manage_donations" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> Donasi </a>
                      <a href="<?php echo BASE_URL; ?>superadmin/manage_qr" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> QR </a>
                    </div>
                  </li>
                  <?php endif; ?>
                  <?php endif; ?>
                  <?php if (isset($_SESSION['user'])): ?>
                  <?php if ($_SESSION['user']['role'] == 'Admin'): ?>
                  <li class="submenu-item group relative">
                    <a href="javascript:void(0)" class="relative mx-8 flex items-center justify-between py-2 text-base font-medium text-dark group-hover:text-primary dark:text-white lg:ml-8 lg:mr-0 lg:inline-flex lg:py-6 lg:pl-0 lg:pr-4 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10"> Manage <svg class="ml-2 fill-current" width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.99999 14.9C7.84999 14.9 7.72499 14.85 7.59999 14.75L1.84999 9.10005C1.62499 8.87505 1.62499 8.52505 1.84999 8.30005C2.07499 8.07505 2.42499 8.07505 2.64999 8.30005L7.99999 13.525L13.35 8.25005C13.575 8.02505 13.925 8.02505 14.15 8.25005C14.375 8.47505 14.375 8.82505 14.15 9.05005L8.39999 14.7C8.27499 14.825 8.14999 14.9 7.99999 14.9Z" />
                      </svg>
                    </a>                    
                    <div class="submenu relative left-0 top-full hidden w-[250px] rounded-sm bg-white p-4 transition-[top] duration-300 group-hover:opacity-100 dark:bg-dark-2 lg:invisible lg:absolute lg:top-[110%] lg:block lg:opacity-0 lg:shadow-lg lg:group-hover:visible lg:group-hover:top-full">
                      <a href="<?php echo BASE_URL; ?>admin/dashboard" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> Dashboard </a>
                      <a href="<?php echo BASE_URL; ?>admin/manage_users" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> Pengguna </a>
                      <a href="<?php echo BASE_URL; ?>admin/manage_articles" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> Artikel </a>
                      <a href="<?php echo BASE_URL; ?>admin/manage_events" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> Kegiatan </a>
                      <a href="<?php echo BASE_URL; ?>admin/manage_gallery" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> Galeri </a>
                      <a href="<?php echo BASE_URL; ?>admin/manage_donations" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> Donasi </a>
                      <a href="<?php echo BASE_URL; ?>admin/manage_qr" class="block rounded px-4 py-[10px] text-sm text-body-color hover:text-primary dark:text-dark-6 dark:hover:text-primary"> QR </a>
                    </div>
                  </li>                  
                  <?php endif; ?>
                  <?php endif; ?>
                </ul>
              </nav>
            </div>
            <div class="flex items-center justify-end pr-16 lg:pr-0">
              <label for="themeSwitcher" class="inline-flex cursor-pointer items-center" aria-label="themeSwitcher" name="themeSwitcher">
                <input type="checkbox" name="themeSwitcher" id="themeSwitcher" class="sr-only" />
                <span class="block text-white dark:hidden">
                  <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.3125 1.50001C12.675 1.31251 12.0375 1.16251 11.3625 1.05001C10.875 0.975006 10.35 1.23751 10.1625 1.68751C9.93751 2.13751 10.05 2.70001 10.425 3.00001C13.0875 5.47501 14.0625 9.11251 12.975 12.525C11.775 16.3125 8.25001 18.975 4.16251 19.0875C3.63751 19.0875 3.22501 19.425 3.07501 19.9125C2.92501 20.4 3.15001 20.925 3.56251 21.1875C4.50001 21.75 5.43751 22.2 6.37501 22.5C7.46251 22.8375 8.58751 22.9875 9.71251 22.9875C11.625 22.9875 13.5 22.5 15.1875 21.5625C17.85 20.1 19.725 17.7375 20.55 14.8875C22.1625 9.26251 18.975 3.37501 13.3125 1.50001ZM18.9375 14.4C18.2625 16.8375 16.6125 18.825 14.4 20.0625C12.075 21.3375 9.41251 21.6 6.90001 20.85C6.63751 20.775 6.33751 20.6625 6.07501 20.55C10.05 19.7625 13.35 16.9125 14.5875 13.0125C15.675 9.56251 15 5.92501 12.7875 3.07501C17.5875 4.68751 20.2875 9.67501 18.9375 14.4Z" />
                  </svg>
                </span>
                <span class="hidden text-white dark:block">
                  <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_2172_3070)">
                      <path d="M12 6.89999C9.18752 6.89999 6.90002 9.18749 6.90002 12C6.90002 14.8125 9.18752 17.1 12 17.1C14.8125 17.1 17.1 14.8125 17.1 12C17.1 9.18749 14.8125 6.89999 12 6.89999ZM12 15.4125C10.125 15.4125 8.58752 13.875 8.58752 12C8.58752 10.125 10.125 8.58749 12 8.58749C13.875 8.58749 15.4125 10.125 15.4125 12C15.4125 13.875 13.875 15.4125 12 15.4125Z" />
                      <path d="M12 4.2375C12.45 4.2375 12.8625 3.8625 12.8625 3.375V1.5C12.8625 1.05 12.4875 0.637497 12 0.637497C11.55 0.637497 11.1375 1.0125 11.1375 1.5V3.4125C11.175 3.8625 11.55 4.2375 12 4.2375Z" />
                      <path d="M12 19.7625C11.55 19.7625 11.1375 20.1375 11.1375 20.625V22.5C11.1375 22.95 11.5125 23.3625 12 23.3625C12.45 23.3625 12.8625 22.9875 12.8625 22.5V20.5875C12.8625 20.1375 12.45 19.7625 12 19.7625Z" />
                      <path d="M18.1125 6.74999C18.3375 6.74999 18.5625 6.67499 18.7125 6.48749L19.9125 5.28749C20.25 4.94999 20.25 4.42499 19.9125 4.08749C19.575 3.74999 19.05 3.74999 18.7125 4.08749L17.5125 5.28749C17.175 5.62499 17.175 6.14999 17.5125 6.48749C17.6625 6.67499 17.8875 6.74999 18.1125 6.74999Z" />
                      <path d="M5.32501 17.5125L4.12501 18.675C3.78751 19.0125 3.78751 19.5375 4.12501 19.875C4.27501 20.025 4.50001 20.1375 4.72501 20.1375C4.95001 20.1375 5.17501 20.0625 5.32501 19.875L6.52501 18.675C6.86251 18.3375 6.86251 17.8125 6.52501 17.475C6.18751 17.175 5.62501 17.175 5.32501 17.5125Z" />
                      <path d="M22.5 11.175H20.5875C20.1375 11.175 19.725 11.55 19.725 12.0375C19.725 12.4875 20.1 12.9 20.5875 12.9H22.5C22.95 12.9 23.3625 12.525 23.3625 12.0375C23.3625 11.55 22.95 11.175 22.5 11.175Z" />
                      <path d="M4.23751 12C4.23751 11.55 3.86251 11.1375 3.37501 11.1375H1.50001C1.05001 11.1375 0.637512 11.5125 0.637512 12C0.637512 12.45 1.01251 12.8625 1.50001 12.8625H3.41251C3.86251 12.8625 4.23751 12.45 4.23751 12Z" />
                      <path d="M18.675 17.5125C18.3375 17.175 17.8125 17.175 17.475 17.5125C17.1375 17.85 17.1375 18.375 17.475 18.7125L18.675 19.9125C18.825 20.0625 19.05 20.175 19.275 20.175C19.5 20.175 19.725 20.1 19.875 19.9125C20.2125 19.575 20.2125 19.05 19.875 18.7125L18.675 17.5125Z" />
                      <path d="M5.32501 4.125C4.98751 3.7875 4.46251 3.7875 4.12501 4.125C3.78751 4.4625 3.78751 4.9875 4.12501 5.325L5.32501 6.525C5.47501 6.675 5.70001 6.7875 5.92501 6.7875C6.15001 6.7875 6.37501 6.7125 6.52501 6.525C6.86251 6.1875 6.86251 5.6625 6.52501 5.325L5.32501 4.125Z" />
                    </g>
                    <defs>
                      <clipPath id="clip0_2172_3070">
                        <rect width="24" height="24" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                </span>
              </label>
              <div class="hidden sm:flex">              
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="flex items-center group relative space-x-4 px-[22px] py-2 py-2 duration-300 ease-in-out hover:bg-opacity-100">
                        <img src="<?php echo $_SESSION['user']['profile_pic'] ?: '<?php echo ASSETS_URL; ?>uploads/foto_default.svg'; ?>" alt="Foto Profil" class="w-10 h-10 rounded-full">
                        <div class="text-white">
                            <p class="loginBtn px-[12px] text-sm font-medium block rounded px-2 py-[2px] text-white text-body-color hover:text-white dark:text-dark-6 dark:hover:text-white"><a href="<?php echo BASE_URL; ?>profil"><?php echo htmlspecialchars($_SESSION['user']['name']); ?></a></p>
                        </div>
                    </div>
                    <div class="flex items-center group relative space-x-4 px-4 py-2 duration-300 ease-in-out hover:bg-opacity-100">
                    <div class="text-white">
                    <p class="loginBtn px-[22px] py-2 rounded bg-dark-6 text-base font-medium text-white hover:opacity-70"><a href="<?php echo BASE_URL; ?>controllers/LogoutController">Keluar</a></p>
                    </div>
                    </div>
                <?php else: ?>
                <a href="login" class="loginBtn px-[22px] py-2 bg-dark-6 text-base font-medium text-white hover:opacity-70"> Masuk </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ====== NavbarEnd -->