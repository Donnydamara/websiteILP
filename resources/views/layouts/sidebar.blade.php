<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Integrasi Layanan Primer</title>

    <!-- Custom fonts for this template-->
    <link href="{{ url('admin/assets/img/books.png') }}" rel="icon">
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        th,
        td {
            text-align: center;
        }

        .card {
            text-align: center;
        }

        /* Global Styles */
        body {
            font-family: 'Nunito', sans-serif;

        }

        /* Navbar Background */
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Profil Foto */
        .navbar .img-profile {
            width: 35px;
            height: 35px;
            border: 2px solid #ddd;
            object-fit: cover;
        }

        /* Dropdown Menu Styling */
        .navbar .dropdown-menu {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        /* Navbar Text */
        .navbar .navbar-brand {
            font-size: 1.2rem;
            color: #333;
        }

        .navbar .nav-link {
            font-weight: 500;
            color: #555;
        }

        .navbar .nav-link:hover {
            color: #007bff;
        }

        /* Toggler Button */
        .navbar-toggler {
            border: none;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .navbar .navbar-brand {
                font-size: 1rem;
            }

            .navbar .img-profile {
                width: 30px;
                height: 30px;
            }
        }


        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
            overflow-x: auto;
            /* Membuat elemen dapat di-scroll secara horizontal */
            white-space: nowrap;
            /* Mencegah konten dibungkus ke baris berikutnya */
        }

        .container::-webkit-scrollbar {
            display: none;
            /* Sembunyikan scrollbar pada browser berbasis Webkit (Chrome, Safari) */
        }

        .container {
            -ms-overflow-style: none;
            /* Sembunyikan scrollbar pada Internet Explorer dan Edge */
            scrollbar-width: none;
            /* Sembunyikan scrollbar pada Firefox */
        }

        /* Aturan tambahan untuk responsivitas */
        @media (max-width: 1200px) {
            .container {
                padding: 15px;
            }
        }

        @media (max-width: 768px) {
            .container {
                max-width: 100%;
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 5px;
            }
        }




        /* Profile Styles */
        .emp-profile {
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }

        .profile-img {
            text-align: center;
        }

        .profile-img img {
            width: 70%;
            height: auto;
            /* Biarkan tinggi mengikuti lebar sesuai aspek gambar */
        }

        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }

        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }

        .profile-head h5 {
            color: #333;
        }

        .profile-head h6 {
            color: #0062cc;
        }

        .profile-edit-btn {
            border: none;
            border-radius: 1.5rem;
            width: 100%;
            padding: 2%;
            font-weight: 600;
            color: #6c757d;
            cursor: pointer;

        }

        .proile-rating {
            font-size: 12px;
            color: #818182;
            margin-top: 5%;
        }

        .proile-rating span {
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }

        .profile-head .nav-tabs {
            margin-bottom: 5%;
        }

        .profile-head .nav-tabs .nav-link {
            font-weight: 600;
            border: none;
        }

        .profile-head .nav-tabs .nav-link.active {
            border: none;
            border-bottom: 2px solid #0062cc;
        }

        .profile-tab label {
            font-weight: 600;
        }

        .profile-tab p {
            font-weight: 600;
            color: #0062cc;
        }

        /* Scrollable Sidebar */
        #accordionSidebar {
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        #accordionSidebar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        #accordionSidebar {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        /* ========================== */
        /* Scrollable Sidebar */
        #content {
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        #content::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        #content {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        /* =================================== */

        /* Sidebar Styles */
        /* #sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            #sidebar {
                width: 0;
                overflow: hidden;
            }

            #sidebar.active {
                width: 250px;
            }
        } */

        #sidebar .nav-link {
            display: flex;
            align-items: center;
            overflow: hidden;
            /* Sembunyikan teks yang melebihi area */
            white-space: nowrap;
            /* Teks tidak akan membungkus ke baris berikutnya */
            text-overflow: ellipsis;
            /* Tambahkan elipsis (...) jika teks terlalu panjang */
        }

        #sidebar .nav-link span {
            flex-grow: 1;
            /* Isi ruang yang tersisa */
            margin-left: 10px;
            /* Jarak antara ikon dan teks */
        }

        #sidebar .nav-link i.material-icons {
            flex-shrink: 0;
            /* Ikon tidak menyusut */
            font-size: 24px;
            /* Ukuran ikon */
        }

        #sidebar .nav-link {
            padding: 10px 15px;
            /* Padding dalam tombol */
            font-size: 14px;
            /* Ukuran font teks */
            width: 100%;
            /* Pastikan tombol mengisi lebar sidebar */
            box-sizing: border-box;
            /* Termasuk padding dalam lebar */
        }

        @media (max-width: 768px) {
            #sidebar {
                width: 200px;
                /* Sesuaikan lebar sidebar untuk layar kecil */
            }

            #sidebar .nav-link {
                font-size: 12px;
                /* Ukuran font lebih kecil untuk layar kecil */
            }
        }







        /* button edit */
        .edit {
            border: none;
            display: block;
            position: relative;
            padding: 0.7em 2.4em;
            font-size: 14px;
            background: transparent;
            cursor: pointer;
            user-select: none;
            overflow: hidden;
            color: royalblue;
            z-index: 1;
            font-family: inherit;
            font-weight: 500;
            margin-right: 20px;
        }

        .edit span {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: transparent;
            z-index: -1;
            border: 4px solid royalblue;
        }

        .edit span::before {
            content: "";
            display: block;
            position: absolute;
            width: 8%;
            height: 500%;
            background: var(--lightgray);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-60deg);
            transition: all 0.3s;
        }

        .edit:hover span::before {
            transform: translate(-50%, -50%) rotate(-90deg);
            width: 100%;
            background: royalblue;
        }

        .edit:hover {
            color: white;
        }

        .edit:active span::before {
            background: #2751cd;
        }

        /* pdf  */
        .action_has {
            --color: 0 0% 60%;
            --color-has: 211deg 100% 48%;
            --sz: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            height: calc(var(--sz) * 2.5);
            width: calc(var(--sz) * 2.5);
            padding: 0.4rem 0.5rem;
            border-radius: 0.375rem;
            border: 0.0625rem solid hsl(var(--color));
            margin-right: 20px;
        }

        .has_saved:hover {
            border-color: hsl(var(--color-has));
        }

        .has_liked:hover svg,
        .has_saved:hover svg {
            color: hsl(var(--color-has));
        }

        .has_liked svg,
        .has_saved svg {
            overflow: visible;
            height: calc(var(--sz) * 1.75);
            width: calc(var(--sz) * 1.75);
            --ease: cubic-bezier(0.5, 0, 0.25, 1);
            --zoom-from: 1.75;
            --zoom-via: 0.75;
            --zoom-to: 1;
            --duration: 1s;
        }

        .has_saved:hover path[data-path="box"] {
            transition: all 0.3s var(--ease);
            animation: has-saved var(--duration) var(--ease) forwards;
            fill: hsl(var(--color-has) / 0.35);
        }

        .has_saved:hover path[data-path="line-top"] {
            animation: has-saved-line-top var(--duration) var(--ease) forwards;
        }

        .has_saved:hover path[data-path="line-bottom"] {
            animation: has-saved-line-bottom var(--duration) var(--ease) forwards,
                has-saved-line-bottom-2 calc(var(--duration) * 1) var(--ease) calc(var(--duration) * 0.75);
        }

        @keyframes has-saved-line-top {
            33.333% {
                transform: rotate(0deg) translate(1px, 2px) scale(var(--zoom-from));
                d: path("M 3 5 L 3 8 L 3 8");
            }

            66.666% {
                transform: rotate(20deg) translate(2px, -2px) scale(var(--zoom-via));
            }

            99.999% {
                transform: rotate(0deg) translate(0px, 0px) scale(var(--zoom-to));
            }
        }

        @keyframes has-saved-line-bottom {
            33.333% {
                transform: rotate(0deg) translate(1px, 2px) scale(var(--zoom-from));
                d: path("M 17 20 L 17 13 L 7 13 L 7 20");
            }

            66.666% {
                transform: rotate(20deg) translate(2px, -2px) scale(var(--zoom-via));
            }

            99.999% {
                transform: rotate(0deg) translate(0px, 0px) scale(var(--zoom-to));
                d: path("M 17 21 L 17 21 L 7 21 L 7 21");
            }
        }

        @keyframes has-saved-line-bottom-2 {
            from {
                d: path("M 17 21 L 17 21 L 7 21 L 7 21");
            }

            to {
                transform: rotate(0deg) translate(0px, 0px) scale(var(--zoom-to));
                d: path("M 17 20 L 17 13 L 7 13 L 7 20");
                fill: white;
            }
        }

        @keyframes has-saved {
            33.333% {
                transform: rotate(0deg) translate(1px, 2px) scale(var(--zoom-from));
            }

            66.666% {
                transform: rotate(20deg) translate(2px, -2px) scale(var(--zoom-via));
            }

            99.999% {
                transform: rotate(0deg) translate(0px, 0px) scale(var(--zoom-to));
            }
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .edit {
                padding: 0.5em 1.2em;
                font-size: 12px;
                margin-right: 10px;
            }

            .action_has {
                height: calc(var(--sz) * 2);
                width: calc(var(--sz) * 2);
                margin-right: 10px;
            }

            .has_liked svg,
            .has_saved svg {
                height: calc(var(--sz) * 1.25);
                width: calc(var(--sz) * 1.25);
            }
        }



        /* delete */
        .delete {
            position: relative;
            width: 150px;
            height: 40px;
            cursor: pointer;
            display: flex;
            align-items: center;
            border: 1px solid #cc0000;
            background-color: #e50000;
            overflow: hidden;
            margin-right: 20px;
            transition: all 0.3s;
        }

        .delete__text {
            transform: translateX(35px);
            color: #fff;
            font-weight: 600;
            transition: all 0.3s;
        }

        .delete__icon {
            position: absolute;
            transform: translateX(109px);
            height: 100%;
            width: 39px;
            background-color: #cc0000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .svg {
            width: 20px;
        }

        .delete:hover {
            background: #cc0000;
        }

        .delete:hover .delete__text {
            color: transparent;
        }

        .delete:hover .delete__icon {
            width: 148px;
            transform: translateX(0);
        }

        .delete:active .delete__icon {
            background-color: #b20000;
        }

        .delete:active {
            border: 1px solid #b20000;
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .delete {
                width: 120px;
                height: 35px;
                margin-right: 10px;
            }

            .delete__text {
                transform: translateX(25px);
                font-size: 12px;
            }

            .delete__icon {
                transform: translateX(85px);
                width: 30px;
            }

            .svg {
                width: 16px;
            }
        }


        /* detail */
        .custom-btn {
            width: 150px;
            height: 40px;
            color: #fff;
            border-radius: 5px;
            padding: 10px 25px;
            font-family: 'Lato', sans-serif;
            font-weight: 500;
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
            box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5),
                7px 7px 20px 0px rgba(0, 0, 0, .1),
                4px 4px 5px 0px rgba(0, 0, 0, .1);
            outline: none;
            font-size: 15px;
            margin-right: 20px;
        }

        .btn-2 {
            background: #004dff;
            background: linear-gradient(0deg, #004dff 0%, #004dff 100%);
            border: none;
        }

        .btn-2:before {
            height: 0%;
            width: 2px;
        }

        .btn-2:hover {
            box-shadow: 4px 4px 6px 0 rgba(255, 255, 255, .5),
                -4px -4px 6px 0 rgba(116, 125, 136, .5),
                inset -4px -4px 6px 0 rgba(255, 255, 255, .2),
                inset 4px 4px 6px 0 rgba(0, 0, 0, .4);
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .custom-btn {
                width: 140px;
                height: 35px;
                padding: 8px 20px;
                font-size: 13px;
                margin-right: 10px;
            }
        }


        /* add */
        .add {
            border: 2px solid #24b4fb;
            background-color: #24b4fb;
            border-radius: 0.9em;
            transition: all ease-in-out 0.2s;
            font-size: 16px;
            margin-left: 40px;
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add span {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-weight: 600;
        }

        .add:hover {
            background-color: #0071e2;
        }

        /* Responsive adjustments */
        @media (max-width: 550px) {
            .add {
                font-size: 10px;
                margin-left: 20px;
                padding: 8px 16px;
            }
        }

        /* add2 */
        .add2 {
            border: 1px solid #24b4fb;
            background-color: #24b4fb;
            border-radius: 0.9em;
            transition: all ease-in-out 0.2s;
            font-size: 14px;
            /* margin-left: 40px; */
            display: inline-flex;
            align-items: center;
            padding: 6px 20px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add2 span {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-weight: 600;
        }

        .add2:hover {
            background-color: #0071e2;
        }

        /* Responsive adjustments */
        @media (max-width: 550px) {
            .add2 {
                font-size: 10px;
                margin-left: 20px;
                padding: 8px 16px;
            }
        }


        /* close */
        .close {
            width: 130px;
            height: 40px;
            padding: 1.3em 3em;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            font-weight: 500;
            color: #000;
            background-color: #fff;
            border: none;
            border-radius: 45px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease 0s;
            cursor: pointer;
            outline: none;
        }

        .close:hover {
            background-color: #0071e2;
            box-shadow: 0px 15px 20px rgba(46, 101, 229, 0.4);
            color: #fff;
            transform: translateY(-7px);
        }

        .close:active {
            transform: translateY(-1px);
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .close {
                width: 100px;
                height: 35px;
                padding: 1em 2em;
                font-size: 15px;
            }
        }


        /* halaman  */
        h1 {
            text-align: center;
            color: #4e73df;
            margin-top: 20px;
        }

        .table-responsive {
            margin: 20px auto;
            width: 95%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #4e73df;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .modal-content {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            border-bottom: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h5 {
            font-size: 18px;
        }

        .modal-body {
            max-height: 60vh;
            overflow-y: auto;
        }

        .modal-footer {
            border-top: none;
            text-align: right;
        }

        .modal-footer .close {
            background-color: #e74a3b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-footer .close:hover {
            background-color: #c0392b;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .table-responsive {
                width: 100%;
                padding: 0 10px;
            }

            th,
            td {
                padding: 10px 8px;
            }

            .add {
                width: 100%;
                justify-content: center;
            }

            .modal-content {
                width: 95%;
                margin: auto;
            }

            .modal-footer {
                display: flex;
                justify-content: center;
            }
        }

        /* back */
        .back {
            display: flex;
            height: 3em;
            width: 100px;
            color: white;
            align-items: center;
            justify-content: center;
            background-color: #eeeeee4b;
            border-radius: 0.9em;
            letter-spacing: 1px;
            transition: all 0.2s linear;
            cursor: pointer;
            border: none;
            background: #4e73df;
        }

        .back>svg {
            margin-right: 5px;
            margin-left: 5px;
            font-size: 20px;
            transition: all 0.4s ease-in;
        }

        .back:hover>svg {
            font-size: 1.2em;
            transform: translateX(-5px);
        }

        .back:hover {
            box-shadow: 9px 9px 33px #d1d1d1, -9px -9px 33px #ffffff;
            transform: translateY(-2px);
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .back {
                height: 3em;
                width: 60px;
                font-size: 14px;

            }
        }


        /* button-container */
        .button-container {
            display: flex;
            gap: 10px;
            /* Adjust the gap as needed */
            align-items: center;
            /* Align items vertically centered */
        }

        /* pdf2 */
        .download-button {
            position: relative;
            border-width: 0;
            color: white;
            font-size: 15px;
            font-weight: 600;
            border-radius: 0.9em;
            z-index: 1;
            margin-right: 10px;
        }

        .download-button .docs {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            min-height: 40px;
            padding: 0 10px;
            border-radius: 4px;
            z-index: 1;
            background-color: #0059ff;
            border: solid 1px #ffffff2d;
            transition: all .5s cubic-bezier(0.77, 0, 0.175, 1);
        }

        .download-button:hover {
            box-shadow: rgb(0, 0, 0) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }

        .download {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 90%;
            margin: 0 auto;
            z-index: -1;
            border-radius: 4px;
            transform: translateY(0%);
            background-color: #01e056;
            border: solid 1px #01e0572d;
            transition: all .5s cubic-bezier(0.77, 0, 0.175, 1);
        }

        .download-button:hover .download {
            transform: translateY(100%);
        }

        .download svg polyline,
        .download svg line {
            animation: docs 1s infinite;
        }

        @keyframes docs {
            0% {
                transform: translateY(0%);
            }

            50% {
                transform: translateY(-15%);
            }

            100% {
                transform: translateY(0%);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .download-button {
                font-size: 12px;
                margin-right: 5px;
            }

            .download-button .docs {
                min-height: auto;
                padding: 0 8px;
            }

            .download svg polyline,
            .download svg line {
                animation-duration: 0.8s;
                /* Faster animation on mobile */
            }
        }

        .custom-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            margin-left: 0.5rem;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .custom-button {
                flex-grow: 1;
                margin-left: 0;
                margin-right: 0;
                margin-bottom: 0.5rem;
                text-align: center;
            }

            .d-flex.flex-wrap {
                flex-direction: column;
            }
        }

        /* indikator */
        .status-box {
            color: #fff;
            font-weight: bold;
            text-align: center;
            border-radius: 5px;
            padding: 5px 10px;
            display: inline-flex;
            /* Ubah ke flex untuk fleksibilitas posisi */
            justify-content: center;
            /* Posisi horizontal */
            align-items: center;
            /* Posisi vertikal */
            white-space: nowrap;
            margin: 7px auto;
            /* Auto untuk memusatkan horizontal */
            max-width: 100%;
            /* Hindari elemen melewati batas layar */
            box-sizing: border-box;
            /* Pastikan padding dihitung dalam lebar */
        }

        .status-box.yes {
            background-color: #007bff;
            /* Biru untuk "Ya" */
        }

        .status-box.no {
            background-color: #dc3545;
            /* Merah untuk "Tidak" */
        }

        .status-box.done {
            background-color: #28a745;
            /* Hijau untuk "Selesai" */
        }

        /* Tambahan opsional untuk memastikan tabel tetap responsif */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            text-align: center;
            vertical-align: middle;
            padding: 10px;
            word-wrap: break-word;
        }




        /*  */
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
</head>

<body id="page-top">
    @include('sweetalert::alert')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">

                </div>
                <div class="sidebar-brand-text mx-3">Pendataan Penduduk ILP</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            {{-- Role Pengguna --}}
            <!-- Nav Item - Profile -->
            <li class="nav-item {{ Request::routeIs('profile') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('profile') }}">
                    <i class="material-icons">person</i>
                    <span>{{ __('Profile') }}</span>
                </a>
            </li>
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            @if (Auth::check() && Auth::user()->role == 'admin')
                <li class="nav-item {{ Request::routeIs('starter') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/starter') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('basic.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('basic.index') }}">
                        <i class="material-icons">group</i>
                        <span>{{ __('User Management') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('target-desa.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('target-desa.index') }}">
                        <i class="material-icons">location_city</i>
                        <span>{{ __('Target Desa') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('pendataan.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pendataan.index') }}">
                        <i class="material-icons">assignment</i>
                        <span>{{ __('Pendataan Penduduk') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('rekapitulasi.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('rekapitulasi.index') }}">
                        <i class="material-icons">assessment</i>
                        <span>{{ __('Rekapitulasi Kader') }}</span>
                    </a>
                </li>
            @endif
            @if (Auth::check() && Auth::user()->role == 'kader')
                <li class="nav-item {{ Request::routeIs('jadwal.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jadwal.index') }}">
                        <i class="material-icons">schedule</i>
                        <span>{{ __('Jadwal Pengumpulan Data') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('datakk.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('datakk.index') }}">
                        <i class="material-icons">family_restroom</i>
                        <span>{{ __('Data Anggota Keluarga') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('lingkunganrumah.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('lingkunganrumah.index') }}">
                        <i class="material-icons">home</i>
                        <span>{{ __('Data Lingkungan Rumah') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('ibu_hamil.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('ibu_hamil.index') }}">
                        <i class="material-icons">pregnant_woman</i>
                        <span>{{ __('Ibu Hamil') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('ibu_bersalin_nifas.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('ibu_bersalin_nifas.index') }}">
                        <i class="material-icons">pregnant_woman</i>
                        <span>{{ __('Ibu Bersalin Nifas') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('kunjungan_rumah_bayi.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kunjungan_rumah_bayi.index') }}">
                        <i class="material-icons">child_care</i>
                        <span>{{ __('Kunjungan Rumah Bayi') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('kunjungan_bayi_balita_prasekolah.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kunjungan_bayi_balita_prasekolah.index') }}">
                        <i class="material-icons">child_friendly</i>
                        <span>{{ __('Kunjungan Bayi Balita Prasekolah') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('kunjungan_usia_sekolah.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kunjungan_usia_sekolah.index') }}">
                        <i class="material-icons">school</i>
                        <span>{{ __('Kunjungan Usia Sekolah') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('kunjungan_usia_dewasa.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kunjungan_usia_dewasa.index') }}">
                        <i class="material-icons">face</i>
                        <span>{{ __('Kunjungan Usia Dewasa') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('kunjungan_lansia.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kunjungan_lansia.index') }}">
                        <i class="material-icons">elderly</i>
                        <span>{{ __('Kunjungan Lansia') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('kunjungan_tbc.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kunjungan_tbc.index') }}">
                        <i class="material-icons">medical_services</i>
                        <span>{{ __('Kunjungan TBC') }}</span>
                    </a>
                </li>
            @endif
            <li class="nav-item {{ Request::routeIs('tindak_lanjut_kunjungan.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('tindak_lanjut_kunjungan.index') }}">
                    <i class="material-icons">report</i>
                    <span>{{ __('Tindak Lanjut Kunjungan Rumah') }}</span>
                </a>
            </li>
            <hr class="sidebar-divider">


        </ul>
        <!-- End of Sidebar -->

        <script>
            document.getElementById('sidebarToggleTop').addEventListener('click', function() {
                const sidebar = document.querySelector('.sidebar');
                const backdrop = document.querySelector('.sidebar-backdrop');

                // Toggle sidebar visibility
                sidebar.classList.toggle('toggled');

                // Handle backdrop
                if (sidebar.classList.contains('toggled')) {
                    if (!backdrop) {
                        const newBackdrop = document.createElement('div');
                        newBackdrop.className = 'sidebar-backdrop show';
                        document.body.appendChild(newBackdrop);

                        // Hide sidebar when backdrop is clicked
                        newBackdrop.addEventListener('click', function() {
                            sidebar.classList.remove('toggled');
                            newBackdrop.remove();
                        });
                    } else {
                        backdrop.classList.add('show');
                    }
                } else if (backdrop) {
                    backdrop.classList.remove('show');
                }
            });
            // document.addEventListener("DOMContentLoaded", function() {
            //     const toggleButton = document.querySelector("#sidebarToggle");
            //     const sidebar = document.querySelector("#sidebar");

            //     toggleButton.addEventListener("click", function() {
            //         sidebar.classList.toggle("active");
            //     });
            // });
        </script>
