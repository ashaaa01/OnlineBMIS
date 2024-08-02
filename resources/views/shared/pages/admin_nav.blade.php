
<aside class="main-sidebar sidebar-dark-navy elevation-4" style="height: 100vh; background-color: #1E1E2C;">

    <!-- System title and logo -->
    {{-- <a href="{{ route('dashboard') }}" class="brand-link"> --}}
    <a href="" class="brand-link text-center">
        {{-- <img src="{{ asset('public/images/pricon_logo2.png') }}" --}}
        <img src=""
            class="brand-image img-circle elevation-3"
            style="opacity: .8">

        <span class="brand-text font-weight-light font-size"><h5>OBMIS</h5></span>
    </a> <!-- System title and logo -->

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                    {{-- <a href="" data-toggle="modal" data-target="" class="nav-link"> --}}
                        <i class="nav-icon fa-solid fa-gauge-high"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header font-weight-bold">&nbsp;BARANGAY MANAGEMENT</li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('resident_management') }}" class="nav-link">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>Barangay Resident</p></p>
                    </a>
                </li>
                <!--li class="nav-item has-treeview">
                    <a href="{{ route('blotter_management') }}" class="nav-link">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>Barangay Blotter</p></p>
                    </a>
                </li-->
                {{-- <li class="nav-item has-treeview">
                    <a href="{{ route('audit_trail_management') }}" class="nav-link">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>Audit Trail</p></p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item has-treeview">
                    <a href="#" data-toggle="modal" data-target="#" class="nav-link" style="cursor: not-allowed" title="On going module">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>Barangay Household</p></p>
                    </a>
                </li> --}}
                <li class="nav-item has-treeview">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="nav-icon fa-solid fa-file-signature"></i>
                        <p>Certificate Issuance<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('barangay_clearance_certificate') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-file-signature"></i>
                                <p>Barangay Clearance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('indigency_certificate') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-file-signature"></i>
                                <p>Indigency</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('residency_certificate') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-file-signature"></i>
                                <p>Residency</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('license_permit_certificate') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-file-signature"></i>
                                <p>Business Permit</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--li class="nav-item has-treeview">
                    <a href="{--{ route('registration_certificate') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-file-signature"></i>
                        <p>Registration</p></p>
                    </a>
                </li-->
                
                {{-- <!--li class="nav-item has-treeview">
                        <a href="{{ route('cedula_management') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-file-signature"></i>
                        <p>Cedula</p>
                    </a>
                </li--> --}}
                <li class="nav-header font-weight-bold">DOCUMENT PROCESSING MANAGEMENT</li>
                <li class="nav-item has-treeview">
                        <a href="{{ route('issuance_configuration_management') }}" class="nav-link">
                        <i class="fa-solid fa-users"></i>
                        <p>Document Processing Configuration</p>
                    </a>
                </li>
                <li class="nav-header font-weight-bold">USER MANAGEMENT</li>
                <li class="nav-item has-treeview">
                        <a href="{{ route('user_management') }}" class="nav-link">
                        <i class="fa-solid fa-users"></i>
                        <p>User</p>
                    </a>
                </li>
                {{-- <li class="nav-header font-weight-bold">LOOC DATABASE</li>
                <li class="nav-item has-treeview">
                        <a href="{{ route('resident_database_management') }}" class="nav-link">
                        <i class="fa-solid fa-users"></i>
                        <p>Looc Database</p>
                    </a>
                </li> --}}
                {{-- <li class="nav-header font-weight-bold"><i class="fas fa-cogs"></i>&nbsp;PAGE SETTINGS</li>
                <li class="nav-item has-treeview"> --}}
                     {{-- <a href="{{ route('product_classification') }}" class="nav-link">  --}}
                    {{-- <a href="#" data-toggle="modal" data-target="#" class="nav-link">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <p>About<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('about_management') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>About Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('history_management') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>History Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('mission_vision_management') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mission-Vision Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('officials_management') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Officials Page</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('activities_management') }}" class="nav-link">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <p>Activities</p>
                    </a>
                </li--> --}}
                {{-- <li class="nav-item has-treeview">
                    <a href="#" data-toggle="modal" data-target="#" class="nav-link" style="cursor: not-allowed" title="On going module">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <p>Contact</p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item has-treeview">
                    <a href="{{ route('announcement_management') }}" class="nav-link"> --}}
                    {{-- <a href="#" data-toggle="modal" data-target="#" class="nav-link" > --}}
                        {{-- <i class="fa-solid fa-pen-to-square"></i>
                        <p>Announcement</p>
                    </a>
                </li> --}}
                <li class="nav-header font-weight-bold">REPORT MANAGEMENT</li>
                <li class="nav-item has-treeview">
                        <a href="{{ route('report') }}" class="nav-link">
                        <i class="fa-solid fa-users"></i>
                        <p>Resident Report</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('certificates_reports') }}" class="nav-link">
                    <i class="fa-solid fa-users"></i>
                    <p>Document Report</p>
                </a>
            </li>
            </ul>
        </nav>
    </div><!-- Sidebar -->
</aside>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navLinks = document.querySelectorAll('.nav-link');
    
        // Function to set the active class
        function setActiveLink() {
            navLinks.forEach(link => link.classList.remove('active'));
            const activeLink = localStorage.getItem('activeLink');
            if (activeLink) {
                document.querySelector(`.nav-link[href='${activeLink}']`).classList.add('active');
            }
        }
    
        // Add click event listener to all nav links
        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                localStorage.setItem('activeLink', this.getAttribute('href'));
                setActiveLink();
            });
        });
    
        // Set the active class on page load
        setActiveLink();
    });
    </script>
    
    <style>
    /* Ensure high specificity for the sidebar nav links */
    .sidebar .nav-item .nav-link {
        color: #ffffff; /* Text color for links */
        transition: background-color 0.3s, color 0.3s; /* Smooth transition for hover effect */
    }

    .sidebar .nav-item .nav-link:hover,
    .sidebar .nav-item .nav-link.active {
        background-color: #a5a5a5 !important; /* Light gray background color */
        color: #000000 !important; /* Change text color to black for better contrast */
    }

    /* If you want a gradient effect for text, use the following */
    .sidebar .nav-item .nav-link-gradient:hover,
    .sidebar .nav-item .nav-link-gradient.active {
        background-color: #a5a5a5 !important; /* Light gray background color */
        color: transparent; /* Make the text color transparent */
        background: -webkit-linear-gradient(left, #1BCFB4, #A2EAD5); /* Gradient background */
        -webkit-background-clip: text; /* Clip the gradient to text */
        background-clip: text; /* Ensure gradient is clipped to text */
    }
</style>