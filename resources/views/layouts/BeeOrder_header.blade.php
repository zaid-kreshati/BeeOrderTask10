<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Scripts -->
   
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <style>
        body, html {

            font-family: Arial, sans-serif;

        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #ffffff; /* White background */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
            border-bottom: 1px solid #ddd;
        }

        .header .logo {
            display: flex;
            align-items: center;
        }

        .header .logo img {
            height: 50px; /* Adjust as needed */
            border-radius: 50%; /* Circular logo */
        }



        .header .nav {
            display: flex;
            align-items: center;
        }

        .header .nav a {
            color: #000000; /* Black color for the "Logout" link */
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
        }

        .header .nav a:hover {
            text-decoration: underline; /* Underline on hover */
        }

        .container {
            text-align: center;
            padding: 20px;
        }

        .container2 {
            text-align: left;


        }

        .category{


            display:flex;
            align-items: center; /* Align items vertically center */

            padding: 1%;
            padding-left: 30%;
        }
        .category_name{
            width: 200px;

    border: 1px solid #ddd; /* Light grey border */
    border-radius: 6px; /* Rounded corners */
    padding: 5px; /* Padding for the input field */
    box-sizing: border-box; /* Include padding and border in the element's total width */
        }

        .right{
                margin-right: 150px; /* Adjust spacing between items as needed */

        }



        .container h1 {
            font-size: 48px;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container h2 {
            font-size: 36px;
            margin-top: 10px;
            color: #FFA500; /* Orange color to represent BeeOrder */
        }

        .container p {
            font-size: 18px;
            margin-top: 20px;
            color: #666;
        }

        .container .btn-group {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .container .btn {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #FFA500;
            color: #fff;
            border-radius: 10px;
            border: none;
            text-decoration: underline; /* Underline on hover */

        }

        .container .btn:hover {
            background-color: #ff8c00;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff; /* White card background */
            overflow: hidden;
        }

        .card-header {
            background-color: #FFA500; /* Black header background */
            color: #ffffff; /* White text color */
            padding: 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 1.5rem;
        }


        .btn-warning {
            background-color: #ff6f00; /* Orange for warning button */
            border-color: #ff6f00;
            color: #ffffff; /* White text color */
        }
        .btn-warning:hover {
            background-color: #e65c00; /* Darker orange for hover */
            border-color: #e65c00;
        }
        .btn-danger {
            background-color: #dc3545; /* Red button color */
            border-color: #dc3545;
            color: #ffffff; /* White text color */
        }
        .btn-danger:hover {
            background-color: #c82333; /* Darker red for hover */
            border-color: #c82333;
        }
        .btn-log {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #FFA500;
            color: #fff;
            border-radius: 10px;
            margin-left: 80% ;

        }

        .table {
            margin-bottom: 0;
            width: 100%;

        }

        .table thead th {
            background-color: #f8f9fa; /* Light gray background */
            border-bottom: 2px solid #dee2e6;
            color: #000000; /* Black text color */
        }
        .table td, .table th {
            padding: 15px;
            vertical-align: middle;
        }
        .table td {
            background-color: #ffffff; /* White background for cells */
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9; /* Light gray for odd rows */
        }
        .color-box {
            width: 35px;
            height: 35px;
            border-radius: 4px;
            display: inline-block;
            cursor: pointer;
            margin-right: 10px;
            margin-bottom: 10px;
            border: none;;

        }


        .form-inline {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-inline input[type="text"], .form-inline input[type="color"] {
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 8px;
        }
        .form-inline button {
            width: 100%;
            padding: 8px;
        }
        .btn-sm {
            padding: 6px 12px;
            font-size: 0.875rem;
        }

        .form-inline .hidden-color-input {
            display: none;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .action-buttons form {
            margin: 0;
        }

        .schedule-container {
            display: flex;
            overflow-x: auto;
            padding: 20px 0;
        }
        .category-card {
            flex: 0 0 auto;
            width: 250px;
            margin-right: 20px;
            background-color: #FFFFFF;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .category-name {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
        .task-list {
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .task-list2{
            width:25%;
            margin-left: 60px;
            display: flex;
            flex-direction: column;
            text-align: left;

        }
        .task-item {
            background-color: #FFFFFF;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 5px;
            text-align: center;
        }
        .no-tasks {
            text-align: center;
            color: #333;
        }
        .text-center {
            text-align: center; /* Center-align text */
        }

        .banner {
            background: linear-gradient(to right, #000000, #000000);
            text-align: center;
            padding: 20px;
            border-bottom: 4px solid #FF8C00;
            margin-bottom: 20px;
        }
        .banner h1 {
            color: #fff;
            margin: 0;
            font-size: 24px;
        }
        .banner .btn {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #FF8C00;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .banner .btn:hover {
            background-color: #FFA500;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }


        table {
            width: 100%;
            border-collapse: collapse; /* Ensures borders are shared between cells */
            margin: 20px 0; /* Adds some margin above and below the table */
        }



        th, td {
          border: 1px solid #ddd; /* Adds a thin border between cells */
          padding: 12px; /* Adds padding inside the cells */
          text-align: center; /* Centers the text in the cells */
        }


        th {
          background-color: #f4a261; /* Sets the background color for the header */
         color: #fff; /* Sets the text color in the header */
        }

        td {
         background-color: #fff; /* Sets the background color for table cells */
        }

        .action-buttons .btn {
            padding: 10px 10px;
            font-size: 14px;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            margin: 12 5px;
        }
        .action-buttons .btn-info {
            background-color: #17a2b8;
        }
        .action-buttons .btn-danger {
            background-color: #dc3545;
        }
        .action-buttons .btn-info:hover {
            background-color: #138496;
        }
        .action-buttons .btn-danger:hover {
            background-color: #c82333;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .card-header2 {
            background-color: #FFA500;
            color: #fff;
            border-bottom: 1px solid #FFA500;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        t-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .edit-button {
            background-color: #f4a261;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .edit-button2 {
            background-color: #f4a261;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
            width: 100px;
            align-self: center;
        }

        .update-comment-btn {
            background-color: #f4a261;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .update-subtask-btn {
            background-color: #f4a261;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .update-task-btn {
            background-color: #f4a261;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .delete-subtask-btn {
            background-color: #f4a261;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .delete-comment-btn {
            background-color: #f4a261;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }


        .edit-button:hover {
            background-color: #e09e79;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group button {
            background-color: #f4a261;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .form-group button:hover {
            background-color: #e09e79;
        }

        .form-control {
    width: 100%; /* Make the input take the full width of its container */
    border: 1px solid #ddd; /* Light grey border */
    border-radius: 6px; /* Rounded corners */
    padding: 5px; /* Padding for the input field */
    box-sizing: border-box; /* Include padding and border in the element's total width */
}

        .form-control:focus {
            border-color: #f57c00; /* Orange border on focus */
            box-shadow: 0 0 5px rgba(245, 124, 0, 0.5); /* Orange shadow on focus */
        }


        .alert-success {
            background-color: #dff0d8; /* Light green background for success */
            border-color: #d0e9c6;
            color: #3c763d; /* Dark green text color */
        }
        .alert-danger {
            background-color: #f2dede; /* Light red background for errors */
            border-color: #ebccd1;
            color: #a94442; /* Dark red text color */
        }
        /* Schedule-like layout */
        .schedule {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .schedule-item {
            padding: 10px;
            margin-bottom: 5px;
        }

        .schedule-item2 {
            padding: 16px;
            margin-bottom: 5px;

            display: flex;
             align-items: center;



        }


        .schedule-item2 .form-control {
            flex-basis: 200px;
        }


        .schedule-item label {
            flex-basis: 18%;
            font-weight: bold;
        }
        .schedule-item .form-control {
            flex-basis: 200px;
        }

        .highlight {
            background-color: yellow;
        }
        .autocomplete-suggestions {
            border: 1px solid #ddd;
            max-height: 200px;
            overflow-y: auto;
            position: absolute;
            background: white;
            width: 100%;
            z-index: 10;
            display: none; /* Hide by default */
            top: 100%; /* Position it just below the input field */
            left: 0;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .autocomplete-suggestion {
            padding: 8px;
            cursor: pointer;
        }
        .autocomplete-suggestion:hover {
            background-color: #f0f0f0;
        }
        .search-container {
            display: flex;
            align-items: center; /* Align items vertically center */
            margin-bottom: 15px;
            position: relative; /* To ensure the suggestions are positioned correctly */
            width: 200px; /* Adjust the width according to your needs */
        }
        #searchBox {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .search-container img {
            position: absolute;
            right: 10px; /* Adjust as needed */
            width: 25px; /* Adjust the size of the icon */
            height: 25px; /* Adjust the size of the icon */
            pointer-events: none; /* Ensure the icon does not interfere with input */
        }
        .icon {
            width: 20px;
            height: 20px;
            vertical-align: middle;
        }

        .color-square {
    width: 20px;   /* Width of the square */
    height: 20px;  /* Height of the square */
    background-color: #FF5733; /* Example color (you can set this dynamically) */
    border: 1px solid #333; /* Border to distinguish the square */
    border-radius: 3px; /* Optional rounded corners */
    display: inline-block; /* Display as an inline block element */
    margin: 2px; /* Spacing around the square */
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.2); /* Optional shadow for a 3D effect */
}

  /* Responsive styles */
  @media (max-width: 768px) {
        .category-card {
            width: 100%;
        }
    }

    </style>

</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="{{ asset('BeeOrder/img/BeeOrder_logo.png') }}" alt="Logo">
        </div>
        <nav class="nav">

        @role('leader')
        <div class="my-3"> <!-- Margin top and bottom to space it from the header -->
            <a href="{{ route('logs') }}" >View Logs</a>
        </div>

        @endrole
        <a href="{{ route('home') }}">Home</a>


            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </header>

    <div class="container">
        <!-- Main content will be placed here -->
        @yield('content')
    </div>






</body>
</html>
